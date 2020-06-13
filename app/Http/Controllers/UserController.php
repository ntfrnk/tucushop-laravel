<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use App\Custom\ImagesWork;

use App\User;
use App\UserLike;
use App\UserProfile;
use App\UserAddress;
use App\UserRecover;
use App\Item;

class UserController extends Controller {
    
	/* Recuperar contraseña
	---------------------------------------------------- */
	public function passRecover(Request $request){
		
		$validate = $this->validate($request, [
			'email' => 'required|email|exists:users,email'
		], [
			'email.required' => 'Este campo no puede quedar vacío',
			'email.email' => 'Debes ingresar un e-mail válido',
			'email.exists' => 'No encontramos este e-mail en nuestra base de datos'
		]);

		$user = User::where('email', $request->email)->first();

		return redirect()->route('mail.user.recoverpass', [
			'user_id' => $user->id
		]);

	}


	/* Recuperar contraseña (cargar código)
	---------------------------------------------------- */
	public function passRecoverCode($user_token){
		
		$user = User::where('remember_token', $user_token)->first();

		if($user){

			return view('auth.passwords.code', [
				'user' => $user
			]);
		
		} else {

			return redirect()->route('login');

		}

	}


	/* Recuperar contraseña
	---------------------------------------------------- */
	public function passValidateCode(Request $request){
		
		$validate = $this->validate($request, [
			'code' => 'required|digits:6|int|exists:users_recoverpass,code'
		], [
			'code.required' => 'Debes indicar el código de validación',
			'code.digits' => 'La longitud del código no es correcta (seis caracteres requeridos)',
			'code.int' => 'El código debe ser un número',
			'code.exists' => 'El código ingresado no es válido'
		]);

		$recover = UserRecover::where('code',$request->code)
		->where('user_id',$request->user_id)
		->first();

		$recover->delete();

		$user = User::find($request->user_id);

		return redirect()->route('user.pass.changepass', [
			'user_token' => $user->remember_token
		]);

	}


	/* Recuperar contraseña (introducir una nueva)
	---------------------------------------------------- */
	public function passChangePass($user_token){
		
		$user = User::where('remember_token', $user_token)->first();

		if($user){

			return view('auth.passwords.newpass', [
				'user' => $user
			]);
		
		} else {

			return redirect()->route('login');

		}

	}


	/* Recuperar contraseña
	---------------------------------------------------- */
	public function passValidateNew(Request $request){
		
		$validate = $this->validate($request, [
			'password' => 'required|min:6|max:30|regex:/^[a-zA-Z0-9_ -\+\.]+$/|confirmed'
		], [
			'password.required' => 'Tienes que ingresar una contraseña',
			'password.regex' => 'Estás usando caracteres no permitidos',
			'password.min' => 'La contraseña es demasiado corta (mínimo: 6 caracteres)',
			'password.max' => 'La contraseña es demasiado larga (máximo: 30 caracteres)',
			'password.confirmed' => 'Las contraseñas no coinciden'
		]);

		$user = User::find($request->user_id);
		$user->password = hash::make($request->password);
		$user->save();

		return redirect()->route('mail.user.changepass', ['user_id' => $user->id]);

	}

	
	/* Home de área de usuario
	---------------------------------------------------- */
	public function home(){
		
		$user = \Auth::user();

		return view('user.modules.home', [
			'user' => $user
		]);

	}


	/* Edición de datos de cuenta
	---------------------------------------------------- */
	public function account(){

		if(\Auth::user()){

			$user = \Auth::user();

			return view('user.modules.account', [
				'user' => $user
			]);

		} else {

			return redirect()->route('home');

		}

	}


