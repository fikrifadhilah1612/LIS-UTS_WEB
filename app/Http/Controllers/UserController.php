<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
       
        if (Auth::user()->status !== 'Admin') {
            return redirect()->route('dashboard')->with('error', 'Akses Ditolak! Anda bukan Admin.');
        }

        $users = User::all();
        return view('user.index', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users',
            'password' => 'required|min:6',
            'status'   => 'required|in:Admin,User'
        ]);

        User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password), 
            'status'   => $request->status,
        ]);

        return redirect()->route('user.index')->with('success', 'Akun User berhasil ditambahkan!');
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'username' => 'required|unique:users,username,' . $user->id,
            'status'   => 'required|in:Admin,User'
        ]);

        
        $data = [
            'username' => $request->username,
            'status'   => $request->status,
        ];

        
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);
        return redirect()->route('user.index')->with('success', 'Akun User berhasil diperbarui!');
    }

    public function destroy(User $user)
    {
        
        if (Auth::id() == $user->id) {
            return redirect()->route('user.index')->with('error', 'Anda tidak bisa menghapus akun yang sedang Anda gunakan!');
        }

        $user->delete();
        return redirect()->route('user.index')->with('success', 'Akun User berhasil dihapus!');
    }
}