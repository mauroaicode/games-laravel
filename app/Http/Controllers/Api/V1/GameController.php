<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\JsonResponse;
use App\Http\Requests\GameRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;
use App\Contracts\Game\GameRepositoryInterface;

class GameController extends Controller
{
    protected $repository;

    // Inyectamos la dependencia GameRepositoryInterface en el constructor
    public function __construct(GameRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    // Obtenemos los parámetros de la petición
    private function getGameParams(): array
    {
        return request()->only('name', 'description', 'pathImage', 'pathImageUrl', 'url', 'state');
    }

    // Método que retorna todos los juegos paginados
    public function all()
    {
        $games = $this->repository->paginate();
        // Si no hay juegos, retornamos un mensaje de error
        if ($games->isEmpty()) {
            return new JsonResponse([
                'data' => $games,
                'message' => 'No hay juegos'
            ], Response::HTTP_NOT_FOUND);
        }
        // Si hay juegos, retornamos la colección de juegos
        return new JsonResponse([
            'data' => $games
        ], Response::HTTP_OK);
    }

    // Método para crear un nuevo juego
    public function create(GameRequest $request) // El GameRequest es para validar los datos que llegan
    {
        // Obtenemos los parámetros de la petición
        $data = $this->getGameParams();
        // Iniciamos la transacción de la BD
        DB::beginTransaction();
        try {
            // Creamos el juego con los datos recibidos
            $game = $this->repository->create($data);
            DB::commit();
            // Retornamos la respuesta exitosa
            return new JsonResponse([
                'data' => $game,
                'message' => 'Juego Agregado Correctamente'
            ], Response::HTTP_CREATED);
        } catch (\Throwable $th) {
            // Si ocurre un error, obtenemos el mensaje de error, la traza y lo guardamos en el log
            $response = [
                'message' => 'Transaction Error',
                'error' => $th->getMessage(),
                'trace' => $th->getTraceAsString()
            ];
            Log::error('LOG ERROR CREATE GAME.', $response);
            // Deshacemos la transacción de la BD
            DB::rollBack();
            // Retornamos la respuesta de error
            return new JsonResponse([
                'response' => $response
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(GameRequest $request, $id)
    {
        Log::info($request);
        // Obtenemos los parámetros de la petición
        $data = $this->getGameParams();
        // Iniciamos la transacción de la BD
        DB::beginTransaction();
        try {
            // Actualizamos el juego con los datos recibidos
            $game = $this->repository->update($data, $id);
            DB::commit();
            // Retornamos la respuesta exitosa
            return new JsonResponse([
                'data' => $game,
                'message' => 'Juego Actualizado Correctamente.'
            ], Response::HTTP_OK);
        } catch (\Throwable $th) {
            // Si ocurre un error, obtenemos el mensaje de error, la traza y lo guardamos en el log
            $response = [
                'message' => 'Transaction Error',
                'error' => $th->getMessage(),
                'trace' => $th->getTraceAsString()
            ];
            Log::error('LOG ERROR UPDATE GAME.', $response);
            // Deshacemos la transacción de la BD
            DB::rollBack();
            // Retornamos la respuesta de error
            return new JsonResponse([
                'response' => $response
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    // Método para obtener un juego por su id
    public function find($id)
    {
        // Buscamos el juego con el ID proporcionado utilizando el repositorio
        $game = $this->repository->find($id);
        // Retornamos una respuesta con el juego encontrado
        return new JsonResponse([
            'data' => $game
        ], Response::HTTP_OK);
    }

    // Método para eliminar un juego por su id
    public function delete($id)
    {
        // Llamamos al método delete del repositorio para eliminar el juego con el id proporcionado
        $this->repository->delete($id);
        // Retornamos una respuesta con un mensaje indicando que el juego fue eliminado correctamente
        return new JsonResponse([
            'message' => 'Juego Eliminado Correctamente.'
        ], Response::HTTP_OK);
    }
}
