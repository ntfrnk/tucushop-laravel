<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Custom\ImagesWork;

use App\Item;
use App\Feature;
use App\ItemFeature;
use App\Keyword;
use App\ItemTag;
use App\Store;
use App\ItemPhoto;
use App\ItemOffer;
use App\ItemReport;
use App\Message;
use App\MessageAnswer;
use App\UserLike;

class ItemController extends Controller {


    /* Detalle del ítem
	---------------------------------------------------- */
	public function detail($name, $id){

		// Obtengo los datos del item

		$item = Item::find($id);

		if($item->status != 0 && $item->store->status != 0 && $item->store->deleted != 1){
			$item_disabled = 1;
		} else {
			$item_disabled = 0;
		}

		$tags = ItemTag::where('item_id',$item->id)->get();

		// Obtengo los items aleatorios

		$items_random = 
		Item::where(function($query) {
				$query->where('status', 1);
				$query->whereHas('store', function($q) {
					$q->where('status', 1);
					$q->where('deleted', '!=', 1);
				});
			})
			->where('status', '1')
			->inRandomOrder()
			->take(12)
			->get();

		// Obtengo keywords para buscar los relacionados

		$kname = \Help::keywords($item->name);
		$kdetail = \Help::keywords($item->detail);

		if($tags!=null && $tags->count()!=0){
			foreach($tags as $tag){
				$ktags[] = $tag->keyword->keyword;
			}
		} else {
			$ktags = array();
		}

		$words = array_merge_recursive($kname, $kdetail, $ktags);

		// Busco los ítems relacionados

		$items_sugested = 
		Item::where(function($query) use ($item) {
			$query->where('status', 1);
			$query->whereHas('store', function($q) {
				$q->where('status', 1);
				$q->where('deleted', '!=', 1);
			});
			$query->where('id', '!=', $item->id);
		})
		->where(function($query) use ($words){
			foreach($words as $word){
				$query->orWhere('name', 'like', '%'.$word.'%');
				$query->orWhere('detail', 'like', '%'.$word.'%');
				$query->orWhereHas('features', function($q) use ($word) {
					$q->where('content', 'like', '%'.$word.'%');
				});
				$query->orWhereHas('tags', function($query) use ($word) {
					$query->whereHas('keyword', function($q) use ($word) {
						$q->where('keyword', 'like', '%'.$word.'%');
					});
				});
			}
		})
		->inRandomOrder()
		->take(12)
		->get();

		// Retorno la vista

		return view('item.detail', [
			'item' => $item,
			'tags' => $tags,
			'item_disabled' => $item_disabled,
			'items_sugested' => $items_sugested,
			'items_random' => $items_random
		]);

	}


	/* Detalle del ítem (PRUEBAS)
	---------------------------------------------------- */
	public function detailTest($name, $id){

		// Obtengo los datos del item

		$item = Item::find($id);

		if($item->status != 0 && $item->store->status != 0 && $item->store->deleted != 1){
			$item_disabled = 1;
		} else {
			$item_disabled = 0;
		}

		$tags = ItemTag::where('item_id',$item->id)->get();

		/* // Obtengo los items aleatorios

		$items_random = 
		Item::where(function($query) {
				$query->where('status', 1);
				$query->whereHas('store', function($q) {
					$q->where('status', 1);
					$q->where('deleted', '!=', 1);
				});
			})
			->where('status', '1')
			->inRandomOrder()
			->take(12)
			->get();

		// Obtengo keywords para buscar los relacionados

		$kname = \Help::keywords($item->name);
		$kdetail = \Help::keywords($item->detail);

		if($tags!=null && $tags->count()!=0){
			foreach($tags as $tag){
				$ktags[] = $tag->keyword->keyword;
			}
		} else {
			$ktags = array();
		}

		$words = array_merge_recursive($kname, $kdetail, $ktags);

		// Busco los ítems relacionados

		$items_sugested = 
		Item::where(function($query) use ($item) {
			$query->where('status', 1);
			$query->whereHas('store', function($q) {
				$q->where('status', 1);
				$q->where('deleted', '!=', 1);
			});
			$query->where('id', '!=', $item->id);
		})
		->where(function($query) use ($words){
			foreach($words as $word){
				$query->orWhere('name', 'like', '%'.$word.'%');
				$query->orWhere('detail', 'like', '%'.$word.'%');
				$query->orWhereHas('features', function($q) use ($word) {
					$q->where('content', 'like', '%'.$word.'%');
				});
				$query->orWhereHas('tags', function($query) use ($word) {
					$query->whereHas('keyword', function($q) use ($word) {
						$q->where('keyword', 'like', '%'.$word.'%');
					});
				});
			}
		})
		->inRandomOrder()
		->take(12)
		->get(); */

		

		// Retorno la vista

		return view('item.detail', [
			'item' => $item,
			'tags' => $tags,
			'item_disabled' => $item_disabled,
			'items_sugested' => $items_sugested,
			'items_random' => $items_random
		]);

	}


