<?php
	
	namespace App\Http\Middleware;
	
	use Closure;
	use Redirect;
	use App;
	use Cookie;
	use Sentinel;
	
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
				$user = Sentinel::getUser();
				
				return $next($request);
			} else {
				return Redirect::route('user.login');
			}
		}
	}
