<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Statistic;
use Illuminate\Http\Request;
use App\Services\FileUploadService;

class StatisticController extends Controller
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
        $statistics = Statistic::orderBy('order')->get();
        return view('pages.editor.statistic.index', compact('statistics'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.editor.statistic.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'label' => 'required|string|max:255',
            'value' => 'required|integer',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
            'order' => 'nullable|integer'
        ]);

        $data = $request->only(['label', 'value', 'order']);
        
        if ($request->hasFile('icon')) {
            $data['icon'] = $this->fileUploadService->uploadFile($request->file('icon'), 'img/statistics');
        }

        Statistic::create($data);

        return redirect()->route('statistic.index')->with('success', 'Statistic created successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $statistic = Statistic::findOrFail($id);
        return view('pages.editor.statistic.edit', compact('statistic'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'label' => 'required|string|max:255',
            'value' => 'required|integer',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
            'order' => 'nullable|integer'
        ]);

        $statistic = Statistic::findOrFail($id);
        $data = $request->only(['label', 'value', 'order']);
        
        if ($request->hasFile('icon')) {
            // Delete old icon if exists
            if ($statistic->icon) {
                $this->fileUploadService->deleteFile($statistic->icon);
            }
            $data['icon'] = $this->fileUploadService->uploadFile($request->file('icon'), 'img/statistics');
        }

        $statistic->update($data);

        return redirect()->route('statistic.index')->with('success', 'Statistic updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $statistic = Statistic::findOrFail($id);
        
        if ($statistic->icon) {
            $this->fileUploadService->deleteFile($statistic->icon);
        }
        
        $statistic->delete();

        return redirect()->route('statistic.index')->with('success', 'Statistic deleted successfully');
    }
}
