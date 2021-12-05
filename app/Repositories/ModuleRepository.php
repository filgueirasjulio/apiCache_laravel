<?php

namespace App\Repositories;

use App\Models\Module;

class ModuleRepository
{

    protected $entity;

    /**
     * __construct
     *
     * @param  mixed $module
     * @return void
     */
    public function __construct(Module $module)
    {
        $this->entity = $module;
    }

    /**
     * getModulesByCourse
     *
     * @param  mixed $course_id
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
     * @param  mixed $course_id
     * @param  mixed $module_uuid
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
     * @param  mixed $course_id
     * @param  mixed $module_uuid
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
     * @param  mixed $data
     * @param  mixed $course_id
     * @return object
     */
    public function storeNewCourse(array $data, int $courseId)
    {
        $data['course_id'] = $courseId;

        return $this->entity->create($data);
    }
    
    /**
     * updateModule
     *
     * @param  mixed $data
     * @param  mixed $courseId
     * @param  mixed $module_uuid
     * @return object
     */
    public function updateModule(array $data, int $courseId, string $module_uuid)
    {     
        $module = $this->getModuleByUuid($module_uuid);

        $data['course_id'] = $courseId;
     
        return $module->update($data);
    }
    
    /**
     * deleteModuleByUuid
     *
     * @param  mixed $module_uuid
     * @return object
     */
    public function deleteModuleByUuid(string $module_uuid)
    {
        $module = $this->getModuleByUuid($module_uuid);
       
        return $module->delete();
    }
}
