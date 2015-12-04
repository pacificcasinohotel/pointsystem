<?php

class OperateContoller extends \BaseController {

	public $operator_id = '';

	public function __construct()
    {
    	$this->operator_id = Auth::user()->id;
    }

	public function start()
	{
		if(ACL::checkUserPermission('roulette.start') == false){
			return Redirect::action('dashboard');
		}
		
		if(Auth::user()->isOperator())
		{
			$game    = Games::where('game_name', 'Roulette')->take(1)->get()->first();
			$table   = Gametables::where('operator_id', $this->operator_id)->take(1)->get()->first();
			$players = Playeroperators::with('playerdetails','credits')->where('operator_id', $this->operator_id)->get();

			if(!empty($table))
			{
				$create_channel = array(
					'channel_id'   => Utils::generateRandomString(),
					'table_id'   => $table->id
				);

				
				$channel_id = '';
				$channel 	= Gamechannel::openchannel()->where('table_id' , $table->id)->take(1)->get()->first();

				if(!empty($channel))
				{
					$channel_id = $channel->id;
				}
				else
				{
					$channel_create = Gamechannel::create($create_channel);
					$channel_id   = $channel_create->id;
				}

			$gamedetails  = Gamechannel::with('tabledetails.gamedetails','tabledetails.operator','bets','bets.playerdetails')->find($channel_id);

			$totalbets 	  = 0;
			$totalplayers = 0; 

			if($gamedetails->bets != null)
			{
				foreach ($gamedetails->bets as $gamebets) {
					$totalbets += $gamebets->bet_amount;
					$totalplayers++;
				}
			}

			$title = Lang::get('Start Game');

			$data = array(
				'title' 	   => $title,
				'totalbets'	   => $totalbets,
				'totalplayers' => $totalplayers,
				'gamedetails'  => $gamedetails,
				'players'      => $players);

				return View::make('operator/create', $data);
			}
			else
			{
				return App::abort(401, 'No Roulette table has been assigned to your account.');
			}

		}
		else
		{
			return App::abort(401, 'You are not a operator.');
		}
	}

	public function deposit()
	{
		//retrieve POST value
		$param = Input::only('credits','account_id');

		$rules = array(
			'credits'	 => 'required|numeric|min:1,max:1000000',
			'account_id' => 'exists:acl_users,id');

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
			return Redirect::action('roulette.index')->with('success', $message);
		}
		else
		{	
			$messages = $validator->messages();
			return Redirect::action('roulette.index')->with('error', $messages->all());
		}

	}

}
