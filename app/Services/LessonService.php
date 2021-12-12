<?php

namespace App\Services;

use App\Repositories\{
    CourseRepository,
    LessonRepository,
    ModuleRepository
};

class LessonService
{
    protected $lessonRepository, $courseRepository, $moduleRepository;
    
    /**
     * __construct
     *
     * @return void
     */
    public function __construct(
        LessonRepository $lessonRepository,
        CourseRepository $courseRepository,
        ModuleRepository $moduleRepository
    ) {
        $this->lessonRepository = $lessonRepository;
        $this->courseRepository = $courseRepository;
        $this->moduleRepository = $moduleRepository;
    }
    
    /**
     * getLessonsByModule
     * 
     * @return object
     */
    public function getLessonsByModule(string $course_uuid, string $module_uuid)
    {
        $course = $this->courseRepository->getCourseByUuid($course_uuid);
        $module = $this->moduleRepository->getModuleByUuid($module_uuid);

        return $this->lessonRepository->getLessonsModule($module->id);
    }
    
    /**
     * createNewLesson
     * 
     * @return object
     */
    public function createNewLesson(array $data, string $course_uuid, string $module_uuid)
    {
        $course = $this->courseRepository->getCourseByUuid($course_uuid);
        $module = $this->moduleRepository->getModuleByUuid($module_uuid);

        return $this->lessonRepository->createNewLesson($module->id, $data);
    }
    
    /**
     * getLessonByModule
     * 
     * @return object
     */
    public function getLessonByModule(string $course_uuid, string $module_uuid, string $lesson_uuid)
    {
        $course = $this->courseRepository->getCourseByUuid($course_uuid);
        $module = $this->moduleRepository->getModuleByUuid($module_uuid);

        return $this->lessonRepository->getLessonByModule($module->id, $lesson_uuid);
    }
    
    /**
     * updateLesson
     * 
     * @return object
     */
    public function updateLesson(string $course_uuid, string $module_uuid, string $lesson_uuid, array $data)
    {
        $course = $this->courseRepository->getCourseByUuid($course_uuid);
        $module = $this->moduleRepository->getModuleByUuid($module_uuid);

        return $this->lessonRepository->updateLessonByUuid($module->id, $lesson_uuid, $data);
    }
    
    /**
     * deleteLesson
     * 
     * @return object
     */
    public function deleteLesson(string $course_uuid, string $module_uuid, string $lesson_uuid)
    {
        $course = $this->courseRepository->getCourseByUuid($course_uuid);
        $module = $this->moduleRepository->getModuleByUuid($module_uuid);

        return $this->lessonRepository->deleteLessonByUuid($lesson_uuid);
    }
}