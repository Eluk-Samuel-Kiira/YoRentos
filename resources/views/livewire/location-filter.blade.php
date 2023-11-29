<div>
    <div class="mt-6">
        <x-label for="country" value="{{ __('Select Country') }}" class="font-semibold text-xl"/>
        <select class="w-full font-medium py-2 rounded text-gray-700" wire:model.lazy="selectedCountry">
            <option value=""></option>
            @foreach ($countries as $country)
                <option value="{{ $country->id }}">{{ $country->country }}</option>
            @endforeach
        </select>
    </div>

    <div class="mt-6">
        <x-label for="district" value="{{ __('Select District') }}" class="font-semibold text-xl"/>
        <select class="w-full font-medium py-2 rounded text-gray-700" wire:model.lazy="selectedDistrict">
            <option value=""></option>
            @foreach ($districts as $district)
                <option value="{{ $district->id }}">{{ $district->district }}</option>
            @endforeach
        </select>
    </div>

    <div class="mt-6">
        <x-label for="county" value="{{ __('Select County/Constituency') }}" class="font-semibold text-xl"/>
        <select class="w-full font-medium py-2 rounded text-gray-700" wire:model.lazy="selectedCounty">
            <option value=""></option>
            @foreach ($counties as $county)
                <option value="{{ $county->id }}">{{ $county->county }}</option>
            @endforeach
        </select>
    </div>

    <div class="mt-6">
        <x-label for="subcounty" value="{{ __('Select Sub-County/Division') }}" class="font-semibold text-xl"/>
        <select class="w-full font-medium py-2 rounded text-gray-700" wire:model.lazy="selectedSubcounty">
            <option value=""></option>
            @foreach ($subcounties as $subcounty)
                <option value="{{ $subcounty->id }}">{{ $subcounty->subcounty }}</option>
            @endforeach
        </select>
    </div>

    <div class="mt-6">
        <x-label for="parish" value="{{ __('Select Parish/Ward') }}" class="font-semibold text-xl"/>
        <select class="w-full font-medium py-2 rounded text-gray-700" wire:model.lazy="selectedParish">
            <option value=""></option>
            @foreach ($parishes as $parish)
                <option value="{{ $parish->id }}">{{ $parish->parish }}</option>
            @endforeach
        </select>
    </div>

    <div class="mt-6">
        <x-label for="village" value="{{ __('Select Village/Cell') }}" class="font-semibold text-xl"/>
        <select class="w-full font-medium py-2 rounded text-gray-700" name="village_id" required>
            <option value=""></option>
            @foreach ($villages as $village)
                <option value="{{ $village->id }}">{{ $village->village }}</option>
            @endforeach
        </select>
    </div>

    <div class="mt-6">
        <x-label for="broker" value="{{ __('Select Broker') }}" class="font-semibold text-xl"/>
        <select class="w-full font-medium py-2 rounded text-gray-700" name="broker_id">
            <option value=""></option>
            @foreach ($brokers as $broker)
                <option value="{{ $broker->id }}">{{ $broker->brokerName->name }}</option>
            @endforeach
        </select>
    </div>

</div>
