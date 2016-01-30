<?php

class ReportsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */

	public function coupon()
	{
		if(ACL::checkUserPermission('reports.redeem') == false){
			return Redirect::action('dashboard');
		}

		$coupon = Coupon::with('playerdetails','redeemer')->get();

		$title   = 'Points Redeemed Report';

		$data = array(
			'acl' 	   => ACL::buildACL(), 
			'coupon'   => $coupon,
			'title'	   => $title);

		return View::make('reports/redeem',$data);

	}

	public function bets()
	{
		if(ACL::checkUserPermission('reports.bets') == false){
			return Redirect::action('dashboard');
		}

		$bets = Playerbets::with('playerdetails','operator')->get();

		$title   = 'Player Bets Report';

		$data = array(
			'acl' 	   => ACL::buildACL(), 
			'bets'     => $bets,
			'title'	   => $title
		);

		return View::make('reports/bets',$data);

	}

	public function deposit()
	{

		if(ACL::checkUserPermission('reports.deposit') == false){
			return Redirect::action('dashboard');
		}

		$fundin 	 = Fundinout::with('wallet','wallet.playerdetails','operator')->where('fundtype', 'fundin')->get();
		$title 		 = Lang::get('Bought Credits Report');

		$data = array(
			'acl' 			=> ACL::buildACL(), 
			'depositlist'   => $fundin,
			'title'			=> $title);

		return View::make('reports/deposit',$data);
	}

	public function redeem()
	{
		if(ACL::checkUserPermission('reports.redeem') == false){
			return Redirect::action('dashboard');
		}

		$funout 	 = Fundinout::with('wallet','wallet.playerdetails','operator')->where('fundtype', 'fundout')->get();
		$title 		 = Lang::get('Reedemed Credits Report');
		
		$data = array(
			'acl' 			=> ACL::buildACL(), 
			'depositlist'   => $funout,
			'title'			=> $title);

		return View::make('reports/withdraw',$data);
	}

	public function winnings()
	{
		if(ACL::checkUserPermission('reports.winnings') == false){
			return Redirect::action('dashboard');
		}

		$game_winnings = Gamewinnings::with('channel.tabledetails.operator')->get();
		
		$title 		   = Lang::get('Winning Numbers');

		$data = array(
			'acl' 			=> ACL::buildACL(), 
			'winnings'  	=> $game_winnings,
			'title'			=> $title);

		return View::make('reports/winnings',$data);


	}

}
