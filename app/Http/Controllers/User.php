<?php
	
	namespace App\Http\Controllers;
	
	use App\Http\Controllers\Panel as PanelBaseController;
	use Illuminate\Http\Request;
	use Sentinel;
	use Activation;
	use Validator;
	use Cookie;
	use Redirect;
	use Reminder;
	
	class User extends PanelBaseController
	{
		function index() {
			$data = [
				'title' => "Giriş Yap",
			];
			
			//
			return view("pages.login")->with($data);
		}
		
		function register() {
			$data = [
				'title' => "Kayıt Ol",
			];
			
			//
			return view("pages.register")->with($data);
		}
		
		function forgotPassword() {
			$data = [
				'title' => __("landing.forgottenPassword.title"),
			];
			
			return view('user.forgotPassword')->with($data);
		}
		
		function logout() {
			Sentinel::logout();
			
			return Redirect::route('user.login');
		}
		
		function registerPost(Request $request) {
			
			$rules = [
				'email' => 'required|email|unique:users,email',
				'password' => 'required|min:6',
				'name' => 'required|min:2',
			];
			
			$messages = [
				'name.min' => __("form.error.name.min"),
				'name.required' => __("form.error.name.required"),
			
			];
			
			$data = Validator::make($request->all(), $rules, $messages)
				->validate();
			
			$user = Sentinel::registerAndActivate($data);
			//$role = Sentinel::findRoleByName('Owner');
			//$role->users()
			//	->attach($user);
			
			return response()->json([
				"success" => true,
				"message" => __("landing.register.success"),
			]);
		}
		
		function loginPost(Request $request) {
			
			$rules = [
				'email' => 'required|email|exists:users,email',
				'password' => 'required|min:6',
				'remember' => 'nullable',
			];
			
			$messages = [
				'email.required' => "Mail adresi gerekli!",
				'email.email' => "Geçersiz mail adresi!",
				'email.exists' => "Bu mail adresi kayıtlı değil!",
				'password.required' => "Parola gerekli!",
				'password.min' => "Geçersiz parola!",
			];
			
			$data = Validator::make($request->all(), $rules, $messages)
				->validate();
			
			if(! isset($data['remember'])) {
				$data['remember'] = false;
			}
			
			$credentials = [
				'email' => $data['email'],
				'password' => $data['password'],
			];
			
			try {
				if(Sentinel::authenticate($credentials, $data['remember'])) {
					$user = Sentinel::getUser();
					Cookie::queue('userID', $user->id, 60 * 24 * 1);
					
					if($request->ajax()) {
						return response()->json([
							"success" => true,
							"message" => __("landing.login.success"),
							"redirect_url" => route("panel.index"),
						]);
					}
					
					return redirect()->route('panel.index');
				}
				
				$errors = __("landing.login.error");
			} catch(\Cartalyst\Sentinel\Checkpoints\NotActivatedException $e) {
				$errors = __("landing.login.error.activation");
			} catch(\Cartalyst\Sentinel\Checkpoints\ThrottlingException $e) {
				$delay = $e->getDelay();
				$errors = __("landing.login.error.attack", ['delay' => $delay]);
			}
			if($request->ajax()) {
				return response()->json([
					"success" => "false",
					"error" => $errors,
				]);
			}
			
			return Redirect::back()
				->withErrors($errors)
				->withInput();
		}
		
		function changePassword($code) {
			$getCode = Reminder::where('code', $code)
				->first();
			
			if(! $getCode) {
				return Redirect::route('user.login')
					->withErrors([__("landing.forgottenPassword.error.codeNotFound")]);
			}
			
			$user = Sentinel::findById($getCode->user_id);
			
			$data = [
				'code' => $code,
				'title' => __("landing.changePassword.title"),
			];
			
			return view('user.changePassword')->with($data);
		}
		
		function changePasswordPost($code, Request $request) {
			$rules = [
				'password' => 'required|min:6|confirmed',
			];
			
			$messages = [
				'password.required' => __("form.error.password.required"),
				'password.min' => __("form.error.password.min"),
				'password.confirmed' => ("form.error.password.confirmed"),
			];
			
			$data = Validator::make($request->all(), $rules, $messages)
				->validate();
			
			$code = Reminder::where('code', $code)
				->first();
			
			if(! $code) {
				return redirect()
					->route('user.login')
					->withErrors([__("landing.forgottenPassword.error.codeNotFound")]);
			}
			
			$user = Sentinel::findById($code->user_id);
			
			if(Reminder::complete($user, $code->code, $data['password'])) {
				return Redirect::route('user.login')
					->with('success', __("landing.changePassword.success"));
			}
			
			return Redirect::route('user.login')
				->withErrors([__("landing.changePassword.error")]);
		}
		
		function cancelChangePassword($code) {
			Reminder::where('code', $code)
				->delete();
			
			return redirect()->route('user.login');
		}
	}

