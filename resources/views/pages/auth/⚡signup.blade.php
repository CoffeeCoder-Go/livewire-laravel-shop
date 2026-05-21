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
        @error('name')
            <span class="text-danger">{{  $message }}</span>
        @enderror
    </div>
    <div class="mb-3">
        <label class="form-label">Password:</label>
        <div class="input-group" x-data="{ show: false }">
            <input :type="show?'text':'password'" wire:model='password' class="form-control" >
            <button type="button" class="btn btn-primary" @click="show = !show"><i class="bi bi-eye"></i></button>
        </div>
        @error('password')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary">Signup</button>
    <a href="{{  route('users.login') }}" class="btn btn-outline-primary">Login</a>
</form>