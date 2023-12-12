<div>
    {{-- In work, do what you enjoy. --}}
    <section>
        <div class="center-container">
            <div class="rentals-container">
                <h6>
                    {{__('Rentals Available In Your Area (Sub-County/Division)')}}
                </h6>
            </div>
        </div>
        <div class="slider-container">
            <div class="slider">
                @forelse($estates as $estate)
                    <div class="slided">
                        @php
                            $firstImage = 0;
                        @endphp
                        @if($estate->images)
                            @foreach(explode(',', $estate->images) as $imageName)
                                <div class="slide">
                                    <img src="{{ asset('storage/estate_images/' . $estate->landlord_id . '/' . $imageName) }}" alt="">
                                </div>
                                @php
                                    $firstImage++;
                                    if ($firstImage >= 1) {
                                        break; // Stops the loop 
                                    }
                                @endphp
                            @endforeach
                        @else
                            <div><img src="{{asset('frontend/images/s-2.jpg')}}" alt=""></div>
                        @endif
                        <div class="detail-box">
                            <h6>
                                <a href="{{ route('unit.detail', $estate) }}">{{ $estate->estate }} </a>     
                            </h6>
                        </div>
                        <span class="btn btn-primary btn-small" style="display: inline-block; white-space: nowrap;">
                            <span style="display: inline-block; vertical-align: middle;">
                                {{ $estate->villageEstate->village }}
                            </span>
                        </span>
                    </div>
                @empty
                    <div class="detail-box">
                        <h6>
                            {{__('No Estates Available')}}
                        </h6>
                    </div>
                @endforelse
                <div>
                    <p class="btn btn-primary">
                        <a href="{{ route('register') }}" style="text-align: center;">
                            Find More
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </section>
</div>
