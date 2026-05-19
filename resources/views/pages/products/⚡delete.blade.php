<?php

use Livewire\Component;
use App\Models\Product;

new class extends Component
{
    //
    public $product;

    public function mount(Product $product){
        $this->product = $product; 
    }

    public function delete(){
        $this->product->delete();

        redirect()->route('products')->with('delete','Deletado com sucesso!');
    }
};
?>

<div class="modal show" style="display: block;" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Apagar {{ $product->name }}...</h5>
      </div>
      <div class="modal-body">
        <p>Tem certeza que quer apagar {{ $product->name }}?</p>
      </div>
      <div class="modal-footer">
        <a href="{{ route('products') }}" class="btn btn-primary">Close</a>
        <button type="button" wire:click='delete' class="btn btn-secondary">Delete</button>
      </div>
    </div>
  </div>
</div>