<?php

class RedeemPointsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$data = array(
			'url_rfid'  => URL::route('points.rfid')
		);

		return View::make('coupon/index',$data);
	}

	public function post()
	{
		$param = Input::only('player_id', 'points');

		$rules = array(
			'points'	=> 'required|numeric|min:1,max:1000000',
			'player_id' => 'required|exists:acl_users,id');

			//custom error messaging
		$messages = array(
				'points.required'	 => 'Please fill up the player points redemption.',
				'merchant_id.exists' => 'Merchant id is not valid');

		$validator = Validator::make($param, $rules, $messages);

		if ($validator->passes())
		{
			$player_points = Points::where('account_id' , $param['player_id'])->get()->first();

			$param = array(
				'player_id'   => $param['player_id'],
				'points'      => $param['points'],
				'redeem_by'   => Auth::user()->id, 
				'coupon_code' => Utils::generateRandomString(),
				'redeemed'    => 1
			);

			try{

				$player_bet = Coupon::create($param);

				$update = $player_points->decrement('credits', $param['points']);

				$message = 'Points has been successfully redeemed.';

				return Redirect::action('points.redeem')->with('success', $message);
		
			}
			catch(Exception $e){
				print $e;
			}
		}
		else
		{	
			$messages = $validator->messages();
			return Redirect::action('points.redeem')->with('error', $messages->all());
		}
	}

}
