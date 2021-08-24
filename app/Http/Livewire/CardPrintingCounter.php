<?php

namespace App\Http\Livewire;

use App\Models\Card;
use Livewire\Component;

class CardPrintingCounter extends Component
{
    public $printing;
    public $archive;

    public function addOne()
    {
        Card::store_Card_By_CardPrinting_And_Archive($this->printing, $this->archive);
        $this->mount();
    }

    public function subOne()
    {
        Card::delete_Card_By_CardPrinting_And_Archive( $this->printing, $this->archive);
        $this->mount();
    }

    public function render()
    {
        return view('livewire.card-printing-counter');
    }
}
