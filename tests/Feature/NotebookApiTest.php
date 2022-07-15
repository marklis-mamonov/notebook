<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use App\Models\Note;
use Tests\TestCase;

class NotebookApiTest extends TestCase
{

    use WithFaker;
    use RefreshDatabase;

    public function test_notes_api_index()
    {
        $this->json('get', '/api/v1/notebook')
         ->assertStatus(Response::HTTP_OK)
         ->assertJsonStructure(
             [
                 'data' => [
                     '*' => [
                         'id',
                         'name',
                         'company',
                         'phone',
                         'email',
                         'birthdate',
                         'photo'
                     ]
                 ]
             ]
         );
    }

    public function test_notes_api_store()
    {
        $noteData = [
            'name'       => $this->faker->lastName,
            'phone'      => $this->faker->phoneNumber,
            'email'      => $this->faker->email
        ];
        $this->json('post', '/api/v1/notebook', $noteData)
             ->assertStatus(Response::HTTP_CREATED)
             ->assertJsonStructure(
                 [
                     'data' => [
                        'id',
                        'name',
                        'company',
                        'phone',
                        'email',
                        'birthdate',
                        'photo'
                     ]
                 ]
             );
        $this->assertDatabaseHas('notes', $noteData);
    }
    
    public function test_notes_api_show()
    {
        $noteData = [
            'name'       => $this->faker->lastName,
            'phone'      => $this->faker->phoneNumber,
            'email'      => $this->faker->email
        ];

        $note = Note::create($noteData);

        $this->json('get', "/api/v1/notebook/$note->id")
             ->assertStatus(Response::HTTP_OK)
             ->assertExactJson(
                 [
                     'data' => [
                        'id' => $note->id,
                        'name' => $note->name,
                        'company' => null,
                        'phone' => $note->phone,
                        'email' => $note->email,
                        'birthdate' => null,
                        'photo' => null
                     ]
                 ]
             );
    }
    
    
    public function test_notes_api_update()
    {
        $noteData = [
            'name'       => $this->faker->lastName,
            'phone'      => $this->faker->phoneNumber,
            'email'      => $this->faker->email
        ];

        $note = Note::create($noteData);

        $noteData = [
            'name'       => $this->faker->lastName,
            'phone'      => $this->faker->phoneNumber,
            'email'      => $this->faker->email
        ];

        $this->json('patch', "/api/v1/notebook/$note->id", $noteData)
             ->assertStatus(Response::HTTP_OK)
             ->assertExactJson(
                 [
                     'data' => [
                        'id' => $note->id,
                        'name' => $noteData['name'],
                        'company' => null,
                        'phone' => $noteData['phone'],
                        'email' => $noteData['email'],
                        'birthdate' => null,
                        'photo' => null
                     ]
                 ]
             );
    }
    
    public function test_notes_api_destroy()
    {
        $noteData = [
            'name'       => $this->faker->lastName,
            'phone'      => $this->faker->phoneNumber,
            'email'      => $this->faker->email
        ];

        $note = Note::create($noteData);

        $this->json('delete', "/api/v1/notebook/$note->id")
            ->assertStatus(Response::HTTP_OK);
        $this->assertDatabaseMissing('notes', $noteData);
    }
 
}
