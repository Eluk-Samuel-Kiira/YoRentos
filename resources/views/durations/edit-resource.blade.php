<div>
    <div id="notification" class="fixed top-0 right-0 mb-4 mr-4 p-4 bg-gray-800 text-white rounded shadow-md opacity-0 
        transition-opacity duration-500 hidden">
        <span id="notificationMessage"></span>
    </div>
    <div
        x-data="{ show: false, index: '', name: '' }"
        x-show = "show"
        x-on:open-edit-resource.window = "show = true; index = $event.detail.index; name = $event.detail.name"
        x-on:close-modal.window = "show = false"
        style="display:none"
        class="fixed">

        <div class="fixed inset-0 bg-gray-300 opacity-80 backdrop-blur-lg"></div>
            <div class="bg-white rounded m-auto fixed inset-0 max-w-2xl overflow-y-auto" style="max-height:500px">
                    <div class="px-4 py-3 flex items-center justify-between border-b border-gray-300">
                        <div class="text-xl text-gray-800">{{__('Edit Duration') }}</div>
                        <button x-on:click="$dispatch('close-modal')">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                <div class="p-4">        
                    <form x-on:submit.prevent="resourceFormEdit">
                        @csrf
                        <x-input x-model="index" class="block mt-1 w-full rounded text-gray-700" type="hidden" />

                        <div class="mt-6">
                            <x-label for="resource" value="{{ __('Resource Name') }}" class="font-semibold text-xl"/>
                            <x-input x-model="name" class="block mt-1 w-full rounded text-gray-700" type="text" />
                        </div>

                        <x-button class="mt-8">
                            {{ __('Save') }}
                        </x-button>
                    </form>
                </div>        
            </div>
        </div>
    </div>
</div>

<script>
    function openResourceModal(resource) {
        const index = resource.slug; 
        const name = resource.resource;   
        const event = new CustomEvent('open-edit-resource', { detail: { index, name } });
        window.dispatchEvent(event);
    }

    function resourceFormEdit() {
        const index = this.index
        const resource = this.name
        // console.log(name)
        const action = "{{ route('resource.update', '') }}" + "/" + index;
        // console.log(action)/
        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: action,
            type: "PUT",
            data: {
                resource: resource,
            },
            success: function(response) {
                if (response.success) {
                    showNotification(response.success, response.message);
                    setTimeout(function() {
                        window.location.reload();
                    }, 4000);
                } else {
                    showNotification(response.success, response.message);
                }
            },
            error: function(xhr, status, error) {
                setTimeout(function() {
                    window.location.reload();
                }, 1000);
            }
        });
        this.show = false;

        function showNotification(success, message) {
            var notification = $("#notification");
            var notificationMessage = $("#notificationMessage");

            if (success) {
                notificationMessage.text(message);
                notification.removeClass("bg-red-500").addClass("bg-green-500");
            } else {
                notificationMessage.text(message);
                notification.removeClass("bg-green-500").addClass("bg-red-500");
            }

           notification.removeClass("hidden");
            notification.addClass("opacity-100");

            // Automatically hide the notification after 3 seconds
            setTimeout(function() {
                notification.removeClass("opacity-100");
                notification.addClass("hidden");
            }, 3000); 

        }
    }
</script>

