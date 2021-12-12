<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Module;

class LessonTest extends TestCase
{
    public $course;
    public $module;
    public $lesson;

    protected function setUp(): void
    {  
        parent::setUp();
        
        $this->course = Course::factory()->create();

        $this->module = Module::factory()->create([
            'course_id' => $this->course->id
        ]);

        $this->lesson = Lesson::factory()->create([
            'module_id' => $this->module->id
        ]);

        Lesson::factory()->count(9)->create([
            'module_id' => $this->module->id
        ]);

    }

     /**
     * Test Get ALL Lessons By Module
     *
     * @return void
     */
    public function test_get_all_lessons_by_module()
    {
        $response = $this->getJson("api/courses/{$this->course->uuid}/modules/{$this->module->uuid}/lessons");

        $response->assertStatus(200)
                    ->assertJsonCount(10, 'data');
    }

    public function test_notfound_lessons_by_module()
    {
        $response = $this->getJson('api/courses/fake_value/modules/fake_value/lessons');

        $response->assertStatus(404);
    }

    public function test_get_lesson_by_module()
    {
        $response = $this->getJson("api/courses/{$this->course->uuid}/modules/{$this->module->uuid}/lessons/{$this->lesson->uuid}");

        $response->assertStatus(200);
    }

    public function test_validations_create_lesson_by_module()
    {
        $response = $this->postJson("api/courses/{$this->course->uuid}/modules/{$this->module->uuid}/lessons", []);

        $response->assertStatus(422);
    }

    public function test_create_lesson_by_module()
    {
        $response = $this->postJson("api/courses/{$this->course->uuid}/modules/{$this->module->uuid}/lessons", [
            'module' => $this->module->uuid,
            'name' => 'Aula 01',
            'video' => uniqid(date('YmdHis')),
        ]);

        $response->assertStatus(201);
    }

    public function test_validations_update_lesson_by_module()
    {
        $response = $this->putJson("api/courses/{$this->course->uuid}/modules/{$this->module->uuid}/lessons/{$this->lesson->uuid}", []);

        $response->assertStatus(422);
    }

    public function test_update_lesson_by_module()
    {
        $response = $this->putJson("api/courses/{$this->course->uuid}/modules/{$this->module->uuid}/lessons/{$this->lesson->uuid}", [
            'module' => $this->module->uuid,
            'name' => 'Aula Updated',
            'video' => uniqid(date('YmdHis')),
        ]);

        $response->assertStatus(200);
    }

    public function test_notfound_delete_lesson_by_module()
    {
        $response = $this->deleteJson("api/courses/{$this->course->uuid}/modules/{$this->module->uuid}/lessons/fake_value");

        $response->assertStatus(404);
    }

    public function test_delete_lesson_by_module()
    {
        $response = $this->deleteJson("api/courses/{$this->course->uuid}/modules/{$this->module->uuid}/lessons/{$this->lesson->uuid}");

        $response->assertStatus(204);
    }
}