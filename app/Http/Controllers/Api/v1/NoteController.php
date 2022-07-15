<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Note;
use App\Http\Requests\NoteStoreRequest;
use App\Http\Requests\NoteUpdateRequest;
use App\Http\Resources\NoteResource;
use Illuminate\Validation\ValidationException;

class NoteController extends Controller
{

    protected $note;

    public function __construct(Note $note)
    {
        $this->note = $note;
    }

    /**
    * @OA\Get(
    *     path="/api/v1/notebook",
    *     summary="Получение всех записей постранично",
    *     tags={"Notes"},
    *     @OA\Parameter(name="per_page",in="query",description="Количество записей на странице",required=false),
    *     @OA\Response(
    *     response="200",
    *     description="Успешный запрос",
    *     @OA\JsonContent(ref="#/components/schemas/Note")
    *  )
    * )
    */

    public function index(Request $request)
    {
        $per_page = (is_int($request->per_page)) ? $request->per_page : 10;
        $notes = $this->note->paginate($per_page);
        return NoteResource::collection($notes);
    }

    /**
    * @OA\POST(
    *     path="/api/v1/notebook",
    *     summary="Добавление новой записи",
    *     tags={"Notes"},
    *     @OA\RequestBody(description="Данные о записи",required=true,@OA\JsonContent(ref="#/components/schemas/Note")),
    *     @OA\Response(
    *     response="201",
    *     description="Успешный запрос",
    *     @OA\JsonContent(ref="#/components/schemas/Note")
    *  ),
    *     @OA\Response(
    *     response="400",
    *     description="Ошибка валидации"
    *  )
    * )
    */

    public function store(NoteStoreRequest $request)
    {
        $note = $this->note->create($request->validated());
        return (new NoteResource($note))
        ->additional(['message' => "Запись добавлена"])
        ->response()
        ->setStatusCode(\Illuminate\Http\Response::HTTP_CREATED);;
    }

    /**
    * @OA\Get(
    *     path="/api/v1/notebook/{id}",
    *     summary="Получение одной записи",
    *     tags={"Notes"},
    *     @OA\Parameter(name="id",in="path",description="Id записи",required=true),
    *     @OA\Response(
    *     response="200",
    *     description="Успешный запрос",
    *     @OA\JsonContent(ref="#/components/schemas/Note")
    *  ),
    *     @OA\Response(
    *     response="404",
    *     description="Запись не найдена"
    *  )
    * )
    */

    public function show($id)
    {
        $note = Note::find($id);
        if ($note) {
            return new NoteResource($note);
        } else {
            return response()->json(['message' => "Запись не найдена"], 404);
        }
    }

    /**
    * @OA\PUT(
    *     path="/api/v1/notebook/{id}",
    *     summary="Изменение существующей записи",
    *     tags={"Notes"},
    *     @OA\Parameter(name="id",in="path",description="Id записи на изменение",required=false),
    *     @OA\RequestBody(description="Данные о записи",required=true,@OA\JsonContent(ref="#/components/schemas/Note")),
    *     @OA\Response(
    *     response="200",
    *     description="Успешный запрос",
    *     @OA\JsonContent(ref="#/components/schemas/Note")
    *  ),
    *     @OA\Response(
    *     response="400",
    *     description="Ошибка валидации"
    *  ),
    *     @OA\Response(
    *     response="404",
    *     description="Запись не найдена"
    *  )
    * )
    */

    public function update(NoteUpdateRequest $request, $id)
    {
        $note = $this->note->find($id);
        if ($note) {
            $note->update($request->validated());
            return new NoteResource($note);
        } else {
            return response()->json(['message' => "Запись не найдена"], 404);
        }
    }

    /**
    * @OA\DELETE(
    *     path="/api/v1/notebook/{id}",
    *     summary="Удаление записи",
    *     tags={"Notes"},
    *     @OA\Parameter(name="id",in="path",description="Id записи на удаление",required=false),
    *     @OA\Response(
    *     response="200",
    *     description="Успешный запрос"
    *  ),
    *     @OA\Response(
    *     response="404",
    *     description="Запись не найдена"
    *  )
    * )
    */

    public function destroy($id)
    {
        $note = $this->note->find($id);
        if ($note) {
            return ($note->delete()) ? ["message" => "Запись удалена"] : ["message" => "Не удалось удалить запись"];
        } else {
            return response()->json(['message' => "Запись не найдена"], 404);
        }
    }
}
