<?

namespace App\Custom;

use PHPImageWorkshop\ImageWorkshop;

class ImagesWork {

	private $path = null;
	private $filename = null;
	private $sizeW = null;
	private $sizeH = null;
	private $posX = null;
	private $posY = null;
	private $quality = '90';
	
	private $image_file = null;

	public function __construct($image_initial){
		$this->image_file = ImageWorkshop::initFromPath($image_initial);
	}

	// Setters

	public function setPath($path){
		$this->path = $path;
	}

	public function setFilename($filename){
		$this->filename = $filename;
	}

	public function setSizeW($sizeW){
		$this->sizeW = $sizeW;
	}

	public function setSizeH($sizeH){
		$this->sizeH = $sizeH;
	}

	public function setPosX($posX){
		$this->posX = $posX;
	}

	public function setPosY($posY){
		$this->posY = $posY;
	}

	public function setQuality($quality){
		$this->quality = $quality;
	}

	// Acciones

	public function orientation($w, $h){
		if($w > $h){
			$orientation = 'h';
		} elseif($w == $h){
			$orientation = 'c';
		} else {
			$orientation = 'v';
		}
		return $orientation;
	}

	public function resize(){
		if($this->image_file->resizeInPixel($this->sizeW, $this->sizeH, true)){
			return true;
		} else {
			return false;
		}
	}

	public function crop(){
		$this->image_file->cropInPixel($this->sizeW, $this->sizeH, $this->posX, $this->posY, 'LT');
	}

	public function save(){
		$this->image_file->save($this->path, $this->filename, true, null, $this->quality);
	}

}

?>