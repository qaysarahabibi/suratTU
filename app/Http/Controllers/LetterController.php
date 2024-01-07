<?php

namespace App\Http\Controllers;

use App\Models\Letter;
use App\Models\LetterType;
use App\Models\User;
use Illuminate\Http\Request;

class LetterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $query = Letter::with('letterType');

        if (!empty($search)) {
            $query->whereHas('letterType', function ($query) use ($search) {
                $query->where('letter_code', 'like', '%' . $search . '%')
                    ->orWhere('name_type', 'like', '%' . $search . '%');
            });
        }

        $letters = $query->paginate(5);

        return view('surat.index', compact('letters'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $klasifikasi = LetterType::all();
        $guru = User::where('role', 'guru')->get();
        return view('surat.create', compact('klasifikasi', 'guru'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'letter_perihal' => 'required',
            'letter_type_id' => 'required',
            'content' => 'required',
            'recipients' => 'required|array',
            'notulis' => 'required',
        ]);

        // $name = $request->input('letter_type_id');
        // $data = LetterType::where('name_type', $name)->first();

        Letter::create([
            'letter_perihal' => $request->letter_perihal,
            'letter_type_id' => $request->letter_type_id,
            'recipients' => json_encode($request->recipients),
            'content' => $request->content,
            'notulis' => $request->notulis,
        ]);
        
        return redirect()->route('surat.index')->with('success', 'Berhasil menambahkan data Surat!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Letter  $letter
     * @return \Illuminate\Http\Response
     */


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Letter  $letter
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $letters = Letter::find($id);
        $klasifikasi = LetterType::all();
        $guru = User::where('role', 'guru')->get();

        return view('surat.edit', compact('letters', 'klasifikasi', 'guru'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'letter_perihal' => 'required',
            'letter_type_id' => 'required',
            'content' => 'required',
            'recipients' => 'required|array',
            'notulis' => 'required',
        ]);

        $letter = Letter::findOrFail($id);

        $letter->update([
            'letter_perihal' => $request->letter_perihal,
            'letter_type_id' => $request->letter_type_id,
            'content' => $request->content,
            'recipients' => json_encode($request->recipients),
            'notulis' => $request->notulis,
        ]);

        return redirect()->route('surat.index')->with('success', 'Berhasil memperbarui data!');
    }

    public function destroy($id)
    {
        Letter::where('id', $id)->delete();
        return redirect()->back()->with('deleted', 'Berhasil menghapus data!');
    }

    public function show($id)
    {
        $letters = Letter::find($id);
        $klasifikasi = LetterType::with('letters')->findOrFail($id);
        $guru = User::where('role', 'guru')->get();
    
        return view('surat.show', compact('letters', 'klasifikasi', 'guru'));
    }
    
}
