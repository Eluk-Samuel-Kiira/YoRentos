<script>
    function toggleUnits(estateUid) {
        const element = document.getElementById(`unit_${estateUid}`);
        if (element) {
            element.classList.toggle('hidden');
        }
    }
</script>

<div class="w-full md:w-1/3 bg-gray-200 rounded-lg p-2 hidden" id="unit_{{ $estate->uid }}">
    <div class="w-full max-w-sm mx-auto">
        @if (session('estate_id') == $estate->id)
            <form method="POST" action="https://checkout.flutterwave.com/v3/hosted/pay" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                @csrf
                <input type="hidden" name="tx_ref" value="{{ session('txn_ref') }}" required/>
                <input type="hidden" name="public_key" value="FLWPUBK-1c35c3c26e1701045fe66ad993f291a5-X" />
                <input type="hidden" name="amount" value="{{ session('amount') }}" />
                <input type="hidden" name="currency" value="UGX" />
                <input type="hidden" name="type" value="mobile_money_uganda" />
                <input type="hidden" name="meta[token]" value="54" />
                <input type="hidden" name="customer[name]" value="{{ auth()->user()->name }}" />
                <input type="hidden" name="customer[email]" value="{{ auth()->user()->email }}" />
                <input type="hidden" name="customer[phone_number]" value="{{ auth()->user()->phone_number }}" />
                <input type="hidden" name="redirect_url" value="https://thesealed.mytreeuganda.org/" />
                <input type="text" name="amount" value="{{ session('amount') }}" style="border: none" disabled/>
                <!-- <input type="text" name="amount" value="{{ $estate->id }}" style="border: none" disabled/> -->
                <div class="flex items-center justify-between">
                    <button type="submit" class="bg-blue-500 text-white px-3 py-1 rounded-sm text-sm hover:bg-blue-600 motion-reduce:transform-none">
                        CheckOut
                    </button>
                </div>
            </form>
        @else
            <form method="POST" action="{{ route('payment.units') }}" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                @csrf
                <input type="hidden" id="landlord_id" name="landlord_id" value="{{ $estate->landlord_id }}" required>
                <input type="hidden" id="estate_uid" name="estate_uid" value="{{ $estate->uid }}" required>
                <input type="hidden" id="estate_id" name="estate_id" value="{{ $estate->id }}" required>
                <div class="mt-4">
                    <x-label for="unit-pay" value="{{ __('Select Monthly Unit Packages') }}" class="block text-gray-700 text-sm font-bold mb-2"/>
                    <div>
                        <input type="checkbox" id="unit-mgt" name="unit_pay[]" value="500" class="mr-2" required>
                        <label for="units" class="rounded">Manage Units at 500/unit</label>
                    </div>
                    <div>
                        <input type="checkbox" id="unit-mgt" name="unit_pay[]" value="1500" class="mr-2">
                        <label for="units" class="rounded">Timely Notifications at 1500/unit</label>
                    </div>
                </div>
                <div class="flex items-center justify-between">
                    <button type="submit" class="bg-blue-500 text-white px-3 py-1 rounded-sm text-sm hover:bg-blue-600 motion-reduce:transform-none">
                        Process Payments
                    </button>
                </div>
            </form>
        @endif
        @if(request()->query('status') == 'successful')
            <div class="flex justify-center px-3 py-2 border-l-4 border-indigo-400 text-base font-medium text-indigo-700 bg-indigo-50 focus:outline-none focus:text-indigo-800 focus:bg-indigo-100 focus:border-indigo-700">
                {{ __('Your Payment is succeessful') }}
            </div>
        @elseif(request()->query('status') == 'cancelled')
            <!-- this is just a security measure for typos -->
            @php
                $cancelled_txn = \App\Models\Unitpay::where('txn_ref', request()->query('tx_ref'))->first();
                if ($cancelled_txn) {
                    $cancelled_txn->delete();
                }
            @endphp
            <div class="flex justify-center px-3 py-2 border-l-4 border-indigo-400 text-base font-medium text-indigo-700 bg-indigo-50 focus:outline-none focus:text-indigo-800 focus:bg-indigo-100 focus:border-indigo-700">
                {{ __('Your Transaction Has Failed or been Cancelled') }}
            </div>
        @endif
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var status = "{{ request()->query('status') }}"; // Get the status
        var txRef = "{{ request()->query('tx_ref') }}";
        var user_id = "{{ auth()->user()->id }}";
        var landlord = "{{ $estate->landlord_id }}";
        if ( landlord == user_id) {
            if (status === 'successful' && txRef) {
                $.ajaxSetup({
                    headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                // Send an AJAX request to delete the image
                $.ajax({
                    url: '{{ route('pay.unit-status') }}', 
                    method: 'POST',
                    data: { txRef: txRef,
                    },
                    success: function(response) {
                        console.log(response);
                    },
                    error: function(xhr, status, error) {
                        // Handle error
                        console.error(error);
                    }
                }); 
            } else {
                // console.log('Transaction Failed');
            }
        }
    });

</script>
