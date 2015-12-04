<?php

class PlayerController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		if(ACL::checkUserPermission('player.index') == false){
			return Redirect::action('dashboard');
		}

		$userList   = UserMember::with('user','group','points')->where('group_id', 4)->get();
		

		// echo json_encode($userList->toArray());
		// exit;

		$title 		= Lang::get('Player List');
		$status 	= array('0' => array('label'   => 'default' ,'status'  => 'Inactive'), 
					    	'1' => array('label'  => 'success', 'status' => 'Active'));

		$user = $userList->toArray();

		$data = array(
			'acl' 		 => ACL::buildACL(), 
			'userList'	 => $userList,
			'title'		 => $title,
			'status'	 => $status
		);

		return View::make('player/index',$data);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		if(ACL::checkUserPermission('player.create') == false){
			return Redirect::action('dashboard');
		}

		$title 	   = Lang::get('Add Player');
		$formOpen  = Form::open(array('method' => 'post', 'id' => 'form-player','class' => 'smart-form', 'route' => array('player.store')));
		$formClose = Form::close();

		$data = array(
			'formOpen'  => $formOpen, 
			'formClose' => $formClose,
			'title'		=> $title,
			'url_rfid'  => URL::route('player.rfid')
			);

		return View::make('player/create', $data);
	}

	public function deposit()
	{
		//retrieve POST value
		$param = Input::only('credits','account_id');

		$rules = array(
			'credits'	 => 'required|numeric|min:1,max:1000000',
			'account_id' => 'exists:acl_users,id');

			//custom error messaging
		$messages = array(
				'buyer_id.exists'	 => 'Buyer id is not valid.',
				'merchant_id.exists' => 'Merchant id is not valid');

		$validator = Validator::make($param, $rules, $messages);

		if ($validator->passes())
		{
			$retrieve = Wallet::where('account_id', $param['account_id'])->first();

			$credits = array(
				'account_id' => $param['account_id'],
				'credits' 	 => $param['credits'], 
			);

			if(!empty($retrieve))
			{
				try{
					$update = $retrieve->increment('credits', $param['credits']);

					if($update == 1)
					{
						$fundin = array(
						 'wallet_id' 	=> $retrieve->id, 
						 'onbehalf'  	=> Auth::user()->id,
						 'credits'		=> $param['credits'],
						 'description'	=> 'Deposit credits',
						 'fundtype'		=> 'fundin'
						 );

						$funds = Fundinout::create($fundin);
					}
				}
				catch(Exception $e){
					return false;
				}
			}
			else
			{
				$add_credits = Wallet::create($credits);

				$fundin = array(
					'wallet_id' 	=> $add_credits->id, 
					'onbehalf'  	=> Auth::user()->id,
					'credits'		=> $param['credits'],
					'description'	=> 'Deposit credits',
					'fundtype'		=> 'fundin'
				);

				$funds = Fundinout::create($fundin);
			}

			$message = 'Credit has been successfully added.';
			return Redirect::action('player.index')->with('success', $message);
		}
		else
		{	
			$messages = $validator->messages();
			return Redirect::action('player.index')->with('error', $messages->all());
		}
	}

	public function withdraw()
	{
		//retrieve POST value
		$param = Input::only('credits','account_id');

		$rules = array(
			'credits'	 => 'required|numeric|min:1,max:1000000',
			'account_id' => 'exists:acl_users,id');

			//custom error messaging
		$messages = array();

		$validator = Validator::make($param, $rules, $messages);

		if ($validator->passes())
		{
			$retrieve = Wallet::where('account_id', $param['account_id'])->first();

			if(!empty($retrieve))
			{
	
				if($retrieve->credits >= $param['credits'])
				{
				
					try{
						$update = $retrieve->decrement('credits', $param['credits']);

						if($update == 1)
						{
							$fundin = array(
						 		'wallet_id' 	=> $retrieve->id, 
						 		'onbehalf'  	=> Auth::user()->id,
						 		'credits'		=> $param['credits'],
						 		'description'	=> 'Withdraw credits',
						 		'fundtype'		=> 'fundout');

							$funds = Fundinout::create($fundin);
						}
					}
					catch(Exception $e){
						return false;
					}

					$message = 'Credit has been successfully withdraw.';
					return Redirect::action('player.index')->with('success', $message);
				}
				else
				{
					return Redirect::action('player.index')->with('error', 'Insufficient credits!');
				}
			}
			else
			{
				return Redirect::action('player.index')->with('error', 'Insufficient credits!');
			}

		}
		else
		{	
			$messages = $validator->messages();
			return Redirect::action('player.index')->with('error', $messages->all());
		}
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		if(ACL::checkUserPermission('player.create') == false){
			return Redirect::action('dashboard');
		}

		$param  = Input::only('username','email','fullname','company','rfid_serial', 'operator');

		$rules = array(
    			'username' => 'required|unique:acl_users|alpha_num',
    			'email'    => 'email|unique:acl_users');

		//custom error messaging
		$messages = array(
				'operator.exists'	 => 'Operator doesn\'t exist',
				'operator.required'  => 'Select an operator for this player.');

		$validator = Validator::make($param, $rules,$messages);

		if ($validator->fails())
		{
			$messages = $validator->messages();
			return Redirect::action('player.create')->withInput(Input::except('password'))->with('error', $messages->all());
		}
		else
		{
			
			$player_group_id = Group::where('name' , 'Player')->firstOrFail();
			
			$days	= new DateTime(date('Y-m-d H:i:s', strtotime("+30 days")));

			$player_account = array(
				'username'  => $param['username'],
				'email'     => $param['email'],
				'fullname'  => $param['fullname'],
				'company'   => $param['company'],
				'password'  => Hash::make(''),
				'confirmed' => 1,
				'status'    => 1,
				'rfid_serial' => $param['rfid_serial'],
				'password_expiration_date' => $days,
				'account_expiration_date'  => $days,
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime);

			$add_account = User::create($player_account);

			$user_member = array(
				'user_id'  		=> $add_account->id,
				'group_id' 		=> $player_group_id->id,
				'date_created'	=> new DateTime
			);

			$add_member = UserMember::create($user_member);

			$player_points = array(
				'account_id' => $add_account->id, 
			);

			$add_points = Points::create($player_points);

			$message = 'Player has been created';
    		return Redirect::action('player.index')->with('success', $message);
		}

	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		if(ACL::checkUserPermission('player.edit') == false){
			return Redirect::action('dashboard');
		}

		$player_info = User::find($id);

		if(!empty($player_info))
		{
			$title 	     = Lang::get('Edit Player Details');
			
			$form_open   = Form::open(array(
				'method' => 'put', 
				'id' 	 => 'form-player',
				'class'  => 'smart-form', 
				'route'  => array('player.update',$id)
			));
			
			$form_close = Form::close();

			$data = array(
				'form_open'   => $form_open, 
				'form_close'  => $form_close,
				'title'		  => $title,
				'url_rfid'    => URL::route('player.rfid'),
				'player_info' => $player_info
			);

			return View::make('player/edit', $data);
		}
		else
		{
			$message = 'Cannot get player info. Please try again.';
			return Redirect::Action('player.index')->with('error', $message);
		}
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$param  = Input::only('email','fullname','company','rfid_serial');

		$rules = array();

		//custom error messaging
		$messages = array();

		$validator = Validator::make($param, $rules,$messages);

		if ($validator->fails())
		{
			$messages = $validator->messages();
			return Redirect::action('player.edit', $id)->withInput(Input::except('password'))->with('error', $messages->all());
		}
		else
		{
			$update = User::updatePlayer($param,$id);

			if($update['status'] == 200)
			{
				return Redirect::action('player.index')->with('success', $update['message']);
			}
			else
			{
				return Redirect::action('player.edit', $id)->withInput(Input::except('password'))->with('error', $update['message']);
			}
		}


	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

	public function rfid()
	{
		$app_path	= 'python ' . app_path() . '/python/rfid_serial.py ';

		$output = shell_exec($app_path);

		$json = json_decode($output,true);

		if($json['status'] == 200)
		{
			$rfid = trim($output);

			$param = array('rfid_serial' => $json['tagid']);

			$rules = array('rfid_serial' => 'unique:acl_users');

			//custom error messaging
			$messages = array(
					'operator.exists'	 => 'Operator doesn\'t exist',
					'operator.required'  => 'Select an operator for this player.');

			$validator = Validator::make($param, $rules,$messages);

			if ($validator->fails())
			{
				$response = array(
					'title'   => 'Card aready exist',
					'status'  => 400,
					'message' => 'Card has been already used other player. Please place another card.' 
				);
			}
			else
			{
				$response = array(
					'status' => 200, 
					'rfid_serial' => $json['tagid']
				);
			}
		}
		else
		{
			$response = array(
				'title'   => 'Request Time Out',
				'status'  => 400,
				'message' => ($json['error']) ?  $json['error'] : 'Please place the card in the reader.'
			);
		}

		return Response::json($response,$response['status']);
	}

}
