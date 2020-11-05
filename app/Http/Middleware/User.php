<?php
	
	namespace App\Http\Middleware;
	
	use Closure;
	use Redirect;
	use App;
	use Cookie;
	use Sentinel;
	use App\Http\Controllers\PagesController;
	use Illuminate\Support\Facades\View;
	
	class User
	{
		/**
		 * Handle an incoming request.
		 *
		 * @param  \Illuminate\Http\Request $request
		 * @param  \Closure $next
		 * @return mixed
		 */
		public function handle($request, Closure $next) {
			
			if(Sentinel::check()) {
				//$user = Sentinel::getUser();
				$secilebilirSantiyeler = PagesController::secilebilirSantiyeler($request);
				
				View::composer('layout.partials.extras._topbar', function ($view) use ($secilebilirSantiyeler) {
					$view->with('secilebilirSantiyelerGlobal', $secilebilirSantiyeler[0]);
					$view->with('seciliSantiyeGlobal', $secilebilirSantiyeler[1]);
				});
				
				return $next($request);
			} else {
				return Redirect::route('user.login');
			}
		}
	}
