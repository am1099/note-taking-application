<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;

class NoteController extends Controller
{

    public function getNotes()
    {
        return response()->json(['success' => true, 'note' => Note::get()]);
    }


    public function getNotesById($id)
    {
        return response()->json(['success' => true, 'note' => Note::whereId($id)->first()]);
    }


    public function createNote(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'title' => ['required', 'max:255'],
            'content' => ['required'],
        ]);

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


    public function updateNote(Request $request, $id)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'title' => ['required', 'max:255'],
            'content' => ['required'],
        ]);

        try {
            Note::whereId($id)->first()->update($request);

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
