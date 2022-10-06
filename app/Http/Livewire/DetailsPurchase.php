<?php

namespace App\Http\Livewire;

use Livewire\Component;

class DetailsPurchase extends Component
{
    public $post;
    public function mount($id)
    {
        $this->post = $id;
    }
    public function render()
    {
        
        return view('livewire.purchases.purchaseDetails')->layout('layouts.theme.app');
    }
}
