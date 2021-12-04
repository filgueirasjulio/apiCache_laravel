<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Services\CourseService;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateCourseRequest;
use App\Http\Resources\CourseResource;

class CourseController extends Controller
{
    protected $courseService;

    public function __construct(CourseService $courseService)
    {
        $this->courseService = $courseService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = $this->courseService->getCourses();

        return CourseResource::collection($courses);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateCourseRequest $request)
    {
        $course = $this->courseService->storeNewCourse($request->validated());

        return new CourseResource($course);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $identify
     * @return \Illuminate\Http\Response
     */
    public function show($identify)
    {
        $course = $this->courseService->getCourse($identify);

        return new CourseResource($course);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $identify
     * @return \Illuminate\Http\Response
     */
    public function destroy($identify)
    {
        $course = $this->courseService->deleteCourse($identify);

        return response()->json([], 204);
    }
}
