@props(['title','rowId'])
<div
    x-data = "{show : false }"
    x-show = "show"
    x-on:open-modal.window = "show = true"
    x-on:close-modal.window = "show = false"
    style="display:none"
    class="fixed">
    <div class="fixed inset-0 bg-gray-300 opacity-80 backdrop-blur-lg"></div>
    <div class="bg-white rounded m-auto fixed inset-0 max-w-2xl overflow-y-auto" style="max-height:500px">
        @if (isset($title))
            <div class="px-4 py-3 flex items-center justify-between border-b border-gray-300">
                <div class="text-xl text-gray-800">{{ $title }}</div>
                <button x-on:click="$dispatch('close-modal')">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        @endif
        <div class="p-4">
            @if (isset($rowId))
                {{ $rowId }}
            @endif
        </div>        
    </div>
</div>