	/* Edición de datos de cuenta
	---------------------------------------------------- */
	public function accountUpdate(Request $request){

		$user = \Auth::user();

		$validate = $this->validate($request, [
			'email' => 'required|email|unique:users,email,'.$user->id,
			'nickname' => 'required|min:6|max:30|regex:/^[a-zA-Z0-9_\.]+$/|unique:users,nickname,'.$user->id,
			'password' => 'nullable|min:6|max:30|regex:/^[a-zA-Z0-9_ -\+\.]+$/'
		], [
			'email.required' => 'Este dato es obligatorio',
			'email.email' => 'El formato del correo no es válido',
			'email.unique' => 'Este correo ya está siendo usado por otro usuario',
			'nickname.required' => 'Este dato es obligatorio',
			'nickname.min' => 'El nickname es demasiado corto (mínimo: 6 caracteres)',
			'nickname.max' => 'El nickname es demasiado largo (máximo: 30 caracteres)',
			'nickname.regex' => 'Estás utilizando caracteres no permitidos',
			'nickname.unique' => 'Este nombre de usuario ya se encuentra en uso',
			'password.regex' => 'Estás usando caracteres no permitidos',
			'password.min' => 'La contraseña es demasiado corta (mínimo: 6 caracteres)',
			'password.max' => 'La contraseña es demasiado larga (máximo: 30 caracteres)'
		]);

		$user->email = $request->email;
		$user->nickname = $request->nickname;
		if($request->password){
			$user->password = Hash::make($request->password);
		}
		$user->save();

		return redirect()->route('user.account')
				->with(['message' => '¡Los datos se guardaron correctamente!']);

	}


	/* Validación AJAX de dirección email
	---------------------------------------------------- */
	public function validateEmail($email){
		$user = \Auth::user();
		$registro = User::where('email', $email)->where('id', '!=', $user->id)->first();
		if(is_object($registro)){
			return "error";
		} else {
			return "ok";
		}
	}


	/* Validación AJAX de nickname
	---------------------------------------------------- */
	public function validateNick($nickname){
		$user = \Auth::user();
		$registro = User::where('nickname', $nickname)->where('id', '!=', $user->id)->first();
		if(is_object($registro)){
			return "error";
		} else {
			return "ok";
		}
	}


	/* Gestionar la foto de perfil
	---------------------------------------------------- */
	public function profile(){

		if(\Auth::user()){

			$user = \Auth::user();

			return view('user.modules.profile', [
				'user' => $user
			]);

		} else {

			return redirect()->route('home');

		}

	}


	/* Upload de foto de perfil
	---------------------------------------------------- */
	public function photoUpload(Request $request){
		
		if(\Auth::user()){

			$validate = $this->validate($request, [
				'photo' => 'required|image'
			]);

			$user = \Auth::user();
			$profile = UserProfile::where('user_id', $user->id)->first();
			
			$file_path = $request->file('photo');

			$path = 'users/original/';
			if(empty($profile->photo)){
				$file_path_name = \UrlFormat::add_zeros($user->id).'_'.time().".".$file_path->getClientOriginalExtension();
			} else {
				$file_path_name = $profile->photo;
			}
			Storage::disk('public')->put($path.$file_path_name, File::get($file_path));
			$profile->photo = $file_path_name;

			$profile->save();

			if($request->vmovil && $request->vmovil == 1){
				return redirect()->route('user.photo.resize', ['vmovil' => 1]);
			} else {
				return redirect()->route('user.photo.resize');
			}

		} else {

			return redirect()->route('home');

		}

	}


	/* Optimización de foto de portada
	---------------------------------------------------- */
	public function photoResize($vmovil = null){

		$user = \Auth::user();
		$profile = UserProfile::where('user_id', $user->id)->first();

		$path_original = '/users/original/';

		$size = getimagesize(route('home')."/storage".$path_original.$profile->photo);

		if($size[0]>640 || $size[1]>640){

			$image = new ImagesWork('storage'.$path_original.$profile->photo);
			$image->setSizeW(640);

			$image->setPath("storage".$path_original);
			$image->setFilename($profile->photo);
			$image->setQuality(70);
			$image->resize();
			$image->save();

		}

		if($vmovil && $vmovil == 1){
			return redirect()->route('user.photo.crop', ['vmovil' => 1]);
		} else {
			return redirect()->route('user.photo.crop');
		}

	}


	/* Recorte de foto de portada
	---------------------------------------------------- */
	public function photoCrop($vmovil = null){

		$user = \Auth::user();

		if($vmovil && $vmovil == 1){
			$vmov = 1;
		} else {
			$vmov = 0;
		}

		if(\Auth::user()){

			return view('user.modules.crop', [
				'user' => $user,
				'vmovil' => $vmov
			]);

		} else {

			return redirect()
					->route('login')
					->with(['message' => 'El link que buscas no existe o no tienes permiso para ver su contenido.']);

		}

	}


