<?php
	
	namespace App\Http\Controllers;
	
	use App\User;
	use View;
	use Sentinel;
	use Notification;
	use Cookie;
	
	class Panel extends Controller
	{
		function __construct() {
			$this->middleware(function ($request, $next) {
				if(Sentinel::getUser()) {
					$userID = Sentinel::getUser()->id;
					$user = User::find($userID);
					$unreadCount = 0;
					//$notifications = $user->notifications->take(20)
					//	->map(function ($notification) use (&$unreadCount) {
					//		if(! $notification->read_at) {
					//			$unreadCount++;
					//		}
					//		$notification->humanDate = $notification->created_at->diffForHumans();
					//
					//		return $notification;
					//	});
					
					$adminMenu = [];
					
					if($user->hasAccess('downloadSubscriptions')) {
						$adminMenu[] = [
							"icon" => "la la-user",
							"title" => "Subscriptions",
							"activeRoute" => ['panel.downloadSubscriptions'],
							"url" => route("panel.downloadSubscriptions"),
						];
					}
					if($user->hasAccess('languageUpdate')) {
						$adminMenu[] = [
							"icon" => "la la-globe",
							"title" => "Dil Ayarları",
							"activeRoute" => ['panel.language'],
							"url" => route("panel.language"),
						];
					}
					
					if($user->hasAccess('getUsers')) {
						$adminMenu[] = [
							"icon" => "la la-users",
							"title" => "Üyeler",
							"activeRoute" => ['panel.users'],
							"url" => route("panel.users"),
						];
					}
					
					$menu = [
						//[
						//	"icon" => "la la-home",
						//	"title" => __("panel.menu.dashboard"),
						//	"activeRoute" => ['panel.index'],
						//	"url" => route("panel.index"),
						//],
						//[
						//	"icon" => "la la-industry",
						//	"title" => __("panel.menu.organizationProfile"),
						//	"activeRoute" => ['panel.organization.profile'],
						//	"url" => route("panel.organization.profile"),
						//],
						//[
						//	"icon" => "la la-bank",
						//	"title" => __("panel.menu.organizationUpdate"),
						//	"activeRoute" => ['panel.organization.update'],
						//	"url" => route("panel.organization.update"),
						//],
						//[
						//	"icon" => "la la-users",
						//	"title" => __("panel.menu.teamInformations"),
						//	"activeRoute" => ['panel.organization.teamInformations'],
						//	"url" => route("panel.organization.teamInformations"),
						//],
						//[
						//	"icon" => "la la-cogs",
						//	"title" => __("panel.menu.userSettings"),
						//	"activeRoute" => ['panel.profile.userSettings'],
						//	"url" => route("panel.profile.userSettings"),
						//],
						//[
						//	"icon" => "la la-unlock",
						//	"title" => __("panel.menu.logout"),
						//	"activeRoute" => ['panel.logout'],
						//	"url" => route("panel.logout"),
						//],
					];
					
					View::share([
						//"notifications" => $notifications,
						//"unreadNotificationCount" => $unreadCount,
						//"menu" => $menu,
						//"lang" => $lang,
						//"adminMenu" => $adminMenu,
					]);
				}
				
				return $next($request);
			});
		}
	}
