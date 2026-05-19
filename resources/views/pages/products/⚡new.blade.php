<?php

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Product;

new class extends Component
{
    // Para uploads de arquivos
    use WithFileUploads;

    // Todos os campos
    /*
        "id",    
        "name",
        "image_url",
        "quantity",
        "price",
        "description"
    
    */
    public $name;
    public $image;
    public $quantity = 0;
    public $price = 0.00;
    public $description;

    public function save(){
        // Validações
        $this->validate([
            "name"=>"required|min:3|max:70|string",// Obrigatório, 3 letras no minimo, 70 no máximo, string
            "description"=>"required|min:5|max:300",// no minimo 5 e no máximo 300, obrigatório
            "image"=>"image|required|max:1024",// Imagem, obrigatório, no máximo 1 MB
            "quantity"=>"integer|required",// Inteiro, obrigatório
            "price"=>"required|decimal:2"// Decimal de 2 casas decimais, obrigatório
        ]);

        $path = $this->image->store('products','public');// Guarda dentro de products na pasta publica, retorna /products/{{ nome }} 

        Product::create([
            "name"=>$this->name,
            "description"=>$this->description,
            "image_url"=>$path,
            "quantity"=>$this->quantity,
            "price"=>$this->price
        ]);// Cria

        $this->reset();// Reload
    }
};
?>

<!-- Previne para não salvar duas vezes -->
<form wire:submit.prevent='save' class="m-3">
    <div class="mb-3">
        <label class="form-label">Imagem:</label>
        <input type="file" wire:model='image' class="form-control">
        <!-- Erro de imagem -->
        @error('image')
            <div class="alert alert-danger">
                <p>{{ $message }}</p>
            </div>
        @enderror
    </div>
    <div class="mb-3">
        <label class="form-label">Name:</label>
        <input type="text" wire:model='name' class="form-control">
        @error('name')
            <div class="alert alert-danger">
                <p>{{ $message }}</p>
            </div>
        @enderror
    </div>
    <div class="mb-3">
        <label class="form-label">Description:</label>
        <textarea wire:model='description' cols="80" rows="10" class="form-control"></textarea>
        @error('description')
            <div class="alert alert-danger">
                <p>{{ $message }}</p>
            </div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="form-label">Quantity:</label>
        <input type="number" wire:model='quantity' step="1" class="form-control">
        @error('quantity')
            <div class="alert alert-danger">
                <p>{{ $message }}</p>
            </div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="form-label">Price:</label>
        <input type="number" wire:model='price' step="0.01" value="0.01"  onkeydown="return false"  class="form-control">
        @error('price')
            <div class="alert alert-danger">
                <p>{{ $message }}</p>
            </div>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary">Salvar</button>
    
</form>