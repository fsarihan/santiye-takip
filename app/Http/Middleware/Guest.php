<?php
	
	namespace App\Http\Middleware;
	
	use Closure;
	use Redirect;
	use Sentinel;
	
	class Guest
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
				return Redirect::route('panel.index');
			} else {
				return $next($request);
			}
		}
	}
