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
use DB;

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
        $villages_in_parish=123;
        $rentals = Rental::on('mysql_estates')->where('status', 1)->get();
        $selected_rental = $rentals->where('id', $this->selectedRental)->first();

        $countries = Country::where('status', 1)->get();
        $districts = District::where('country_id', $this->selectedCountry)->where('status', 1)->get();
        $counties = County::where('district_id', $this->selectedDistrict)->where('status', 1)->get();
        $subcounties = Subcounty::where('county_id', $this->selectedCounty)->where('status', 1)->get();
        $parishes = Parish::where('subcounty_id', $this->selectedSubcounty)->where('status', 1)->get();
        $villages = Village::where('parish_id', $this->selectedParish)->where('status', 1)->get();

        $selected_estates = collect();
        if ($districts->isNotEmpty()) {
            $selected_estates = collect();
            $villages_in_district = collect();
            foreach ($districts as $district) {
                $villages_by_district = Village::whereHas('parishName.subcountyName.countyName.districtName', function ($query) use ($district) {
                    $query->where('id', $district->id);
                })->pluck('id');
                $villages_in_district = $villages_in_district->merge($villages_by_district);
            }
            $estates_by_district  = Estate::on('mysql_estates')->with('unitEstate')->whereIn('village_id', $villages_in_district)
                ->where('rental_id', $this->selectedRental)->where('status', 1)->latest()->get();
            $selected_estates = $selected_estates->merge($estates_by_district);
        }

        if ($counties->isNotEmpty()) {
            $selected_estates = collect();
            $villages_in_county = collect();
            foreach ($counties as $county) {
                $villages_by_county = Village::whereHas('parishName.subcountyName.countyName', function ($query) use ($county) {
                    $query->where('id', $county->id);
                })->pluck('id');
                $villages_in_county = $villages_in_county->merge($villages_by_county);
            }
            $estates_by_county  = Estate::on('mysql_estates')->with('unitEstate')->whereIn('village_id', $villages_in_county)
                ->where('rental_id', $this->selectedRental)->where('status', 1)->latest()->get();
            $selected_estates = $selected_estates->merge($estates_by_county);
        }

        if ($subcounties->isNotEmpty()) {
            $selected_estates = collect();
            $villages_in_subcounty = collect();
            foreach ($subcounties as $subcounty) {
                $villages_by_subcounty = Village::whereHas('parishName.subcountyName', function ($query) use ($subcounty) {
                    $query->where('id', $subcounty->id);
                })->pluck('id');
                $villages_in_subcounty = $villages_in_subcounty->merge($villages_by_subcounty);
            }
            $estates_by_subcounty  = Estate::on('mysql_estates')->with('unitEstate')->whereIn('village_id', $villages_in_subcounty)
                ->where('rental_id', $this->selectedRental)->where('status', 1)->latest()->get();
            $selected_estates = $selected_estates->merge($estates_by_subcounty);
        }

        if ($parishes->isNotEmpty()) {
            $selected_estates = collect(); 
            $villages_in_parish = collect(); 
        
            foreach ($parishes as $parish) {
                // $villages_by_parish = Village::whereIn('parish_id', [$parish->id])->pluck('id');
                $villages_by_parish = Village::whereHas('parishName', function ($query) use ($parish) {
                    $query->where('id', $parish->id);
                })->pluck('id');               
                $villages_in_parish = $villages_in_parish->merge($villages_by_parish);
            }
        
            $estates_by_parish = Estate::on('mysql_estates')->with('unitEstate')
                ->whereIn('village_id', $villages_in_parish)
                ->where('rental_id', $this->selectedRental)
                ->where('status', 1)
                ->latest()
                ->get();

            $selected_estates = $selected_estates->merge($estates_by_parish);
        }
        

        if ($this->selectedVillage) {
            // Check if $this->selectedVillage is an array; if not, convert it to an array
            $villageIds = is_array($this->selectedVillage) ? $this->selectedVillage : [$this->selectedVillage];
        
            $selected_estates = collect();
            $estates_by_village = Estate::on('mysql_estates')->with('unitEstate')
                ->whereIn('village_id', $villageIds)
                ->where('rental_id', $this->selectedRental)
                ->where('status', 1)
                ->latest()
                ->get();
        
            $selected_estates = $selected_estates->merge($estates_by_village);
        }        

        return view('livewire.search-component',[
            'countries' => $countries,
            'districts' => $districts,
            'counties' => $counties,
            'subcounties' => $subcounties,
            'parishes' => $parishes,
            'villages' => $villages,
            'rentals' => $rentals,
            'selected_rental' => $selected_rental,
            'selected_estates' => $selected_estates,
            'villages_in_parish' => $villages_in_parish,
        ]);
    }
}