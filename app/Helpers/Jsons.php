<?

namespace App\helpers;

use Illuminate\Support\Facades\DB;

use App\Feature;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class Jsons {

	/* Genero un JSON en base a un modelo y campos elegidos
	---------------------------------------------------- */
	public static function generateFeature(){
        
        $storage = Storage::disk('public');
        $filename = 'json/features.json';

        $features = Feature::all();
        foreach($features as $feature){
            $line[] = $feature->feature;
        }

        $storage->put($filename, json_encode($line, JSON_UNESCAPED_UNICODE));

	}


}