	/* Like / unlike a un item
	---------------------------------------------------- */
	public function like($item_id){

		$user = \Auth::user();
		
		$like = UserLike::where('item_id', $item_id)->where('user_id', $user->id)->first();

		 if(is_object($like)){
			UserLike::where('item_id', $item_id)->where('user_id', $user->id)->delete();
			$resp = 0;
		} else {
			$like = new UserLike();
			$like->item_id = $item_id;
			$like->user_id = $user->id;
			$like->save();
			$resp = 1;
		}
		
		return $resp;

	}


	/* Listado de items
	---------------------------------------------------- */
	public function items($alias){

		if(\Auth::user() && isset($alias) && \Help::isAdmin($alias) && !\Help::isDeleted($alias)){

			$store = Store::where('alias', $alias)->first();

			$items = Item::
			where('store_id', $store->id)
			->orderBy('name', 'asc')
			->paginate(12);

			return view('store.modules.items', [
				'store' => $store,
				'items' => $items
			]);

		} else {

			return redirect()
			->route('store.list')
			->with(['message' => 'El link que buscas no existe o no tienes permiso para ver su contenido.']);

		}

	}


	/* Tipo de listado (lista o grilla)
	---------------------------------------------------- */
	public function itemListType($alias, $style){

		session(['listType' => $style]);

		return redirect()->route('items', [
			'alias' => $alias
		]);

	}


	/* Formulario de nuevo item
	---------------------------------------------------- */
	public function new($alias){
		
		if(\Auth::user() && isset($alias) && \Help::isAdmin($alias) && !\Help::isDeleted($alias)){

			$store = Store::where('alias', $alias)->first();
			$features = Feature::all();

			return view('store.modules.item_form', [
				'store' => $store,
				'features' => $features
			]);

		} else {

			return redirect()
				->route('store.list')
				->with(['message' => 'El link que buscas no existe o no tienes permiso para ver su contenido.']);

		}

	}


	/* Guardado del nuevo item
	---------------------------------------------------- */
	public function save(Request $request){
		
		$validate = $this->validate($request, [
			'name' => 'required|string|min:10|max:50',
			'detail' => 'required|max:500',
			'price' => 'integer|required',
			'store_id' => 'integer'
		], [
			'name.required' => 'Debes escribir un nombre para el artículo',
			'name.string' => 'Estás utilizando caracteres no válidos',
			'name.min' => 'El nombre debe tener 10 (diez) caracteres como mínimo.',
			'name.max' => 'El nombre debe tener 50 (cincuenta) caracteres como máximo.',
			'detail.required' => 'Por favor describe tu artículo',
			'detail.max' => 'Superaste el límite de caracteres (500)',
			'price.required' => 'Por favor indica un precio para el artículo',
			'price.integer' => 'El precio debe contener números y no puede quedar vacío'
		]);

		$item = new Item();
		
		$item->name = $request->name;
		$item->detail = $request->detail;
		$item->price = $request->price;
		$item->store_id = $request->store_id;
		$item->status = 0;

		$item->save();

		return redirect()->route('item.edit', [
			'alias' => $item->store->alias,
			'item_id' => $item->id
		]);

	}


