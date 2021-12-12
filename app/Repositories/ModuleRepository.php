<?php

namespace App\Repositories;

use App\Models\Module;
use Illuminate\Support\Facades\Cache;

class ModuleRepository
{

    protected $entity;

    /**
     * __construct
     *
     * @return void
     */
    public function __construct(Module $module)
    {
        $this->entity = $module;
    }

    /**
     * getModulesByCourse
     *
     * @return collection
     */
    public function getModulesByCourse($course_id)
    {
        $modules = $this->entity
                   ->where('course_id', $course_id) 
                   ->get();

        return $modules;
    }

     /**
     * getModuleByCourse
     *
     * @return void
     */
    public function getModuleByCourse(int $course_id, string $module_uuid)
    {
        return $this->entity
                  ->where('course_id', $course_id)
                  ->where('uuid', $module_uuid)
                  ->firstOrFail();
     }
    
    /**
     * getModuleByUuid
     *
     * @return object
     */
    public function getModuleByUuid(string $module_uuid)
    {
        return $this->entity
                  ->where('uuid', $module_uuid)
                  ->firstOrFail();
     }

    /**
     * storeNewCourse
     *
     * @return object
     */
    public function storeNewCourse(array $data, int $courseId)
    {
        $data['course_id'] = $courseId;

        Cache::forget('courses');

        return $this->entity->create($data);
    }
    
    /**
     * updateModule
     *
     * @return object
     */
    public function updateModule(array $data, int $courseId, string $module_uuid)
    {     
        $module = $this->getModuleByUuid($module_uuid);

        $data['course_id'] = $courseId;

        Cache::forget('courses');
     
        return $module->update($data);
    }
    
    /**
     * deleteModuleByUuid
     *
     * @return object
     */
    public function deleteModuleByUuid(string $module_uuid)
    {
        $module = $this->getModuleByUuid($module_uuid);

        Cache::forget('courses');
       
        return $module->delete();
    }
}
