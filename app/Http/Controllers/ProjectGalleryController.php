<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectGalleryController extends Controller
{
    public function store(Request $request, Project $project)
    {
        $request->validate([
            'images' => 'required|array',
            'images.*' => [
                'required',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:4096',
            ],
        ]);

        // Hitung jumlah gambar yang sudah ada.
        $currentImages = $project->images()->count();

        // Hitung jumlah gambar yang akan diunggah.
        $newImages = count($request->file('images'));

        // Pastikan total gambar tidak lebih dari 10.
        if ($currentImages + $newImages > 10) {
            return back()
                ->withErrors([
                    'images' => 'Maksimal 10 gambar untuk setiap project. Saat ini sudah ada '
                        . $currentImages . ' gambar.',
                ])
                ->withInput();
        }

        foreach ($request->file('images') as $file) {
            $path = $file->store('projects/gallery', 'public');

            $project->images()->create([
                'image' => $path,
            ]);
        }

        return redirect()->route('projects.show', $project->id)
            ->with('success', 'Gallery berhasil diunggah.');
    }

    public function updateCaption(Request $request, Project $project, ProjectImage $image)
    {
        abort_unless($image->project_id === $project->id, 404);

        $validatedData = $request->validate([
            'caption' => 'nullable|string|max:255',
        ]);

        $image->update([
            'caption' => $validatedData['caption'] ?? null,
        ]);

        return redirect()->route('projects.show', $project->id)
            ->with('success', 'Caption gallery berhasil diperbarui.');
    }

    public function destroy(Project $project, ProjectImage $image)
    {
        // Pastikan gambar memang milik project tersebut.
        abort_unless($image->project_id === $project->id, 404);

        Storage::disk('public')->delete($image->image);

        $image->delete();

        return redirect()->route('projects.show', $project->id)
            ->with('success', 'Gambar gallery berhasil dihapus.');
    }
}