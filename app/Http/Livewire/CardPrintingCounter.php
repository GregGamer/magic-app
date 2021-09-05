<?php

namespace App\Http\Livewire;

use App\Models\Card;
use Livewire\Component;

class CardPrintingCounter extends Component
{
    public $printing;
    public $archive;
    //TODO: FIX why is cards->count() not up to date with what is in the database after calling addOne/subOne
    public $helper_counter;

    public function addOne()
    {
        Card::store_Card_By_CardPrinting_And_Archive($this->printing, $this->archive);
        $this->helper_counter = $this->printing->cards->count()+1;
    }

    public function subOne()
    {
        Card::delete_Card_By_CardPrinting_And_Archive( $this->printing, $this->archive);
        $this->helper_counter = $this->printing->cards->count()-1;
    }

    public function render()
    {
        return view('livewire.card-printing-counter', ['printings_count' => $this->helper_counter]);
    }
}
