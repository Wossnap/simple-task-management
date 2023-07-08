<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\Project;
use App\Models\Task;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TasksTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic test example.
     */
    public function test_task_priority_can_be_updated_from_low_priority_to_higher1(): void
    {
        $project = Project::factory()->create();
        $task1 = Task::factory()->for($project)->create();
        $task2 = Task::factory()->for($project)->create();
        $task3 = Task::factory()->for($project)->create();
        $task4 = Task::factory()->for($project)->create();
        $task5 = Task::factory()->for($project)->create();
        $task6 = Task::factory()->for($project)->create();
        $task7 = Task::factory()->for($project)->create();

        $url = 'tasks/' . $task6->id . '/update-priority';
        $response = $this->post($url, [
            'prev_task_id' => $task2->id
        ]);
        $response->assertStatus(200);

        $this->assertEquals(1, $task1->refresh()->priority);
        $this->assertEquals(2, $task2->refresh()->priority);
        $this->assertEquals(3, $task6->refresh()->priority);
        $this->assertEquals(4, $task3->refresh()->priority);
        $this->assertEquals(5, $task4->refresh()->priority);
        $this->assertEquals(6, $task5->refresh()->priority);
        $this->assertEquals(7, $task7->refresh()->priority);
    }

    public function test_task_priority_can_be_updated_from_high_priority_to_lower1(): void
    {
        $project = Project::factory()->create();
        $task1 = Task::factory()->for($project)->create();
        $task2 = Task::factory()->for($project)->create();
        $task3 = Task::factory()->for($project)->create();
        $task4 = Task::factory()->for($project)->create();
        $task5 = Task::factory()->for($project)->create();
        $task6 = Task::factory()->for($project)->create();
        $task7 = Task::factory()->for($project)->create();

        $url = 'tasks/' . $task1->id . '/update-priority';
        $response = $this->post($url, [
            'prev_task_id' => $task2->id
        ]);
        $response->assertStatus(200);

        $this->assertEquals(1, $task2->refresh()->priority);
        $this->assertEquals(2, $task1->refresh()->priority);
        $this->assertEquals(3, $task3->refresh()->priority);
        $this->assertEquals(4, $task4->refresh()->priority);
        $this->assertEquals(5, $task5->refresh()->priority);
        $this->assertEquals(6, $task6->refresh()->priority);
        $this->assertEquals(7, $task7->refresh()->priority);
    }
    public function test_task_priority_can_be_updated_from_high_priority_to_lower2(): void
    {
        $project = Project::factory()->create();
        $task1 = Task::factory()->for($project)->create();
        $task2 = Task::factory()->for($project)->create();
        $task3 = Task::factory()->for($project)->create();
        $task4 = Task::factory()->for($project)->create();
        $task5 = Task::factory()->for($project)->create();
        $task6 = Task::factory()->for($project)->create();
        $task7 = Task::factory()->for($project)->create();

        $url = 'tasks/' . $task2->id . '/update-priority';
        $response = $this->post($url, [
            'prev_task_id' => $task5->id
        ]);
        $response->assertStatus(200);

        $this->assertEquals(1, $task1->refresh()->priority);
        $this->assertEquals(2, $task3->refresh()->priority);
        $this->assertEquals(3, $task4->refresh()->priority);
        $this->assertEquals(4, $task5->refresh()->priority);
        $this->assertEquals(5, $task2->refresh()->priority);
        $this->assertEquals(6, $task6->refresh()->priority);
        $this->assertEquals(7, $task7->refresh()->priority);
    }

    public function test_task_priority_will_be_updated_when_a_task_gets_deleted(): void
    {
        $project = Project::factory()->create();
        $task1 = Task::factory()->for($project)->create();
        $task2 = Task::factory()->for($project)->create();
        $task3 = Task::factory()->for($project)->create();
        $task4 = Task::factory()->for($project)->create();
        $task5 = Task::factory()->for($project)->create();
        $task6 = Task::factory()->for($project)->create();
        $task7 = Task::factory()->for($project)->create();

        $url = 'tasks/' . $task3->id;
        $response = $this->delete($url);


        $response->assertStatus(302);

        $this->assertNull(Task::find($task3->id));

        $this->assertEquals(1, $task1->refresh()->priority);
        $this->assertEquals(2, $task2->refresh()->priority);
        $this->assertEquals(3, $task4->refresh()->priority);
        $this->assertEquals(4, $task5->refresh()->priority);
        $this->assertEquals(5, $task6->refresh()->priority);
        $this->assertEquals(6, $task7->refresh()->priority);
    }
}
