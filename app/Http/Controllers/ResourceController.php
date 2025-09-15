<?php

namespace App\Http\Controllers;

use App\Models\Resource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResourceController extends Controller
{
    public function index()
    {
        $resources = Resource::latest()->get(); // Or filter by type if you want
        return view('counselor.counselorResource', compact('resources'));
    }

    public function create()
    {
        return view('counselor.counselorResourceCreate');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'type' => 'required|in:video,tool,article',
            'file_path' => 'nullable|file|mimes:mp4,pdf,docx,txt'
        ]);

        $data = $request->all();
        if ($request->hasFile('file_path')) {
            $data['file_path'] = $request->file('file_path')->store('resources', 'public');
        }
        $data['created_by'] = auth()->id();

        Resource::create($data);

        return redirect()->route('counselor.resources.index')->with('success', 'Resource added!');
    }

}

