<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Country;
use App\Models\District;
use App\Models\County;
use App\Models\Subcounty;
use App\Models\Parish;
use App\Models\Village;
use App\Models\Rental;
use App\Models\Estate;

class SearchComponent extends Component
{
    public $selectedCountry;
    public $selectedDistrict;
    public $selectedCounty;
    public $selectedSubcounty;
    public $selectedParish;
    public $selectedVillage;
    public $selectedRental;

    public function render()
    {
        $countries = Country::all();
        $districts = District::where('country_id', $this->selectedCountry)->where('status', 1)->get();
        $counties = County::where('district_id', $this->selectedDistrict)->where('status', 1)->get();
        $subcounties = Subcounty::where('county_id', $this->selectedCounty)->where('status', 1)->get();
        $parishes = Parish::where('subcounty_id', $this->selectedSubcounty)->where('status', 1)->get();
        $villages = Village::where('parish_id', $this->selectedParish)->where('status', 1)->get();
        $rentals = Rental::on('mysql_estates')->where('status', 1)->get();
        $selected_rental = $rentals->where('id', $this->selectedRental)->first();
        $select_estates = Estate::on('mysql_estates')->with('unitEstate')->where('village_id', $this->selectedVillage)
        ->where('rental_id', $this->selectedRental)->where('status', 1)->latest()->get();

        return view('livewire.search-component',[
            'countries' => $countries,
            'districts' => $districts,
            'counties' => $counties,
            'subcounties' => $subcounties,
            'parishes' => $parishes,
            'villages' => $villages,
            'rentals' => $rentals,
            'selected_rental' => $selected_rental,
            'select_estates' => $select_estates,
        ]);
    }
}
