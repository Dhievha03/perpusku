<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    public function index()
    {
        return view('user.profile.index');
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => [
                'required',
                Rule::unique('users')->ignore(auth()->id()),
            ],
            'foto' => 'image|mimes:jpeg,png,jpg|max:2048',
            'password' => 'nullable|min:8',
            'password_confirmation' => 'nullable|same:password',
        ]);

        $user = User::find(Auth::user()->id);

        $data = [
            'name' => $request->input('name'),
            'email' => $request->input('email')
        ];
        
        
        $imagePath = null;
        if ($request->hasFile('foto')) {
            $image = $request->file('foto');
            $imageName = Str::random(16) . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('public/profile', $imageName);

            if ($imagePath) {
                $data['foto'] = $imageName;
            }else{
                return back()->with('error', 'Ups sepertinya ada yang salah');
            }
        }

        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->input('password'));
        }
    
        $user->update($data);

        return back()->with('success', 'Profil berhasil diubah');
    }
}
