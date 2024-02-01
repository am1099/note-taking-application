<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Http\Requests\NoteRequest;

class NoteController extends Controller
{

    public function getNotes()
    {
        return response()->json(['success' => true, 'notes' => Note::get()]);
    }


    public function getNotesById($id)
    {
        return response()->json(['success' => true, 'note' => Note::whereId($id)->first()]);
    }


    public function createNote(NoteRequest $request)
    {
        // Validate the incoming request data
        // $request->validate([
        //     'title' => ['required', 'max:255'],
        //     'content' => ['required'],
        // ]);

        try {
            Note::create([
                "title" => $request->title,
                "content" => $request->content,
            ]);
            return response()->json(['success' => true, 'notes' => $this->getNotes()]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()]);
        }
    }


    public function updateNote(NoteRequest $request, $id)
    {
        // Validate the incoming request data
        // $request->validate([
        //     'title' => ['required', 'max:255'],
        //     'content' => ['required'],
        // ]);

        try {
            Note::whereId($id)->first()->update([
                "title" => $request->title,
                "content" => $request->content,
            ]);

            return response()->json(['success' => true, 'notes' => $this->getNotes()]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()]);
        }
    }


    public function deleteNote($id)
    {
        try {
            $note = Note::findOrFail($id);
            $note->delete();
            return response()->json(['success' => true, 'notes' => $this->getNotes()]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()]);
        }
    }
}
