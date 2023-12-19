<div class="w-full md:w-1/3 bg-gray-200 rounded-lg p-2">
    <div class="w-full max-w-sm mx-auto">
        <div class="block text-gray-700 text-sm font-bold mb-2">Advertise Estate Monthly</div>
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
            <form method="POST" action="{{ route('payment.advert') }}" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                @csrf
                <input type="hidden" id="landlord_id" name="landlord_id" value="{{ $estate->landlord_id }}" required>
                <input type="hidden" id="estate_uid" name="estate_uid" value="{{ $estate->uid }}" required>
                <input type="hidden" id="estate_id" name="estate_id" value="{{ $estate->id }}" required>
                <div class="mb-4">
                    <label for="amount" class="block text-gray-700 text-sm font-bold mb-2">Select Package</label>
                    <select id="amount" class="w-full font-medium py-2 rounded text-gray-700" name="amount" required>
                        <option class="block mt-1 w-full" value=""></option>
                        <option class="block mt-1 w-full" value="10000">Ugx: 10000 Only In Your District</option>
                        <option class="block mt-1 w-full" value="30000">Ugx: 30000 Entire Country</option>
                    </select>      
                </div>
                <div class="flex items-center justify-between">
                    <button type="submit" class="bg-blue-500 text-white px-3 py-1 rounded-sm text-sm hover:bg-blue-600 motion-reduce:transform-none">
                        Save Details
                    </button>
                </div>
            </form>
        @endif
        @if(request()->query('status')== 'successful')
            <div class="flex justify-center px-3 py-2 border-l-4 border-indigo-400 text-base font-medium text-indigo-700 bg-indigo-50 focus:outline-none focus:text-indigo-800 focus:bg-indigo-100 focus:border-indigo-700">
                {{ __('Your Payment is succeessful') }}
            </div>
            <form method="POST" action="{{ route('payment.advert') }}" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                @csrf
                <input type="hidden" id="status" name="status" value="{{ request()->query('status') }}" required>
                <input type="hidden" id="tx_ref" name="tx_ref" value="{{ request()->query('tx_ref') }}" required>
                
                <div class="flex items-center justify-between">
                    <button type="submit" class="bg-blue-500 text-white px-3 py-1 rounded-sm text-sm hover:bg-blue-600 motion-reduce:transform-none">
                        Save Details
                    </button>
                </div>
            </form>
        @elseif(request()->query('status')== 'cancelled')
            <div class="flex justify-center px-3 py-2 border-l-4 border-indigo-400 text-base font-medium text-indigo-700 bg-indigo-50 focus:outline-none focus:text-indigo-800 focus:bg-indigo-100 focus:border-indigo-700">
                {{ __('Your Transaction Has Failed or been Cancelled') }}
            </div>
        @endif
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var status = "{{ request()->query('status') }}"; // Get the status
        var txRef = {{ request()->query('tx_ref') }};
        var estate_id = {{ $estate->id }};
        // console.log(estate_id)
        if (status === 'successful' && txRef) {
            sendTxRef(txRef, estate_id); // Call a function to send tx_ref using AJAX
        } else {
            console.log('Transaction Failed');
        }

        function sendTxRef(txRef, estate_id) {
            // AJAX request to post tx_ref to a Laravel route
            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Send an AJAX request to delete the image
            $.ajax({
                url: '{{ route('pay.status') }}', 
                method: 'POST',
                data: { txRef: txRef,
                    estate_id: estate_id,
                },
                success: function(response) {
                    console.log(response);
                },
                error: function(xhr, status, error) {
                    // Handle error
                    console.error(error);
                }
            });
        }
    });
</script>
