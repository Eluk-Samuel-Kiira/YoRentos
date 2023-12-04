<div id="unitModal" class="hidden bg-gray-100 p-4 rounded-lg shadow-md">
    <button id="closeCreateUnit" class="text-sm text-gray-500 mt-2 bg-red-500 hover:bg-red-700">
        &times;Close
    </button>
    <h2 class="text-xl font-bold mb-2">Create Unit</h2>
    <!-- Form for creating a new unit -->
    <form id="unitForm" class="flex flex-col gap-4">
        <label for="unitName" class="text-lg font-semibold">Unit Name:</label>
        <input type="text" id="unitName" name="unitName" class="border border-gray-300 rounded-md px-3 py-1">

        <label for="estateName" class="text-lg font-semibold">Estate Name:</label>
        <input type="text" id="estateName" name="estateName" class="border border-gray-300 rounded-md px-3 py-1">

        <button type="submit" class="bg-blue-500 text-white px-3 py-1 rounded-sm text-sm mt-4">
            Save
        </button>
    </form>
</div>
<script>
    // JavaScript to handle opening and closing the modal
    document.getElementById('openCreateUnit').onclick = function () {
        document.getElementById('unitModal').classList.remove('hidden');
    };

    document.getElementById('closeCreateUnit').onclick = function () {
        document.getElementById('unitModal').classList.add('hidden');
    };
</script>