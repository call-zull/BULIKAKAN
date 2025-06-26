<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\DataTables\CarouselDataTable;
use App\Models\Carousel;
use Illuminate\Http\Request;

class CarouselController extends Controller
{
    public function index(CarouselDataTable $dataTable)
    {
        return $dataTable->render('pages.admin.carousel.index');
    }

    public function create()
    {
        return view('pages.admin.carousel.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'foto' => 'required|image|max:2048',
            'link' => 'nullable|url',
            'is_published' => 'boolean',
        ]);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('carousel', 'public');
        }

        Carousel::create($data);

        return redirect()->route('admin.carousel.index')->with('success', 'Carousel berhasil ditambahkan.');
    }

    public function edit(Carousel $carousel)
    {
        return view('pages.admin.carousel.edit', compact('carousel'));
    }

    public function update(Request $request, Carousel $carousel)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'foto' => 'nullable|image|max:2048',
            'link' => 'nullable|url',
            'is_published' => 'boolean',
        ]);

        if ($request->hasFile('foto')) {
            
            \Storage::disk('public')->delete($carousel->foto);
            $data['foto'] = $request->file('foto')->store('carousel', 'public');
        }

        $carousel->update($data);

        return redirect()->route('admin.carousel.index')->with('success', 'Carousel berhasil diupdate.');
    }

    public function destroy(Carousel $carousel)
    {
        \Storage::disk('public')->delete($carousel->foto);
        $carousel->delete();

        return redirect()->route('admin.carousel.index')->with('success', 'Carousel berhasil dihapus.');
    }
}