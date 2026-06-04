<?php

use Livewire\Component;

new class extends Component
{
    //
    public $user;
    public $perfil;

    public function mount(){
        $this->user = auth()->user();
        $this->perfil = $this->user->perfil;
    }
};
?>

<div>
    @if (isset($perfil))
        <div class="container m-3 p-3 rounded-1 border border-primary">
            <div>
                <img src="{{ asset('storage/'.$perfil->foto) }}" alt="foto de perfil" class="rounded-circle border border-primary"  style="width:150px; height:150px; object-fit:cover;">
                <h5>{{ ucfirst($perfil->type->value) }} {{ $perfil->nickname }}</h5>
            </div>
            <span>{{ $perfil->birthday }}</span>

                
        </div>
    @else
        <div class="container m-3 p-3 rounded-1 border border-primary">
            <h1>You dont have any perfil! Create a one</h1>
            <a href="{{  route('perfil.sign') }}" class="btn btn-primary">Create</a>
        </div>
    @endif
</div>