<?

namespace App\helpers;

use Illuminate\Support\Facades\DB;

use App\Store;

class Help {

	/* Compruebo si el usuario es administrador del negocio
	---------------------------------------------------- */
	public static function isAdmin($alias){
		$store = Store::where('alias', $alias)->first();
		foreach($store->admins as $admin){
			$adminers[] = $admin->user->id;
		}
		if(in_array(\Auth::user()->id, $adminers)){
			return true;
		} else {
			return false;
		}
	}


	/* Comprueba si el negocio no está eliminado
	---------------------------------------------------- */
	public static function isDeleted($alias){
		$store = Store::where('alias', $alias)->first();
		if($store->deleted == 1){
			return true;
		} else {
			return false;
		}
	}


	/* Comprueba si el negocio existe
	---------------------------------------------------- */
	public static function exists($alias){
		$store = Store::where('alias', $alias)->first();
		if(is_object($store)){
			return true;
		} else {
			return false;
		}
	}


}