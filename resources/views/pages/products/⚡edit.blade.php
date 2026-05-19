<?php

use Livewire\Component;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;

new class extends Component
{
    use WithFileUploads;

    public $product;

    public $image;
    public $name;
    public $description;
    public $quantity;
    public $price;

    public function mount(Product $product){
        $this->product = $product;
        $this->name = $product->name;
        $this->description = $product->description;
        $this->quantity = $product->quantity;
        $this->price = $product->price;
    }

    public function save(){
        Storage::delete('/storage/'.$this->product->image_url);

        $this->validate([
            "name"=>"required|min:3|max:70|string",
            "description"=>"required|min:5|max:300",
            "quantity"=>"required|integer",
            "price"=>"required|decimal:2",
            "image"=>"required|image|max:1024"
        ]);

        $path = $this->image->store('products','public');

        $this->product->update([
            "name"=>$this->name,
            "description"=>$this->description,
            "quantity"=>$this->quantity,
            "price"=>$this->price,
            "image_url"=>$path
        ]);

        return redirect()->route('products');
    }
};
?>


<form wire:submit.prevent='save'>
    <div class="mb-3">
        <label class="form-label">Imagem</label>
        <img src="{{ asset("./storage/".$product->image_url) }}" alt="Imagem" width="150" height="150">
        <input type="file" wire:model="image" class="form-control">

        @error('image')
            <div class="alert alert-danger">
                <p>{{ $message }}</p>
            </div>
        @enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Name</label>
        <input type="text" wire:model="name" class="form-control">

        @error('name')
            <div class="alert alert-danger">
                <p>{{ $message }}</p>
            </div>
        @enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Description</label>
        <input type="text" wire:model="description" class="form-control" value="{{ $product->description }}">

        @error('description')
            <div class="alert alert-danger">
                <p>{{ $message }}</p>
            </div>
        @enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Quantity</label>
        <input type="number" wire:model="quantity" class="form-control" value="{{ $product->quantity }}">

        @error('quantity')
            <div class="alert alert-danger">
                <p>{{ $message }}</p>
            </div>
        @enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Price</label>
        <input type="number" wire:model="price" class="form-control" step="0.01" value="{{ $product->price }}">

        @error('price')
            <div class="alert alert-danger">
                <p>{{ $message }}</p>
            </div>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary">Save</button>
    <a href="{{ route('products') }}" class="btn btn-danger">Back</a>
</form>