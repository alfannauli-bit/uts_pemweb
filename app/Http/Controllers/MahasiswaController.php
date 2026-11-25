<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use Throwable;

class MahasiswaController extends Controller
{
    public function index(): View
    {
        $mahasiswas = Mahasiswa::query()->latest()->get();

        return view('mahasiswa.index', compact('mahasiswas'));
    }

    public function create(): View
    {
        return view('mahasiswa.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'nim' => ['required', 'string', 'max:255', 'unique:mahasiswas,nim'],
            'deskripsi' => ['required', 'string'],
            'foto' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        $fotoPath = null;
        try {
            if ($request->hasFile('foto')) {
                $fotoPath = $request->file('foto')->store('mahasiswa', 'public');
            }

            Mahasiswa::create([
                'nama' => $validated['nama'],
                'nim' => $validated['nim'],
                'deskripsi' => $validated['deskripsi'],
                'foto_path' => $fotoPath,
            ]);

            return redirect()->route('mahasiswa.index')
                ->with('success', 'Data mahasiswa berhasil ditambahkan.');
        } catch (Throwable $exception) {
            if ($fotoPath) {
                Storage::disk('public')->delete($fotoPath);
            }

            report($exception);

            return back()->withInput()
                ->with('error', 'Data mahasiswa gagal disimpan. Silakan coba lagi.');
        }
    }

    public function edit(Mahasiswa $mahasiswa): View
    {
        return view('mahasiswa.edit', compact('mahasiswa'));
    }

    public function update(Request $request, Mahasiswa $mahasiswa): RedirectResponse
    {
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'nim' => [
                'required',
                'string',
                'max:255',
                Rule::unique('mahasiswas', 'nim')->ignore($mahasiswa->id),
            ],
            'deskripsi' => ['required', 'string'],
            'foto' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        $oldFotoPath = $mahasiswa->foto_path;
        $newFotoPath = null;
        try {
            if ($request->hasFile('foto')) {
                $newFotoPath = $request->file('foto')->store('mahasiswa', 'public');
            }

            $mahasiswa->update([
                'nama' => $validated['nama'],
                'nim' => $validated['nim'],
                'deskripsi' => $validated['deskripsi'],
                'foto_path' => $newFotoPath ?? $oldFotoPath,
            ]);

            if ($newFotoPath && $oldFotoPath) {
                Storage::disk('public')->delete($oldFotoPath);
            }

            return redirect()->route('mahasiswa.index')
                ->with('success', 'Biodata mahasiswa berhasil diperbarui.');
        } catch (Throwable $exception) {
            if ($newFotoPath) {
                Storage::disk('public')->delete($newFotoPath);
            }

            report($exception);

            return back()->withInput()
                ->with('error', 'Biodata mahasiswa gagal diperbarui. Silakan coba lagi.');
        }
    }

    public function destroy(Mahasiswa $mahasiswa): RedirectResponse
    {
        $fotoPath = $mahasiswa->foto_path;
        try {
            $mahasiswa->delete();

            if ($fotoPath) {
                Storage::disk('public')->delete($fotoPath);
            }

            return redirect()->route('mahasiswa.index')
                ->with('success', 'Data mahasiswa berhasil dihapus.');
        } catch (Throwable $exception) {
            report($exception);

            return redirect()->route('mahasiswa.index')
                ->with('error', 'Data mahasiswa gagal dihapus. Silakan coba lagi.');
        }
    }
}
