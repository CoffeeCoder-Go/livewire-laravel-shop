<?php

use Livewire\Component;
use App\Models\Product;

new class extends Component
{
    //

    public function render(){
        return view('pages.⚡hello',[
            "products"=>Product::orderBy('created_at','ASC')->get()
        ]);
    }
};
?>

<div class="m-3">
    
    <h2>Mais antigos</h2>
    <div class="row">
        
        
            @foreach ($products as $product)
                <div class="col-12 col-md-3 col-lg-4">
                    <div class="card">
                        <img src="{{ asset('storage/'.$product->image_url) }}" alt="imagem" style="height: 300px;object-fit: cover;" class="rounded-1 card-img-top img-fluid">

                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <span class="card-text text-body-tertiary">by {{ $product->user->name }}</span>
                            <p class="card-text text-body-secondary">{{ $product->description }}</p>
                            <p class="card-text text-success">R$ {{ number_format($product->price,2,",",".") }}</p>
                            <p class="card-text">Restando {{ $product->quantity }} Unidades</p>

                        </div>
                    </div>
                </div>
                
            @endforeach
        
    </div>
</div>