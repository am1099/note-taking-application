<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Http\Requests\NoteRequest;

class NoteController extends Controller
{

    public function getNotes()
    {
        return response()->json(['success' => true, 'notes' => Note::get()], 200);
    }


    public function getNotesById($id)
    {
        $note = Note::whereId($id)->first();

        if (is_null($note)) {
            return response()->json(['success' => true, 'error' => 'Note not Found'], 404);
        }

        return response()->json(['success' => true, 'note' => $note], 201);
    }


    public function createNote(NoteRequest $request)
    {
        try {
            Note::create([
                "title" => $request->title,
                "content" => $request->content,
            ]);
            return response()->json(['success' => true, 'notes' => $this->getNotes()]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()], 404);
        }
    }


    public function updateNote(NoteRequest $request, $id)
    {
        try {
            Note::whereId($id)->first()->update([
                "title" => $request->title,
                "content" => $request->content,
            ]);

            return response()->json(['success' => true, 'notes' => $this->getNotes()], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()], 404);
        }
    }


    public function deleteNote($id)
    {
        try {
            $note = Note::findOrFail($id);
            $note->delete();
            return response()->json(['success' => true, 'notes' => $this->getNotes()], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()], 404);
        }
    }
}
