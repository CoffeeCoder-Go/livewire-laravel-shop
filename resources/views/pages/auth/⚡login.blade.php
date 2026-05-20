<?php

use Livewire\Component;

new class extends Component
{
    //
    public $name;
    public $password;


    public function login(){
        $this->validate([
            'name'=>'required|string',
            'password'=>'required|string'
        ]);

        if(Auth::attempt(['name'=>$this->name,'password'=>$this->password])){
            session()->regenerate();
            return redirect()->intended(route('home'));
        }

        return redirect()->back()->with('error','invalid credentials');
    }
};
?>

<form wire:submit.prevent='login'>
    <div class="mb-3">
        <label class="form-label">Name</label>
        <input type="text" wire:model='name' class="form-control">
    </div>
    <div class="mb-3">
        <label class="form-label">Password</label>
        <input type="password" wire:model='password' class="form-control">
    </div>

    <button type="submit" class="btn btn-primary">Login</button>
    <a href="{{  route('users.signup') }}" class="btn btn-outline-primary">Sign Up</a>
</form>