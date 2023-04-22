<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class StorageImage
{

    public function saveImage($image, $folder): string //función para guardar imagenes, estará disponible como compartida el BoundedContex
    {
        try {
            $randomName = 'game-' . Str::random(10) . '.' . $image['ext']; //Creamos el nombre de la imagen
            $file = file_get_contents($image['urlResized']); //Transformamos la imagen
            Storage::disk('public')->put('/' . $folder . '/' . $randomName, $file); //Guardamos en el storage la imagen la carpeta y su nombre correspondiente
            return '/storage/' . $folder . '/' . $randomName; // Retornamos path donde se almacenó la imagen para guardar en la DB
        } catch (Exception $e) {
            return $e;
        }
    }
}
