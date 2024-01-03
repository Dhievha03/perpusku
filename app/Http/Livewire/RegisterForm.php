<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class RegisterForm extends Component
{
    public $name;
    public $email;
    public $password;

    public function rules()
    {
        return [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|max:25',
        ];
    }

    protected $messages = [
        'name.required' => 'Nama tidak boleh kosong.',
        'email.required' => 'Email tidak boleh kosong.',
        'email.email' => 'Format email tidak valid.',
        'email.unique' => 'Email sudah digunakan.',
        'password.required' => 'Password tidak boleh kosong.',
        'password.min' => 'Password tidak boleh kurang dari 8 digit.',
        'password.max' => 'Password tidak boleh lebih dari 25 digit.',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function register()
    {
        $this->validate();
        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password)
        ]);

        return redirect()->route('user.login')->with('success', 'Akun telah dibuat silahkan login terlebih dahulu');
    }

    public function render()
    {
        return view('livewire.register-form');
    }
}
