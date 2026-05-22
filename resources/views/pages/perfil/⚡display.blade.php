<?php

use Livewire\Component;

new class extends Component
{
    //
    public $user;

    public function mount(){
        $this->user = auth()->user();
    }
};
?>

<div>
    @if (count($user->perfils) > 0)
        <h1>Wait</h1>
    @else
        <div class="container m-3 p-3 rounded-1 border border-primary">
            <h1>You dont have any perfil! Create a one</h1>
            <a href="{{  route('perfil.sign') }}" class="btn btn-primary">Create</a>
        </div>
    @endif
</div>