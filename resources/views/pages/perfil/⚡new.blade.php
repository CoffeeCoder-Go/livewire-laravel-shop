<?php

use Livewire\Component;

use Illuminate\Support\Carbon;
use Illuminate\Validation\Rule;
use App\Enums\PerfilType;
use App\Models\Perfil;
use Livewire\WithFileUploads;

new class extends Component
{
    use WithFileUploads;
    //
    public $apelido;
    public $birthday;
    public $type;
    public $foto;

    public function save(){
        $this->validate([
            'apelido'=>"required|string|min:3|max:160",
            'birthday'=>[
                "required",
                "date",
                "before_or_equal:".Carbon::today()->subYears(18)->format('Y-m-d'),
                "after_or_equal:".Carbon::today()->subYears(130)->format('Y-m-d')
            ],
            'type'=>[
                "required",
                Rule::enum(PerfilType::class)
            ],
            'foto'=>[
                "required",
                "image",
                "max:1024"
            ]
        ]);

        $path = $this->foto->store("perfil","public");

        auth()->user()->perfil()->create([
            "nickname"=>$this->apelido,
            "birthday"=>$this->birthday,
            "type"=>$this->type,
            "foto"=>$path
        ]);

        return redirect()->route('perfil.perfil');
    }
};
?>

<form wire:submit='save'>
    <div class="mb-3">
        <label class="form-label">Apelido</label>
        <input type="text" class="form-control" wire:model='apelido'>
        @error('apelido')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Data de nascimento</label>
        <input type="date" class="form-control" wire:model='birthday'>
        @error('birthday')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Tipo</label>
        <div class="form-check">
            <input type="radio" value="seller" class="form-check-input" wire:model='type'>
            <label class="form-check-label">Vendedor</label>
            
        </div>

        <div class="form-check">
            <input type="radio" value="buyer" class="form-check-input" wire:model='type'>
            <label class="form-check-label">Comprador</label>
        </div>
        @error('type')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Foto</label>
        <input type="file" class="form-control" wire:model='foto'>
        @error('foto')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary">Create</button>

</form>