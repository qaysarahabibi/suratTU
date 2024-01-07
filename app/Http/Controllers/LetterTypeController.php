<?php

namespace App\Http\Controllers;

use App\Models\LetterType;
use App\Models\Letter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use PDF;

class LetterTypeController extends Controller
{
    public function index()
    {
        $klasifikasi = LetterType::withCount('letters')->get();
        return view('klasifikasi.index', compact('klasifikasi'));

    }
    public function create()
    {
        return view('klasifikasi.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'letter_code' => 'required',
            'name_type' => 'required',
        ]);

        $code = LetterType::count();

        LetterType::create([
            'letter_code' => $request->letter_code.'-'.$code,
            'name_type' => $request->name_type,
        ]);

        return redirect()->route('klasifikasi.index')->with('success', 'Berhasil menambahkan data Klasifikasi!');
    }
    // public function edit( string $id)
    // {
       
    // }

    public function edit($id)
    {
        $klasifikasi = LetterType::find($id);
        return view('klasifikasi.edit', compact('klasifikasi'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'letter_code' => 'required',
            'name_type' => 'required',
        ]);

        $klasifikasiData = [
            'letter_code' => $request->letter_code,
            'name_type' => $request->name_type,
        ];

        LetterType::where('id', $id)->update($klasifikasiData);

        return redirect()->route('klasifikasi.index')->with('success', 'Berhasil mengubah data!');
    }

    public function destroy($id)
    {
        LetterType::where('id', $id)->delete();
        return redirect()->back()->with('deleted', 'Berhasil menghapus data!');
    }

    public function show($id)
    {
        $klasifikasi = LetterType::with('letters')->findOrFail($id);
        return view('klasifikasi.show', compact('klasifikasi'));
    }

    public function downloadPDF($id)
    {
        $klasifikasi = LetterType::with('letters')->findOrFail($id);

        $letter = $klasifikasi->letters->first(); // Mendapatkan data Letter yang terkait dengan LetterType

        $letter_type_array = [
            'created_at' => $klasifikasi->created_at,
            'letter_code' => $klasifikasi->letter_code,
            'name_type' => $klasifikasi->name_type,
            'content' => $letter ? $letter->content : 'No content available', // Mengambil konten dari Letter yang terkait
            'recipientsUsers' => $klasifikasi->recipientsUsers,
            'notulisUser' => $letter && $letter->notulisUser ? $letter->notulisUser->name : 'Notulis Tidak Ditemukan',

        ];

        view()->share('klasifikasi', $letter_type_array);
        $pdf = PDF::loadView('klasifikasi.download', $letter_type_array);
        return $pdf->download('Surat.pdf');
    }
}
