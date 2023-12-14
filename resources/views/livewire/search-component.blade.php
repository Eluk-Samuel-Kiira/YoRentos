<div>
    <section class="find_section ">
        <div class="container">
            <form action="">
                <div class="container-header">
                    <h2 class="rental_heading">
                        {{__('Let\'s Search Your Dream Rental Now!')}}
                    </h2>
                </div>
                <div class="form-row">
                    <!-- countries -->
                    <div class="col-md-2">
                        <select class="form-control" wire:model.lazy="selectedCountry">
                            <option value="">Select Country</option>
                            @foreach ($countries as $country)
                                <option value="{{ $country->id }}">{{ $country->country }}</option>
                            @endforeach
                        </select>
                    </div>
                    <!-- Districts -->
                    <div class="col-md-2">
                        <select class="form-control" wire:model.lazy="selectedDistrict">
                            <option value="">Select District</option>
                            @foreach ($districts as $district)
                                <option value="{{ $district->id }}">{{ $district->district }}</option>
                            @endforeach
                        </select>
                    </div>
                    <!-- counties/Constituency -->
                    <div class="col-md-2">
                        <select class="form-control" wire:model.lazy="selectedCounty">
                            <option value="">Select County/Constituency</option>
                            @foreach ($counties as $county)
                                <option value="{{ $county->id }}">{{ $county->county }}</option>
                            @endforeach
                        </select>
                    </div>
                    <!-- sub-counties/Divisons -->
                    <div class="col-md-2">
                        <select class="form-control" wire:model.lazy="selectedSubcounty">
                            <option value="">Select Sub-County/Division</option>
                            @foreach ($subcounties as $subcounty)
                                <option value="{{ $subcounty->id }}">{{ $subcounty->subcounty }}</option>
                            @endforeach
                        </select>
                    </div>
                    <!-- parishes/wards -->
                    <div class="col-md-2">
                        <select class="form-control" wire:model.lazy="selectedParish">
                            <option value="">Select Parish/Ward</option>
                            @foreach ($parishes as $parish)
                                <option value="{{ $parish->id }}">{{ $parish->parish }}</option>
                            @endforeach
                        </select>
                    </div>
                    <!-- villages -->
                    <div class="col-md-2">
                        <select class="form-control" wire:model.lazy="selectedVillage">
                            <option value="">Select Village/Cell</option>
                            @foreach ($villages as $village)
                                <option value="{{ $village->id }}">{{ $village->village }}</option>
                            @endforeach
                        </select>
                    </div>
                    <!-- Rental types -->
                    <div class="col-md-2">
                        <select class="form-control" wire:model.lazy="selectedRental">
                            <option value="">Select Rental</option>
                            @foreach ($rentals as $rental)
                                <option value="{{ $rental->id }}">{{ $rental->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <section class="sale_section">
        <div class="container-header">
            <h2 class="rental_heading">
                @if($selected_rental)
                    {{ $selected_rental->name }}
                @else
                    {{ ('No Rental Type Selected') }}
                @endif
            </h2>
        </div>
        <div class="container-fluid">
            <div class="sale_container">
                @if($selected_rental && $select_estates)
                    @forelse($select_estates as $estate)
                        <div class="box">
                            <div class="img-box">
                                <div class="carousel">
                                    @if($estate->images)
                                        @foreach(explode(',', $estate->images) as $imageName)
                                            <div class="slide">
                                                <img src="{{ asset('storage/estate_images/' . $estate->landlord_id . '/' . $imageName) }}" alt="" >
                                            </div>
                                        @endforeach
                                    @else
                                        <div><img src="{{asset('frontend/images/s-2.jpg')}}" alt=""></div>
                                    @endif
                                </div>
                            </div>
                            <div class="detail-box">
                                <h6>
                                    <a href="{{ route('unit.detail', $estate) }}">{{ $estate->estate }} </a>                           
                                    <span class="btn btn-small" style="background-color: yellow; color: &#9654;">
                                    @php
                                        $minPrice = $estate->unitEstate->min('price');
                                        $maxPrice = $estate->unitEstate->max('price');
                                    @endphp
                                    @if ($minPrice !== null && $maxPrice !== null)
                                        {{ $minPrice }} - {{ $maxPrice }}
                                    @else
                                        N/A
                                    @endif
                                    </span>
                                </h6>
                                <p>
                                    <span class="btn btn-small">
                                        @php
                                            $availableUnits = $estate->unitEstate->where('status', 0)->count();
                                            $allUnits = $estate->unitEstate->count();
                                        @endphp
                                            {{__('Units Available: ')}}
                                        @if ($availableUnits !== 0) 
                                            {{ $availableUnits }}/{{ $allUnits }}
                                        @else
                                            {{__('NONE')}}
                                        @endif
                                    </span>
                                    <span class="btn btn-primary btn-small" style="display: inline-block; white-space: nowrap;">
                                        <img src="{{asset('frontend/images/location.png')}}" width="10px" style="display: inline-block; vertical-align: middle; margin-right: 5px;" alt="">
                                        <span style="display: inline-block; vertical-align: middle;">
                                            {{ $estate->villageEstate->village }}
                                        </span>
                                    </span>
                                </p>
                            </div>
                        </div>
                    @empty
                    @endforelse
                @else
                @endif
            </div>
        </div>
    </section>
</div>
