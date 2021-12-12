<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use App\Models\Course;

class CourseTest extends TestCase
{
    public function test_get_all_courses()
    {
        $response = $this->getJson('/api/courses');

        $response->assertStatus(200);
    }

    public function test_get_count_courses()
    {
        Course::factory()->count(10)->create();
        
        $response = $this->getJson('/api/courses');
      
        $response->assertJsonCount(10, 'data');
        $response->assertStatus(200);
    }

    public function test_get_course()
    {
        $course = Course::factory()->create();

        $response = $this->getJson("api/courses/{$course->uuid}");

        $response->assertStatus(200);
    }

    public function test_get_course_notfound()
    {
        $response = $this->getJson('api/courses/fake_value');

        $response->assertStatus(404);
    }

    public function test_validations_create_course()
    {
        $response = $this->postJson('api/courses', []);

        $response->assertStatus(422);
    }

    public function test_create_course()
    {
        $response = $this->postJson('api/courses', [
            'title' => 'Novo Curso'
        ]);

        $response->assertStatus(201);
    }
    
    public function test_validation_update_course()
    {
        $course = Course::factory()->create();

        $response = $this->putJson("api/courses/{$course->uuid}", []);

        $response->assertStatus(422);
    }

    public function test_update_course()
    {
        $course = Course::factory()->create();

        $response = $this->putJson("api/courses/{$course->uuid}", [
            'title' => 'Novo nome de curso'
        ]);

        $response->assertStatus(200);
    }

       
    public function test_delete_course_404()
    {
        $response = $this->deleteJson("api/courses/fake_value");

        $response->assertStatus(404);
    }

    public function test_delete_course()
    {
        $course = Course::factory()->create();

        $response = $this->deleteJson("api/courses/{$course->uuid}");

        $response->assertStatus(204);
    }
}
