<?php

use Livewire\Component;
use App\Models\Product;
use  Livewire\WithPagination;

new class extends Component
{
    // Melhorias para paginação
    use WithPagination;

    // Campo Search
    public $search = '';

    // Renderizador
    public function render(){
        // View list
        return view('pages.products.⚡list',[
            // Passa os produtos ordenados, pesquisados e paginados
            'products' => Product::orderBy('name','ASC')->where("name","LIKE","%".$this->search."%")->cursorPaginate(5),
        ]);
    }
};
?>

<div class="m-3">
    <h1>Produtos</h1>

    <!-- Link para novo produto -->
    <a href="{{ route('products.new_product') }}" class="btn btn-primary mb-3">Novo Produto</a>
    
    <!-- Campo que atualiza a todo tempo, famoso Live Search -->
    <input type="text" wire:model.live='search' placeholder="search..." class="form-control mb-3">

    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Image</th>
                <th scope="col">Name</th>
                <th scope="col">Description</th>
                <th scope="col">Quantity</th>
                <th scope="col">Price</th>
                <th scope="col">Edit</th>
                <th scope="col">Delete</th>
            </tr>
        </thead>
        <tbody>

            @foreach ($products as $product)
                <!-- Wire key serve para identificar um produto pela chave -->
                <tr wire:key='{{ $product->id }}'>

                    <td>{{ $product->id }}</td>
                    <!-- Coloca a imagem em seu respectivo campo -->
                    <td><img src="{{ asset('./storage/'.$product->image_url) }}" alt="Imagem" width="100" height="100"></td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->description }}</td>
                    <td>{{ $product->quantity }} Unidades</td>
                    <td>R${{ number_format($product->price,2,",",".") }}</td>
                    <td><a href="{{ route('products.edit_product',$product->id) }}" class="btn btn-primary"><i class="bi bi-pencil"></i></a></td>
                    <td><a href="{{ route('products.delete_product',$product->id) }}" class="btn btn-danger"><i class="bi bi-trash"></i></a></td>
                </tr>
            @endforeach

            
        </tbody>

        <tfoot>
            <tr>
                <td colspan="8">
                    {{ $products->links() }}
                </td>
            </tr>
        </tfoot>
    </table>
</div>