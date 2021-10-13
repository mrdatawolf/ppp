<?php

namespace App\Http\Livewire;

use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class DatatableExport extends LivewireDatatable
{
    protected $listeners = ['importProcessed'];

    public function importProcessed($data){
        dd($data);
    }


}