	/* Formulario de edición de un item
	---------------------------------------------------- */
	public function edit($alias, $item_id){

		if(\Auth::user() && isset($alias) && \Help::isAdmin($alias) && !\Help::isDeleted($alias)){

			$store = Store::where('alias', $alias)->first();
			$item = Item::find($item_id);
			$tags = ItemTag::where('item_id', $item->id)->get();

			$offer = $item->offer && $item->offer->expiration > date('Y-m-d') ? 1 : 0;

			return view('store.modules.item_form', [
				'store' => $store,
				'item' => $item,
				'tags' => $tags,
				'offer' => $offer
			]);

		} else {

			return redirect()
				->route('store.list')
				->with(['message' => 'El link que buscas no existe o no tienes permiso para ver su contenido.']);

		}

	}


	/* Guardado de cambios en el item
	---------------------------------------------------- */
	public function update(Request $request){
		
		$validate = $this->validate($request, [
			'name' => 'required|string|min:10|max:50',
			'detail' => 'string|required|max:500',
			'price' => 'integer|required'
		], [
			'name.required' => 'Debes escribir un nombre para el artículo',
			'name.string' => 'Estás utilizando caracteres no válidos',
			'name.min' => 'El nombre debe tener 10 (diez) caracteres como mínimo.',
			'name.max' => 'El nombre debe tener 50 (cincuenta) caracteres como máximo.',
			'detail.string' => 'Estás utilizando caracteres no válidos',
			'detail.required' => 'Por favor describe tu artículo',
			'detail.max' => 'Superaste el límite de caracteres (500)',
			'price.integer' => 'El precio debe contener sólo números',
			'price.required' => 'Por favor indica un precio para el artículo'
		]);

		$item = Item::find($request->item_id);
		
		$item->name = $request->name;
		$item->detail = $request->detail;
		if(!$item->offer || $item->offer->expiration <= date('Y-m-d')){
			$item->price = $request->price;
		}

		$item->save();

		return redirect()->route('item.edit', [
			'alias' => $item->store->alias,
			'item_id' => $item->id
		])->with(['message' => '¡Los cambios se guardaron con éxito!']);

	}


	/* Crear o eliminar una oferta
	---------------------------------------------------- */
	public function offer(Request $request){

		$item = Item::find($request->item_id);

		if(!empty($item->offer)){
			$offer = ItemOffer::find($item->offer->id)->delete();
		}

		$offer = new ItemOffer();
		
		$offer->item_id = $request->item_id;
		$offer->percent = $request->percent;
		$offer->price = $request->price;
		$offer->expiration = $request->expiration;
		
		$offer->save();

		return "ok";

	}


	/* Eliminar una oferta
	---------------------------------------------------- */
	public function offerDelete($item_id){

		$item = Item::find($item_id);

		if($item->offer){
			$offer = ItemOffer::find($item->offer->id)->delete();
		}

		return redirect()->route('item.edit', [
			'alias' => $item->store->alias,
			'item_id' => $item->id
		]);

	}


	/* Gestión de fotos de un item
	---------------------------------------------------- */
	public function photos($alias, $item_id){

		$item = Item::find($item_id);
		$store = Store::find($item->store->id);

		if(\Auth::user() && isset($alias) && \Help::isAdmin($alias) && !\Help::isDeleted($alias)){

			return view('store.modules.photos', [
				'store' => $store,
				'item' => $item
			]);

		} else {

			return redirect()
				->route('store.list')
				->with(['message' => 'El link que buscas no existe o no tienes permiso para ver su contenido.']);

		}

	}


	/* Upload de fotos para un item
	---------------------------------------------------- */
	public function upload(Request $request){

		$validate = $this->validate($request, [
			'photo' => 'required|image',
			'item_id' => 'required|integer'
		]);

		$item = Item::find($request->item_id);

		$photo = new ItemPhoto();		
		$photo->item_id = $item->id;
		
		$file_path = $request->file('photo');

		$path = 'items/original/';
		$file_path_name = \UrlFormat::add_zeros($item->id).'_'.time().".".$file_path->getClientOriginalExtension();
		Storage::disk('public')->put($path.$file_path_name, File::get($file_path));
		$photo->file_path = $file_path_name;

		$photo->save();

		return redirect()->route('item.photo.resize', [
			'photo_id' => $photo->id
		]);

	}


