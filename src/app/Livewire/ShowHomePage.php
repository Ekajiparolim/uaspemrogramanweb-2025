<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\View\View;
class ShowHomePage extends Component
{
    public function render(): View
    {
        return view('livewire.show-home-page')
                    ->layout('layout.app');
    }
}