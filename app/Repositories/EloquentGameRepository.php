<?php

namespace App\Repositories;

use App\Models\Game;
use App\Services\StorageImage;
use App\Http\Resources\GameResource;
use App\Contracts\Game\FindGameInterface;
use App\Contracts\Game\GameRepositoryInterface;
use Illuminate\Support\Facades\Log;

class EloquentGameRepository implements GameRepositoryInterface
{
    protected $storageImage;
    protected $findGame;

    // Inyectamos la dependencia de StorageImage en el constructor
    public function __construct(StorageImage $storageImage, FindGameInterface $findGame)
    {
        $this->storageImage = $storageImage;
        $this->findGame = $findGame;
    }


    public function paginate()
    {   // Obtenemos los juegos ordenados por fecha de creación y los paginamos
        $games = Game::orderBy('created_at', 'desc')->paginate(2);
        // Devolvemos una colección de recursos de juegos para ser utilizada en la respuesta
        return GameResource::collection($games);
    }

    public function create(array $data)
    {
        $pathImage = $data['pathImage'];
        if (array_key_exists('pathImageUrl', $data) && !$data['pathImageUrl']) { //Validamos que la imagen que llega es una url o un archivo una para almacenar al storage
            $pathImage = $this->storageImage->saveImage($pathImage, 'games'); //Guardamos la imagen en el storage y recibimos el path
        }
        // Creamos un nuevo juego con los datos recibidos
        $game = Game::create([
            'name' => $data['name'],
            'description' => $data['description'],
            'pathImageUrl' => $data['pathImageUrl'],
            'pathImage' => $pathImage,
            'url' => $data['url'],
            'state' => $data['state']
        ]);
        // Devolvemos el recurso del juego creado para ser utilizado en la respuesta
        return new GameResource($game);
    }

    public function update(array $data, string $id)
    {
        //Buscamos el juego, si no existe entonces devolverá una excepción
        $game = $this->findGame->findGame($id);
        $pathImage = $data['pathImage'];
        if (array_key_exists('pathImageUrl', $data) && !$data['pathImageUrl']) { //Validamos que la imagen que llega es una url o un archivo una para almacenar al storage
            Log::info('ENTRO AQUI');
            $pathImage = $this->storageImage->saveImage($pathImage, 'games'); //Guardamos la imagen en el storage y recibimos el path
        }
        // Actualizamos el juego con los datos recibidos
        $game->update(
            [
                'name' => $data['name'],
                'description' => $data['description'],
                'pathImage' => $pathImage,
                'pathImageUrl' => $data['pathImageUrl'],
                'url' => $data['url'],
                'state' => $data['state']
            ]
        );
        // Devolvemos el recurso del juego actualizado para ser utilizado en la respuesta
        return new GameResource($game);
    }

    public function delete(string $id)
    {
        //Buscamos el juego
        $this->findGame->findGame($id);
        // Eliminamos el juego con el id especificado
        return Game::destroy($id);
    }

    public function find(string $id)
    {
        //Buscamos el juego, si no existe entonces devolverá una excepción
        $game = $this->findGame->findGame($id);
        return new GameResource($game);
    }
}
