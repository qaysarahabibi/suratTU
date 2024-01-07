<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Excel;
use App\Exports\OrdersExport;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    public function authLogin(Request $request)
    {
        $request -> validate([
            'email' => 'required|email:dns',
            'password' => 'required',
        ]);

        // simpan data dari inputan email dan password ke dlm variable untuk memudahkan ;pemanggilannya
        $user = $request->only(['email', 'password']);
        // attempt : menegecek kecocokan email dan password kemudian meniympannya ke dlm class auth (memberi identitas data riwayat login ke projectnya)
        if (Auth::attempt($user)) {
            //perbedaan redirect() = (disamain dengan yang ada di path) dan redirect()->route = (tulisan yang ada di dalam route disamain sama iddalam naem)
            return redirect()->route('dashboard');
        } else {
            return redirect()->back()->with('failed', 'Login Gagal! Silahkan coba lagi!');
        }
    }

    public function logout() {
        // menghapus data session login
        Auth::logout();
        return redirect()->route('login');
    }
    
    // Staff
    public function index(Request $request)
    {

        $search = $request->input('search');
        $staffs = User::where('role', 'staff')
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%')
                        ->orWhere('email', 'like', '%' . $search . '%');
                });
            })
            ->simplePaginate(3);
        
        return view('staff.index', compact('staffs'));
    }
    public function create()
    {
        return view('staff.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email:dns',
        ]);

        $email = substr($request->email, 0, 3);
        $name = substr($request->name, 0, 3);
        $hashedPassword = Hash::make($name . $email);
    
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $hashedPassword,
            'role' => 'staff',
        ]);

        return redirect()->route('staff.index')->with('success', 'Berhasil menambahkan data pengguna!');
    }
    // public function edit( string $id)
    // {
       
    // }

    public function edit($id)
    {
        $staff = User::find($id);
        return view('staff.edit', compact('staff'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email:dns',
            'password' => '',
        ]);

        $staffData = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        if($request->filled('password')){
            $staffData['password'] = bcrypt($request->password);
        }

        User::where('id', $id)->update($staffData);

        return redirect()->route('staff.index')->with('success', 'Berhasil mengubah data!');
    }

    public function destroy($id)
    {
        User::where('id', $id)->delete();
        return redirect()->back()->with('deleted', 'Berhasil menghapus data!');
    }

    // Guru
    public function indexGuru(Request $request)
    {
        $search = $request->input('searchGuru');
        $guru = User::where('role', 'guru')
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%')
                        ->orWhere('email', 'like', '%' . $search . '%');
                });
            })
            ->simplePaginate(3);

        return view('guru.indexGuru', compact('guru'));
    }
    public function createGuru()
    {
        return view('guru.createGuru');
    }
    public function storeGuru(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email:dns',
        ]);

        $email = substr($request->email, 0, 3);
        $name = substr($request->name, 0, 3);
        $hashedPassword = Hash::make($name . $email);
    
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $hashedPassword,
            'role' => 'guru',
        ]);

        return redirect()->route('guru.indexGuru')->with('success', 'Berhasil menambahkan data pengguna!');
    }
    // public function edit( string $id)
    // {
       
    // }

    public function editGuru($id)
    {
        $guru = User::find($id);
        return view('guru.editGuru', compact('guru'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function updateGuru(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email:dns',
            'password' => '',
        ]);

        $guruData = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        if($request->filled('password')){
            $guruData['password'] = bcrypt($request->password);
        }

        User::where('id', $id)->update($guruData);

        return redirect()->route('guru.indexGuru')->with('success', 'Berhasil mengubah data!');
    }

    public function destroyGuru($id)
    {
        User::where('id', $id)->delete();
        return redirect()->back()->with('deleted', 'Berhasil menghapus data!');
    }

        public function search(Request $request)
        {
            $searchTerm = $request->get('search');
            
            $users = User::where(function ($query) use ($searchTerm) {
                $query->where('nama', 'like', '%' . $searchTerm . '%')
                    ->orWhere('email', 'like', '%' . $searchTerm . '%');
            })->simplePaginate(5);
        
            return view('staff.index', compact('users'));
        }
    
}

 