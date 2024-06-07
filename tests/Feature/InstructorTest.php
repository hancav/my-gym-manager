<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\ClassTypeSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\ClassType;
use App\Models\ScheduledClass;

class InstructorTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_instructor_is_redirected_to_instructor_dashboard(): void
    {
        $user =User::factory()->create(['role' => 'instructor']);

        $response = $this->actingAs($user)->get('/dashboard');

        $response->assertRedirectToRoute('instructor.dashboard');

        $this->followRedirects($response)->assertSeeText('Private Instructor Area');
    }

    /**
     * A basic feature test example.
     */
    public function test_instructor_can_schedule_a_class(): void
    {
        // Given
        $user = User::factory()->create(['role' => 'instructor']);
        $this->seed(ClassTypeSeeder::class);

        // When
        $response = $this->actingAs($user)->post('instructor/schedule', [
            'class_type_id' => ClassType::first()->id,
            'date' => '2024-06-20',
            'time' => '12:00:00',
        ]);

        // Then
        $this->assertDatabaseHas('scheduled_classes', [
            'class_type_id' => ClassType::first()->id,
            'date_time' => '2024-06-20 12:00:00',
            'instructor_id' => $user->id,
        ]);
        $response->assertRedirectToRoute('schedule.index');

    }

    /**
     * A basic feature test example.
     */
    public function test_instructor_can_cancel_class(): void
    {
        // Given
        $user = User::factory()->create(['role' => 'instructor']);
        $this->seed(ClassTypeSeeder::class);
        $scheduledClass = ScheduledClass::create([
            'instructor_id' => $user->id,
            'class_type_id' => ClassType::first()->id,
            'date_time' => '2024-06-20 12:00:00',
        ]);

        // When
        $response = $this->actingAs($user)->delete("instructor/schedule/".$scheduledClass->id);

        // Then
        $this->assertDatabaseMissing('scheduled_classes', ['id' => $scheduledClass->id,]);
        $response->assertRedirectToRoute('schedule.index');
    }

    /**
     * A basic feature test example.
     */
    public function test_cannot_cancel_class_less_than_two_hours_before(): void
    {
        // Given
        $user = User::factory()->create(['role' => 'instructor']);
        $this->seed(ClassTypeSeeder::class);
        $scheduledClass = ScheduledClass::create([
            'instructor_id' => $user->id,
            'class_type_id' => ClassType::first()->id,
            'date_time' => now()->addHours(1)->minutes(0)->seconds(0),
        ]);

        // When

        $response = $this->actingAs($user)->get("instructor/schedule");
        $response->assertDontSeeText('Cancel');

        $response = $this->actingAs($user)->delete("instructor/schedule/".$scheduledClass->id);

        // Then
        $this->assertDatabaseHas('scheduled_classes', ['id' => $scheduledClass->id,]);
    
    }



}