	/* Recorte de foto de portada (cropper)
	---------------------------------------------------- */
	public function photoCropper(Request $request){

		$path_original = 'storage/users/original/';
		$path_cropped_resize = 'storage/users/resized/';

		$profile = UserProfile::where('user_id', \Auth::user()->id)->first();

		$image = new ImagesWork($path_original.$profile->photo);
		$image->setFilename($profile->photo);

		$image->setSizeH($request->h);
		$image->setSizeW($request->w);
		$image->setQuality(90);
		$image->setPosX($request->x);
		$image->setPosY($request->y);

		$image->setPath($path_cropped_resize);
		$image->crop();

		$image->save();

		$profile->version_photo = $profile->version_photo + 1;
		$profile->save();

		if($request->vmovil && $request->vmovil == 1){
			return redirect()->route('user.profile', [
				'user' => \Auth::user()
			]);
		} else {
			return redirect()->route('user.account', [
				'user' => \Auth::user()
			]);
		}

	}


	/* Edición de datos personales
	---------------------------------------------------- */
	public function edit(){

		if(\Auth::user()){

			$user = \Auth::user();

			return view('user.modules.edit', [
				'user' => $user
			]);

		} else {

			return redirect()->route('home');

		}

	}


	/* Actualización de datos
	---------------------------------------------------- */
	public function update(Request $request){

		$validate = $this->validate($request, [
			'name' => 'required|min:3|regex:/^[a-zA-Z \.]+$/',
			'birthday' => 'date|nullable',
			'dni' => 'numeric|nullable',
		], [
			'name.required' => 'Este dato es requerido',
			'name.min' => 'El nombre es demasiado corto',
			'name.regex' => 'Sólo puedes ingresar caracteres alfabéticos (letras)',
			'lastname.required' => 'Este dato es requerido',
			'lastname.min' => 'El apellido es demasiado corto',
			'lastname.regex' => 'Sólo puedes ingresar caracteres alfabéticos (letras)',
			'birthday.date' => 'Debes ingresar una fecha válida',
			'dni.numeric' => 'Sólo puedes ingresar caracteres numéricos'
		]);

		$user = \Auth::user();
		$profile = UserProfile::where('user_id', $user->id)->first();

		$profile->name = $request->name;
		$profile->lastname = $request->lastname;
		$profile->birthday = $request->birthday;
		$profile->gender = $request->gender;
		$profile->dni = $request->dni;

		$profile->save();

		return redirect()->route('user.edit')->with(['message' => '¡Los datos se guardaron correctamente!']);

	}


	/* Edición de datos personales
	---------------------------------------------------- */
	public function contact(){

		if(\Auth::user()){

			$user = \Auth::user();

			if(!$user->address){

				$address = new UserAddress();
				$address->user_id = $user->id;
				$address->save();

				$user = \Auth::user();

			}

			return view('user.modules.contact', [
				'user' => $user
			]);

		} else {

			return redirect()->route('home');

		}

	}


	/* Actualización de datos
	---------------------------------------------------- */
	public function contactUpdate(Request $request){

		$validate = $this->validate($request, [
			'phone' => 'digits:10|numeric|nullable',
			'address' => 'nullable',
			'city' => 'nullable',
			'postalcode' => 'numeric|nullable',
		], [
			'phone.digits' => 'El número es muy corto (se esperan 10 números)',
			'phone.numeric' => 'Debes ingresar sólo caracteres numéricos',
			'postalcode.numeric' => 'Sólo puedes ingresar caracteres numéricos'
		]);

		$user = \Auth::user();
		$address = UserAddress::where('user_id', $user->id)->first();

		$address->phone = $request->phone;
		$address->address = $request->address;
		$address->city = $request->city;
		$address->postalcode = $request->postalcode;

		$address->save();

		return redirect()->route('user.contact')->with(['message' => '¡Los datos se guardaron correctamente!']);

	}


	/* Gestión de favoritos
	---------------------------------------------------- */
	public function likes(){
		
		if(\Auth::user()){

			$user = \Auth::user();
			$items = UserLike::where('user_id', $user->id)
						->orderBy('created_at', 'desc')
						->paginate(12);

			return view('user.modules.items', [
				'user' => $user,
				'items' => $items
			]);

		} else {

			return redirect()->route('home');

		}

	}


	/* Gestión de favoritos
	---------------------------------------------------- */
	public function likeDelete($item_id){
		
		if(\Auth::user()){

			$user = \Auth::user();
			$userLike = UserLike::where('user_id', $user->id)
						->where('item_id', $item_id)
						->delete();

			return redirect()->route('user.likes');

		} else {

			return redirect()->route('home');

		}

	}


}
