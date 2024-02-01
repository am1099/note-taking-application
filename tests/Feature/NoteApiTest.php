<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Note;


class NoteApiTest extends TestCase
{
    use RefreshDatabase;

    public function testGetAllNotes()
    {
        Note::factory()->count(3)->create();
        $response = $this->get('/api/notes');

        $response->assertStatus(200);
        $response->assertJsonCount(3, 'data');
    }

    public function testGetSingleNote()
    {
        $note = Note::factory()->create();
        $response = $this->get("/api/notes/{$note->id}");

        $response->assertStatus(200);
        $response->assertJson(['data' => $note->toArray()]);
    }

    public function testCreateNote()
    {
        $noteData = Note::factory()->make()->toArray();
        $response = $this->post('/api/notes', $noteData);

        $response->assertStatus(201);
        $this->assertDatabaseHas('notes', $noteData);
    }

    public function testUpdateNote()
    {
        $note = Note::factory()->create();
        $updatedNoteData = ['title' => 'Updated Title', 'content' => 'Updated Content'];

        $response = $this->put("/api/notes/{$note->id}", $updatedNoteData);
        $response->assertStatus(200);
        $this->assertDatabaseHas('notes', array_merge(['id' => $note->id], $updatedNoteData));
    }

    public function testDeleteNote()
    {
        $note = Note::factory()->create();
        $response = $this->delete("/api/notes/{$note->id}");

        $response->assertStatus(204);
        $this->assertDatabaseMissing('notes', ['id' => $note->id]);
    }
}
