<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Country;
use App\Models\District;
use App\Models\County;
use App\Models\Subcounty;
use App\Models\Parish;
use App\Models\Village;
use App\Models\Broker;

class LocationFilter extends Component
{
    public $selectedCountry;
    public $selectedDistrict;
    public $selectedCounty;
    public $selectedSubcounty;
    public $selectedParish;
    public $selectedVillage;

    public function render()
    {
        $countries = Country::all();
        $districts = District::where('country_id', $this->selectedCountry)->get();
        $counties = County::where('district_id', $this->selectedDistrict)->get();
        $subcounties = Subcounty::where('county_id', $this->selectedCounty)->get();
        $parishes = Parish::where('subcounty_id', $this->selectedSubcounty)->get();
        $villages = Village::where('parish_id', $this->selectedParish)->get();
        $brokers = Broker::where('district_id', $this->selectedDistrict)->where('status', 1)->get();

        return view('livewire.location-filter', [
            'countries' => $countries,
            'districts' => $districts,
            'counties' => $counties,
            'subcounties' => $subcounties,
            'parishes' => $parishes,
            'villages' => $villages,
            'brokers' => $brokers,
        ]);
    }
}
