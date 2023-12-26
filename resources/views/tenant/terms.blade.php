@include('layouts.header')
<title>Terms & Conditions | YoRentos</title>
@include('layouts.menu')
<section class="find_section ">
    <div class="container">
        <form action="">
            <div class="container-header">
                <h2 class="rental_heading">
                    {{__('Terms And Conditions Are As Follow ')}}
                </h2>
            </div>
            <div class="form-row">
                @if ($estate_terms)
                    @if ($estate_terms->terms_conditions)
                        {{ $estate_terms->terms_conditions}}
                        @if ($unit->sponsored == 1)
                            <span class="badge bg-success">{{ __('Accepted') }}</span>
                        @else
                            <a href="{{ route('unit.accept', $unit) }}" class="badge bg-danger">{{ __('Unaccepted') }}</a>
                        @endif
                    @else
                        {{ $estate_terms->estate }}{{__(' Estate Does not Have Terms and Conditions') }}
                    @endif
                @else
                    {{__('Estate Does not Exist On Our Platform') }}
                @endif
            </div>
        </form>
    </div>
</section>
@include('layouts.footer')