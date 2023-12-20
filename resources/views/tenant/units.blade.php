@include('layouts.header')
<title>My Units | YoRentos</title>
@include('layouts.menu')
<section class="price_section layout_padding-bottom">
    <div class="container">
        <div class="container-header">
            <h2 class="rental_heading">
                {{__('These Are The Units You Reside In. ')}} {{ auth()->user()->name }}
            </h2>
        </div>
        <div class="price_container">
            @forelse ($units as $unit)
                @php
                    // Calculate the difference in days
                    $startDate = \Carbon\Carbon::parse($unit->lease_start);
                    $endDate = \Carbon\Carbon::parse($unit->lease_stop);
                    $daysLeft = $startDate->diffInDays($endDate);
                @endphp
                <div class="box">
                    <div class="detail-box">
                        <div class="heading-box">
                            <h6>
                                {{ $unit->unit }} || {{ $unit->EstateName->estate}}
                            </h6>
                        </div>
                        <div class="text-box">
                            <h2>
                                {{ $unit->price }}
                            </h2>
                            <h2>
                                {{__('Lease Start: ')}}<br> {{ $unit->lease_start }}
                            </h2>
                            <h2>
                                {{__('Lease End: ')}}<br> {{ $unit->lease_stop }}
                            </h2>
                            <h2>
                                {{ $daysLeft }} days left
                            </h2>
                            <ul>
                                <li>
                                    {{ $unit->rentalName->name }}
                                </li>
                                <li>
                                    {{ $unit->durationName->duration }}
                                </li>
                                <li>
                                    {{ $unit->square_footage }}
                                </li>
                                <span>
                                    <li>
                                        {{ $unit->description }}
                                    </li>
                                    <li>
                                        @php
                                            $resourcesArray = json_decode($unit->resources);
                                        @endphp
                                        {{ is_array($resourcesArray) ? implode(', ', $resourcesArray) : $unit->resources }}
                                    </li>
                                </span>
                            </ul>
                        </div>
                    </div>
                </div>
            @empty
                <div class="container-header">
                    <h2 class="rental_heading">
                        {{__('No Unit Assigned To You.')}}
                    </h2>
                </div>
            @endforelse
        </div>
    </div>
</section>
@include('layouts.footer')