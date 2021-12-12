<?php

namespace App\Services;

use App\Repositories\CourseRepository;
use App\Repositories\ModuleRepository;

class ModuleService 
{
    protected $repository;
    protected $courseRepository;
    
    /**
     * __construct
     *
     * @return void
     */
    public function __construct(ModuleRepository $repository,
                                CourseRepository $courseRepository)
    {
        $this->repository = $repository;    
        $this->courseRepository = $courseRepository;
    }
    
    /**
     * getModulesByCourse
     *
     * @return collection
     */
    public function getModulesByCourse(string $course_uuid)
    {
        $course = $this->courseRepository->getCourseByUuid($course_uuid);

        return $this->repository->getModulesByCourse($course->id);
    }

    /**
     * getModule
     * 
     * @return collection
     */
    public function getModuleByCourse(string $course_uuid, string $module_uuid)
    {
        $course = $this->courseRepository->getCourseByUuid($course_uuid);

        return $this->repository->getModuleByCourse($course->id, $module_uuid);
    }
      
    /**
     * storeNewModule
     * 
     * @return object
     */
    public function storeNewModule(array $data, string $course_uuid) 
    {
        $course = $this->courseRepository->getCourseByUuid($course_uuid);
      
        return $this->repository->storeNewCourse($data, $course->id);
    }

    /**
     * updateModule
     * 
     * @return object
     */
    public function updateModule(array $data, string $course_uuid, string $module_uuid) 
    {
        $course = $this->courseRepository->getCourseByUuid($course_uuid);
    
        return $this->repository->updateModule($data, $course->id, $module_uuid);
    }
    
    /**
     * deleteModule
     * 
     * @return object
     */
    public function deleteModule(string $course_uuid, string $module_uuid)
    {
        $course = $this->courseRepository->getCourseByUuid($course_uuid);
    
        return $this->repository->deleteModuleByUuid($module_uuid);
    }
}