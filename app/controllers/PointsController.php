<?php

class PointsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */

	public function __construct()
    {
    	$this->operator_id = Auth::user()->id;
    }

	public function player()
	{
		if(ACL::checkUserPermission('points.player') == false){
			return Redirect::action('dashboard');
		}

		$form_open  = Form::open(array('method' => 'post', 'files' => true ,'id' => 'form-player-csv' , 'class' => 'smart-form' , 'role' => 'form')); 

		$userList   = UserMember::with('user','group','points')->where('group_id', 4)->get();

		$title 		= Lang::get('Player List');

		$client_ip = Request::getClientIp(true);

		$data = array(
			'acl' 		 => ACL::buildACL(), 
			'userList'	 => $userList,
			'title'		 => $title,
			'form_open'  => $form_open,
			'client_ip'  => $client_ip
		);

		return View::make('points/index',$data);
	}

	public function bets()
	{
		$param = Input::only('account_id', 'bets');

		$rules = array(
			'bets'	 	 => 'required|numeric|min:1,max:1000000',
			'account_id' => 'required|exists:acl_users,id');

			//custom error messaging
		$messages = array(
				'buyer_id.exists'	 => 'Buyer id is not valid.',
				'merchant_id.exists' => 'Merchant id is not valid');

		$validator = Validator::make($param, $rules, $messages);

		if ($validator->passes())
		{
			$points_conversion = Settings::getSettingValue('points_conversion');

			$points_converted  = $param['bets'] / floatval($points_conversion); 

			$create = array(
				'account_id' => $param['account_id'],
				'added_by' => $this->operator_id, 
				'bet' => $param['bets'],
				'points_conversation' => floatval($points_conversion),
				'points_converted' => $points_converted
			);

			try{

				$player_bet = Playerbets::create($create);

				$retrieve = Points::where('account_id', $param['account_id'])->first();
				
				$update = $retrieve->increment('credits', $points_converted);

				$message = 'Points has been updated.';

				return Redirect::action('points.player')->with('success', $message);

			}
			catch(Exception $e){
			// return false;
				print $e;
			}
		}
		else
		{	
			$messages = $validator->messages();
			return Redirect::action('points.player')->with('error', $messages->all());
		}

	}

	public function logout($player_id)
	{
		$retrieve = User::find($player_id);

		if(!empty($retrieve))
		{
			$retrieve->rfid_login = 0;
			$retrieve->save();

			$message = 'Player has been logout.';

			return Redirect::action('points.player')->with('success', $message);
		}
		else
		{
			return Redirect::action('points.player')->with('error', 'Player not found. Please try again.');
		}
	}

	public function rfid()
	{
		$app_path	= 'python ' . app_path() . '/python/rfid_serial.py ';

		$output = shell_exec($app_path);

		$json = json_decode($output,true);

		if($json['status'] == 200)
		{
			$user_points = User::with('points')->where('rfid_serial' , $json['tagid'])->get();

			if(!empty($user_points->first()))
			{
				$player_details = $user_points->first();

				$response = array(
					'status' => 200, 
					'rfid_serial' => $player_details->rfid_serial,
					'points' => $player_details->points->credits,
					'player_name' => $player_details->username,
					'player_id' => $player_details->id
				);
			}
			else
			{
				$response = array(
					'title'   => 'Card not registered',
					'status'  => 400,
					'message' => 'This card is not yet registered to any player.'
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
