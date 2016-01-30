<?php

class ApiController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function login_player($rfid)
	{
		$user = User::where('rfid_serial', $rfid)->get();

		if(!empty($user->first()))
		{
			$client_ip = Request::getClientIp(true);

			$player_details = $user->first();

			$retrieve = User::find($player_details->id);

			$retrieve->rfid_login = 1;
			$retrieve->ip_address = $client_ip;
			$retrieve->save();

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
				'title'   => 'User doesnt exist',
				'status'  => 400,
				'message' => 'User doesnt exist. Please try again.'
			);
		}

		return Response::json($response,$response['status']);
	}

}
