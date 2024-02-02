<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Note;


class NoteApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_get_all_notes()
    {

        $response = $this->get('/api/notes');

        $response->assertStatus(200);
    }

    public function test_get_single_note()
    {
        $note = Note::factory()->create();

        $response = $this->get("/api/notes/{$note->id}");

        $response->assertStatus(201);
    }

    public function test_get_single_note_error()
    {
        $note = Note::factory()->create();

        $response = $this->get("/api/notes/sdgf");

        $response->assertStatus(404);
    }

    public function test_create_note()
    {
        $noteData = ['title' => 'Test title', 'content' => 'Test content'];
        $response = $this->post('/api/notes', $noteData);

        $response->assertStatus(200);
        $this->assertDatabaseHas('notes', $noteData);
    }

    public function test_create_note_with_empty_fields()
    {
        $noteData = ['title' => '', 'content' => ''];
        $response = $this->post('/api/notes', $noteData);

        $response->assertStatus(302)
            ->assertSessionHasErrors(['title', 'content']);
    }


    public function test_update_note()
    {
        $note = Note::factory()->create();

        $updatedNoteData = ['title' => 'Updated Title 2', 'content' => 'Updated Content 2'];

        $response = $this->put("/api/notes/{$note->id}", $updatedNoteData);
        $response->assertStatus(200);
        $this->assertDatabaseHas('notes', array_merge(['id' => $note->id], $updatedNoteData));
    }

    public function test_update_note_error()
    {
        $note = Note::factory()->create();
        $updatedNoteData = ['content' => 'Updated Content 2'];

        $response = $this->put("/api/notes/{$note->id}", $updatedNoteData);

        $response->assertStatus(302)
            ->assertSessionHasErrors(['title']);
    }

    public function test_delete_note()
    {
        $note = Note::factory()->create();
        $response = $this->delete("/api/notes/{$note->id}");

        $response->assertStatus(200);
        $this->assertDatabaseMissing('notes', ['id' => $note->id]);
    }

    public function test_delete_note_error()
    {
        $response = $this->delete("/api/notes/10000000");

        $response->assertStatus(404);
        $this->assertDatabaseMissing('notes', ['id' => 10000000]);
    }
}
