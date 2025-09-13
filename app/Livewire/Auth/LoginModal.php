<?php

namespace App\Livewire\Auth;

use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class LoginModal extends Component
{
    public $email = '';
    public $password = '';
    public $remember = false;
    public $show = false;

    protected $listeners = ['openLoginModal' => 'open'];

    public function mount()
    {
        $this->show = request()->has('openLogin');
    }

    public function open()
    {
        $this->show = true;
    }

    public function close()
    {
        $this->show = false;
    }

    public function login()
    {
        $this->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $request = new LoginRequest();
        $request->merge([
            'email' => $this->email,
            'password' => $this->password,
            'remember' => $this->remember,
        ]);

        try {
            $request->authenticate();
            $request->session()->regenerate();
            
            $user = Auth::user();
            $redirectUrl = $user->agent ? route('agent.home') : route('home');
            
            return redirect()->intended($redirectUrl);
        } catch (\Throwable $e) {
            $this->addError('email', __('auth.failed'));
        }
    }

    public function render()
    {
        return view('livewire.auth.login-modal');
    }
}
