<?php
	
	namespace App\Http\Controllers;
	
	use App\Http\Controllers\Panel as PanelBaseController;
	use App\Source;
	use Cookie;
	use Illuminate\Http\Request;
	use Sentinel;
	use App\User;
	
	class Dashboard extends PanelBaseController
	{
		function __construct() {
			parent::__construct();
		}
		
		function index() {
			$userID = Sentinel::getUser()->id;
			
			//dd($userID);
			return view('panel.dashboard')->with($userID);
		}
		
		function isciler() {
			$userID = Sentinel::getUser()->id;
			
			//dd($userID);
			return view('panel.isciler')->with($userID);
		}
	}
