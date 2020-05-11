<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use App\Custom\ImagesWork;

use App\User;
use App\Message;
use App\UserLike;
use App\UserProfile;
use App\UserAddress;
use App\Item;

class UserController extends Controller {
    
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
			'email' => 'required|string|unique:users,email,'.$user->id,
			'nickname' => 'required|string|unique:users,email,'.$user->id,
		]);

		$user->email = $request->email;
		$user->nickname = $request->nickname;
		if(isset($request->password) && !emtpy($request->password)){
			$user->password = Hash::make($request->password);
		}
		$user->save();

		return redirect()->route('user.account')->with(['message' => '¡Los datos se guardaron correctamente!']);

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

			return redirect()->route('user.photo.resize');

		} else {

			return redirect()->route('home');

		}

	}


	/* Optimización de foto de portada
	---------------------------------------------------- */
	public function photoResize(){

		$user = \Auth::user();
		$profile = UserProfile::where('user_id', $user->id)->first();

		$path_original = '/users/original/';

		$size = getimagesize(route('home')."/storage".$path_original.$profile->photo);

		if($size[0]>800 || $size[1]>800){

			$image = new ImagesWork('storage'.$path_original.$profile->photo);
			$image->setSizeW(800);

			$image->setPath("storage".$path_original);
			$image->setFilename($profile->photo);
			$image->resize();
			$image->save();

		}

		return redirect()->route('user.photo.crop');

	}


	/* Recorte de foto de portada
	---------------------------------------------------- */
	public function photoCrop(){

		$user = \Auth::user();

		if(\Auth::user()){

			return view('user.modules.crop', [
				'user' => $user
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
		$image->setQuality(100);
		$image->setPosX($request->x);
		$image->setPosY($request->y);

		$image->setPath($path_cropped_resize);
		$image->crop();

		$image->save();

		$profile->version_photo = $profile->version_photo + 1;
		$profile->save();

		return redirect()->route('user.account', [
			'user' => \Auth::user()
		]);

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


	/* Gestión de mensajes (Bandeja de entrada)
	---------------------------------------------------- */
	public function messages(){
		
		if(\Auth::user()){

			$user = \Auth::user();
			$messages = Message::where('user_id', $user->id)
						->orderBy('Id', 'desc')
						->paginate(5);

			return view('user.modules.messages', [
				'user' => $user,
				'messages' => $messages
			]);

		} else {

			return redirect()->route('home');

		}

	}

}