	public function resizePhoto($photo_id){

		$photo = ItemPhoto::find($photo_id);

		$path_original = '/items/original/';

		$size = getimagesize(route('home')."/storage".$path_original.$photo->file_path);

		if($size[0]>1200 || $size[1]>1200){

			$image = new ImagesWork('storage'.$path_original.$photo->file_path);
			$orientation = $image->orientation($size[0], $size[1]);
			if($orientation=='v' || $orientation=='c'){
				$image->setSizeW(1200);
			} else {
				$image->setSizeH(1200);
			}

			$image->setPath("storage".$path_original);
			$image->setFilename($photo->file_path);
			$image->setQuality(65);
			$image->resize();
			$image->save();

		}

		return redirect()->route('item.photo.crop', [
			'alias' => $photo->item->store->alias,
			'item_id' => $photo->item->id,
			'photo_id' => $photo->id
		]);

	}


	/* Recortar de fotos de un item
	---------------------------------------------------- */
	public function cropPhoto($alias, $item_id, $photo_id){

		$item = Item::find($item_id);
		$store = Store::find($item->store->id);
		$photo = ItemPhoto::find($photo_id);

		if(\Auth::user() && \Help::isAdmin($store->alias) && !\Help::isDeleted($store->alias)){

			return view('store.modules.crop', [
				'store' => $store,
				'item' => $item,
				'photo' => $photo
			]);

		} else {

			return redirect()
				->route('store.list')
				->with(['message' => 'El link que buscas no existe o no tienes permiso para ver su contenido.']);

		}

	}


	/* Guardado de la foto recortada
	---------------------------------------------------- */
	public function cropper(Request $request){

		$path_original = 'storage/items/original/';
		$path_cropped_lg = 'storage/items/lg/';
		$path_cropped_sm = 'storage/items/sm/';

		$photo = ItemPhoto::find($request->photo_id);

		$size = getimagesize($path_original.$photo->file_path);

		$image = new ImagesWork($path_original.$photo->file_path);
		$image->setFilename($photo->file_path);
		
		$orientation = $image->orientation($size[0], $size[1]);
		$image->setSizeH($request->h);
		$image->setSizeW($request->w);
		$image->setQuality(60);
		$image->setPosX($request->x);
		$image->setPosY($request->y);

		$image->setPath($path_cropped_lg);
		$image->crop();

		$image->setSizeH(714);
		$image->setSizeW(null);
		$image->resize();

		$image->save();

		$image->setPath($path_cropped_sm);
		$image->setSizeH(303);
		$image->setSizeW(null);
		$image->resize();

		$image->save();

		$photo->version = $photo->version + 1;
		$photo->save();

		return redirect()->route('item.photos', [
			'alias' => $photo->item->store->alias,
			'item_id' => $photo->item->id
		]);

	}


	/* Ordenar las fotos de un item
	---------------------------------------------------- */
	public function orderPhoto($neworder){

		$photos_list = str_replace('img_', '', $neworder);
		$photos_list = preg_split("/,/", $photos_list);

		for($i=0;$i<count($photos_list);$i++){
			$photo = ItemPhoto::find($photos_list[$i]);
			$photo->ordering = $i;
			$photo->save();
		}

		return json_encode($photos_list);

	}


	/* Eliminar fotos de un item
	---------------------------------------------------- */
	public function deletePhoto($photo_id){

		$photo = ItemPhoto::find($photo_id);
		$item_id = $photo->item->id;
		$alias = $photo->item->store->alias;

		// Elimino el archivo
		Storage::disk('public')->delete('items/original/'.$photo->file_path);
		Storage::disk('public')->delete('items/lg/'.$photo->file_path);
		Storage::disk('public')->delete('items/sm/'.$photo->file_path);

		// Elimino el registro
		$photo->delete();

		return redirect()->route('item.photos', [
			'alias' => $alias,
			'item_id' => $item_id
		]);

	}


