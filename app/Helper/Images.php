<?php

namespace App\Helper;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use App\Models\Foto;
use \Illuminate\Http\UploadedFile;

class Images
{
    CONST PATH_LOCAL = "public\storage";
    public function __construct(){
        //
    }

    /**
     * @param string $path
     */
    private function setImage($path){
        $foto = new Foto();
        $foto->direccion_imagen = $path;
        $foto->url_imagen = env('APP_URL').$path;
        $foto->save();
    }

    /**
     * @param string $path
     * @return null|int
     */
    private function getImage($path){
        $Foto=Foto::where('direccion_imagen', $path)->first();
        if (!is_null($Foto)) {
            return $Foto->id;
        }else{
            return null;
        }
    }

    /**
     * @param string $path
     * @return null|int
     */
    private function storageImage($path){
        $this->setImage($path);
        return $this->getImage($path);
    }

    /**
     * @param string $ci
     * @param UploadedFile $File
     * @return null|int
     */
    public function uploadFile($ci, $File){
        $ci = "/".$ci."/";
        if (!is_null($File)) {
            $filename = time() . '-' . $File->getClientOriginalName();
            if (!file_exists(SELF::PATH_LOCAL.$ci)) {
                mkdir(SELF::PATH_LOCAL.$ci, 0777, true);
            }
            if ($File->move(SELF::PATH_LOCAL.$ci,$filename)){
                return $this->storageImage(SELF::PATH_LOCAL.$ci.$filename);
            }
        }
        return null;
    }
}
