<?php

namespace App\Http\Controllers\editor;

use App\Http\Controllers\Controller;
use App\Models\Professional;
use App\Services\FileUploadService;
use Illuminate\Http\Request;

class ProfessionalController extends Controller
{
    protected $fileUploadService;

    public function __construct(FileUploadService $fileUploadService)
    {
        $this->fileUploadService = $fileUploadService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $professionals = Professional::orderBy('category')->orderBy('order')->get();
        return view('pages.editor.professional.index', compact('professionals'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.editor.professional.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'position_id' => 'required|string|max:255',
            'category' => 'required|in:board_of_director,management',
            'details' => 'nullable|string',
            'photo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'order' => 'nullable|integer'
        ]);

        $data = $request->only(['name', 'position', 'position_id', 'category', 'details', 'order']);
        
        if ($request->hasFile('photo')) {
            $data['photo'] = $this->fileUploadService->uploadFile($request->file('photo'), 'img/professionals');
        }

        Professional::create($data);

        return redirect()->route('editor.professional')->with('success', 'Professional added successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $professional = Professional::findOrFail($id);
        return view('pages.editor.professional.edit', compact('professional'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'position_id' => 'required|string|max:255',
            'category' => 'required|in:board_of_director,management',
            'details' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'order' => 'nullable|integer'
        ]);

        $professional = Professional::findOrFail($id);
        $data = $request->only(['name', 'position', 'position_id', 'category', 'details', 'order']);
        
        if ($request->hasFile('photo')) {
            if ($professional->photo) {
                $this->fileUploadService->deleteFile($professional->photo);
            }
            $data['photo'] = $this->fileUploadService->uploadFile($request->file('photo'), 'img/professionals');
        }

        $professional->update($data);

        return redirect()->route('editor.professional')->with('success', 'Professional updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $professional = Professional::findOrFail($id);
        
        if ($professional->photo) {
            $this->fileUploadService->deleteFile($professional->photo);
        }
        
        $professional->delete();

        return redirect()->route('editor.professional')->with('success', 'Professional deleted successfully');
    }
}
