<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Estate;
use Illuminate\Http\Request;


class DistrictEstate extends Component
{
    public $districtName;


    public function render()
    {
        $estates = Estate::on('mysql_estates')->with('unitEstate')->where('status', 1)->latest()->get();
        return view('livewire.district-estate', [
            'estates' => $estates,
        ]);
    }
}
