<?php

namespace App\Http\Controllers;

use App\Models\TemplateSurat;
use Illuminate\Http\Request;

class TemplateSuratController extends Controller
{
    public function index()
    {
        $templates = TemplateSurat::latest()->get();
        return view('template.index', compact('templates'));
    }

    public function create()
    {
        $fields = [
            'nik',
            'nama',
            'tempat_lahir',
            'tanggal_lahir',
            'jenis_kelamin',
            'alamat',
            'agama',
            'pekerjaan',
            'status_perkawinan',
            'nomor_telepon',
        ];
        return view('template.create', compact('fields'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_template' => 'required|string|max:255',
            'file_word'     => 'required|file|mimes:docx|max:5120',
        ]);

        $file     = $request->file('file_word');
        $filename = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
        $file->move(public_path('templates'), $filename);

        TemplateSurat::create([
            'nama_template' => $request->nama_template,
            'file_word'     => $filename,
        ]);

        return redirect()->route('template.index')
            ->with('success', 'Template surat berhasil ditambahkan.');
    }

    public function edit(TemplateSurat $template)
    {
        $fields = [
            'nik',
            'nama',
            'tempat_lahir',
            'tanggal_lahir',
            'jenis_kelamin',
            'alamat',
            'agama',
            'pekerjaan',
            'status_perkawinan',
            'nomor_telepon',
        ];
        return view('template.edit', compact('template', 'fields'));
    }

    public function update(Request $request, TemplateSurat $template)
    {
        $request->validate([
            'nama_template' => 'required|string|max:255',
            'file_word'     => 'nullable|file|mimes:docx|max:5120',
        ]);

        $data = ['nama_template' => $request->nama_template];

        if ($request->hasFile('file_word')) {
            // Hapus file lama
            $oldPath = public_path('templates/' . $template->file_word);
            if (file_exists($oldPath)) {
                unlink($oldPath);
            }

            // Simpan file baru
            $file     = $request->file('file_word');
            $filename = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
            $file->move(public_path('templates'), $filename);

            $data['file_word'] = $filename;
        }

        $template->update($data);

        return redirect()->route('template.index')
            ->with('success', 'Template surat berhasil diperbarui.');
    }

    public function destroy(TemplateSurat $template)
    {
        $path = public_path('templates/' . $template->file_word);

        if (file_exists($path)) {
            unlink($path);
        }

        $template->delete();

        return redirect()->route('template.index')
            ->with('success', 'Template surat berhasil dihapus.');
    }
}
