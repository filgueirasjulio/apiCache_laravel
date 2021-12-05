<?php

namespace App\Http\Controllers\Api;

use App\Services\LessonService;

use App\Http\Controllers\Controller;
use App\Http\Resources\LessonResource;
use App\Http\Requests\StoreUpdateLessonRequest;


class LessonController extends Controller
{
    protected $lessonService;

    public function __construct(LessonService $lessonService)
    {
        $this->lessonService = $lessonService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($module_uuid)
    {
        $lessons = $this->lessonService->getLessonsByModule($module_uuid);

        return LessonResource::collection($lessons);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateLessonRequest $request)
    {
        $module = $this->lessonService->createNewLesson($request->validated());

        return new LessonResource($module);
    }

    /**
     * Display the specified resource.
     *
     * @param string $module_uuid
     * @param  string  $lesson_uuid
     * @return \Illuminate\Http\Response
     */
    public function show($module_uuid, $lesson_uuid)
    {
        $module = $this->lessonService->getLessonByModule($module_uuid, $lesson_uuid);

        return new LessonResource($module);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $lesson_uuid
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateLessonRequest $request, $lesson_uuid)
    {
        $this->lessonService->updateLesson($lesson_uuid, $request->validated());

        return response()->json(['message' => 'updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $lesson_uuid
     * @return \Illuminate\Http\Response
     */
    public function destroy($lesson_uuid)
    {
        $this->lessonService->deleteLesson($lesson_uuid);

        return response()->json([], 204);
    }
}