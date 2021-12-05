<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Services\ModuleService;
use App\Http\Controllers\Controller;
use App\Http\Resources\ModuleResource;
use App\Http\Requests\StoreUpdateModuleRequest;

class ModuleController extends Controller
{
    protected $service;
        
    /**
     * __construct
     *
     * @param  mixed $service
     * @return void
     */
    public function __construct(ModuleService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(string $course)
    {
        $modules = $this->service->getModulesByCourse($course);

        return  ModuleResource::collection($modules);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateModuleRequest $request)
    {
        $module = $this->service->storeNewModule($request->validated());

        return new ModuleResource($module);
    }

     /**
     * Display the specified resource.
     *
     * @param  string  $course_uuid
     * @param  string  $module_uuid
     * @return \Illuminate\Http\Response
     */
    public function show(string $course_uuid, string $module_uuid)
    {
        $module = $this->service->getModuleByCOurse($course_uuid, $module_uuid);

        return new ModuleResource($module);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param string $module_uuid
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateModuleRequest $request, string $module_uuid)
    {
        $this->service->updateModule($request->validated(), $module_uuid);

        return response()->json(['message' => 'updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $module_uuid
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $module_uuid)
    {
        $module = $this->service->deleteModule($module_uuid);

        return response()->json([], 204);
    }
}
