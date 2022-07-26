<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Select2Dropdown extends Component
{
    public $ottPlatform = '';
    
    public $cities = [
        'Rajkot',
        'Surat',
        'Baroda',
    ];   
    
    public function render()
    {
        return view('livewire.select2-dropdown')->extends('layouts.app');
    }
}
