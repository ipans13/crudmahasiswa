<?php
// app/Http/Controllers/MahasiswaController.php
namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function index()
    {
        $mahasiswa = Mahasiswa::paginate(10);
        return view('mahasiswa.index', compact('mahasiswa'))
               ->with('i', (request()->input('page', 1) - 1) * 10);
    }

    public function create()
    {
        return view('mahasiswa.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'kelas' => 'required',
        ]);

        Mahasiswa::create($request->all());

        return redirect()->route('mahasiswa.index')
                         ->with('success', 'Mahasiswa created successfully.');
    }

    public function show(Mahasiswa $mahasiswa)
    {
        return view('mahasiswa.show', compact('mahasiswa'));
    }

    public function edit(Mahasiswa $mahasiswa)
    {
        return view('mahasiswa.edit', compact('mahasiswa'));
    }

    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        $request->validate([
            'nama' => 'required',
            'kelas' => 'required',
        ]);

        $mahasiswa->update($request->all());

        return redirect()->route('mahasiswa.index')
                         ->with('success', 'Mahasiswa updated successfully');
    }

    public function destroy(Mahasiswa $mahasiswa)
    {
        $mahasiswa->delete();

        return redirect()->route('mahasiswa.index')
                         ->with('success', 'Mahasiswa deleted successfully');
    }
}