	/* Agrego una característica al item
	---------------------------------------------------- */
	public function addFeature(Request $request){

		$feature = Feature::where('feature',$request->feature)->first();
		$itemFeature = new ItemFeature();

		if(!is_object($feature)){

			$feature = new Feature();
			$feature->feature = trim($request->feature);
			$feature->save();

		}

		\Jsons::generateFeature();

		$itemFeature->item_id = $request->item_id;
		$itemFeature->feature_id = $feature->id;
		$itemFeature->content = trim($request->content);
		$itemFeature->save();

		$itemFeature->feature = trim(ucfirst($request->feature));

		return json_encode($itemFeature);

	}


	/* Elimino una característica del item
	---------------------------------------------------- */
	public function deleteFeature($item_id, $feature_id){

		$feature = ItemFeature::where('item_id', $item_id)
			->where('feature_id', $feature_id)
			->delete();

		$response['resp'] = "ok";

		return json_encode($response);

	}


	/* Agrego una etiqueta al item
	---------------------------------------------------- */
	public function addTag(Request $request){

		$tags = explode(",", $request->keyword);
		$n = count($tags);

		$etiquetas = array();

		for($i = 0; $i < $n; $i++) {

			$tag_yala = Keyword::where('keyword', trim($tags[$i]))->first();

			if(is_object($tag_yala) && !empty($tag_yala)){
				$keyword_id = $tag_yala->id;
			} else {
				$keyword = new Keyword();
				$keyword->keyword = trim($tags[$i]);
				$keyword->save();
				$keyword_id = $keyword->id;
			}

			$tag = new ItemTag();
			$tag->item_id = $request->item_id;
			$tag->keyword_id = $keyword_id;

			$etiquetas[] = array('keyword_id' => $keyword_id, 'keyword' => trim($tags[$i]));

			$tag->save();

		}

		return json_encode($etiquetas);

	}


	/* Elimino una etiqueta del item
	---------------------------------------------------- */
	public function deleteTag($item_id, $keyword_id){

		$feature = ItemTag::where('item_id', $item_id)
			->where('keyword_id', $keyword_id)
			->delete();

		$response['resp'] = "ok";

		return json_encode($response);

	}


	/* Cambiar el estado de un item
	---------------------------------------------------- */
	public function status($item_id, $editing = 0){
		
		$item = Item::find($item_id);

		if(\Auth::user() && isset($item->store->alias) && \Help::isAdmin($item->store->alias) && !\Help::isDeleted($item->store->alias)){

			$item->status = $item->status == 1 ? 0 : 1;
			$item->save();

			if($editing==1){
				return redirect()->route('item.edit', ['alias' => $item->store->alias, 'item_id' => $item->id]);
			} else {
				return redirect()->route('items', ['alias' => $item->store->alias]);
			}

		} else {

			return redirect()
				->route('store.list')
				->with(['message' => 'El link que buscas no existe o no tienes permiso para ver su contenido.']);

		}

	}


	/* Eliminar un item
	---------------------------------------------------- */
	public function delete($item_id){
		
		$item = Item::find($item_id);
		$alias = $item->store->alias;

		if(\Auth::user() && isset($alias) && \Help::isAdmin($alias) && !\Help::isDeleted($alias)){

			$photos = ItemPhoto::where('item_id', $item_id)->get();

			// Elimino las fotos
			foreach($photos as $photo){
				Storage::disk('public')->delete('items/original/'.$photo->file_path);
				Storage::disk('public')->delete('items/lg/'.$photo->file_path);
				Storage::disk('public')->delete('items/sm/'.$photo->file_path);
			}

			// Elimino todos los registros asociados
			ItemPhoto::where('item_id', $item_id)->delete();
			ItemFeature::where('item_id', $item_id)->delete();
			ItemTag::where('item_id', $item_id)->delete();
			ItemOffer::where('item_id', $item_id)->delete();
			ItemReport::where('item_id', $item_id)->delete();
			UserLike::where('item_id', $item_id)->delete();
			$messages = Message::where('item_id', $item_id)->get();
			foreach($messages as $message){
				MessageAnswer::where('message_id', $message->id)->delete();
			}
			Message::where('item_id', $item_id)->delete();

			$item->delete();

			return redirect()->route('items', ['alias' => $alias]);

		} else {

			return redirect()
				->route('store.list')
				->with(['message' => 'El link que buscas no existe o no tienes permiso para ver su contenido.']);

		}

	}


}
