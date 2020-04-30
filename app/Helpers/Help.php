<?

namespace App\helpers;

use Illuminate\Support\Facades\DB;

use App\Store;

class Help {

	/* Portada de administración del store
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

}