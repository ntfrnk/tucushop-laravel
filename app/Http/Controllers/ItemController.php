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
use App\Message;
use App\UserLike;

class ItemController extends Controller {


    /* Detalle del ítem
	---------------------------------------------------- */
	public function detail($name, $id){

		$item = Item::find($id);
		$items_sugested = Item::where('status', '1')
							->inRandomOrder()
							->take(8)
							->get();

		return view('item.detail', [
			'item' => $item,
			'items_sugested' => $items_sugested
		]);

	}


	/* Listado de items
	---------------------------------------------------- */
	public function items($alias){

		if(\Help::isAdmin($alias) && !\Help::isDeleted($alias)){

			$store = Store::where('alias', $alias)->first();
			$items = Item::where('store_id', $store->id)
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
		
		if(\Auth::user() && \Help::isAdmin($alias) && !\Help::isDeleted($alias)){

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
			'name' => 'required|string|min:10|max:255',
			'detail' => 'string|max:255',
			'price' => 'integer',
			'store_id' => 'integer'
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

		if(\Auth::user() && \Help::isAdmin($alias) && !\Help::isDeleted($alias)){

			$store = Store::where('alias', $alias)->first();
			$item = Item::find($item_id);
			$features = Feature::all();

			return view('store.modules.item_form', [
				'store' => $store,
				'item' => $item,
				'features' => $features
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
			'name' => 'required|string|min:10|max:255',
			'detail' => 'string',
			'price' => 'integer'
		]);

		$item = Item::find($request->item_id);
		
		$item->name = $request->name;
		$item->detail = $request->detail;
		$item->price = $request->price;

		$item->save();

		return redirect()->route('items', ['alias' => $item->store->alias]);

	}


	/* Gestión de fotos de un item
	---------------------------------------------------- */
	public function photos($alias, $item_id){

		$item = Item::find($item_id);
		$store = Store::find($item->store->id);

		if(\Auth::user() && \Help::isAdmin($store->alias) && !\Help::isDeleted($store->alias)){

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

		if($size[0]>1800 || $size[1]>1800){

			$image = new ImagesWork('storage'.$path_original.$photo->file_path);
			$orientation = $image->orientation($size[0], $size[1]);
			if($orientation=='v' || $orientation=='c'){
				$image->setSizeW(1800);
			} else {
				$image->setSizeH(1800);
			}

			$image->setPath("storage".$path_original);
			$image->setFilename($photo->file_path);
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
		$image->setQuality(100);
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
	public function orderPhoto(Request $request){

		$item = Item::find($request->item_id);
		$photos_id = explode(",", str_replace('img_', '', $request->neworder));

		for($i=0;$i<count($photos_id);$i++){
			$photo = ItemPhoto::find($photos_id[$i]);
			$photo->ordering = $i;
			$photo->save();
		}

		return redirect()->route('item.photos', [
			'alias' => $item->store->alias,
			'item_id' => $item->id
		]);

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

		if(\Auth::user() && \Help::isAdmin($item->store->alias) && !\Help::isDeleted($item->store->alias)){

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

		if(\Auth::user() && \Help::isAdmin($alias) && !\Help::isDeleted($alias)){

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
			UserLike::where('item_id', $item_id)->delete();
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
