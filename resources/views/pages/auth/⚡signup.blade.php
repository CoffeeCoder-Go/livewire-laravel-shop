<?php

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

new class extends Component
{
    //
    public $name;
    public $password;

    public function save(){
        $this->validate([
            'name'=>"required|string|max:255",
            'password'=>"required|string|min:8",
        ]);

        $user = new User([
            'name'=>$this->name,
            'password'=>$this->password
        ]);

        $user->save();

        Auth::login($user);

        return redirect()->route('home');
    }
};
?>

<form wire:submit.prevent='save'>
    <div class="mb-3">
        <label class="form-label">Name:</label>
        <input type="text" wire:model='name' class="form-control">
    </div>
    <div class="mb-3">
        <label class="form-label">Password:</label>
        <input type="password" wire:model='password' class="form-control">
    </div>

    <button type="submit" class="btn btn-primary">Signup</button>
    <a href="{{  route('users.login') }}" class="btn btn-outline-primary">Login</a>
</form>