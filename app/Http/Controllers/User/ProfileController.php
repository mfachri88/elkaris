<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    public function index()
    {
        return view('pages.profil');
    }

    public function update(Request $request)
    {
        $user = auth()->user();
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'nis' => 'required|string|max:20|unique:users,nis,' . $user->id,
            'kelas' => 'required|string|max:10',
            'jurusan' => ['required', Rule::in([User::JURUSAN_IPA, User::JURUSAN_IPS])],
            'jenis_kelamin' => ['required', Rule::in([User::JENIS_KELAMIN_LAKI, User::JENIS_KELAMIN_PEREMPUAN])],
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'nis' => $request->nis,
            'kelas' => $request->kelas,
            'jurusan' => $request->jurusan,
            'jenis_kelamin' => $request->jenis_kelamin,
        ]);

        return back()->with('success', 'Profil berhasil diperbarui');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'new_password' => ['required', Password::defaults(), 'confirmed'],
        ]);

        Auth::user()->update([
            'password' => Hash::make($request->new_password),
        ]);

        return back()->with('success', 'Password berhasil diperbarui');
    }

    public function edit()
    {
        return view('pages.profil.edit');
    }
}