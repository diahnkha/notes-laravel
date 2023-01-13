@if(session('success'))
    <div class="mb-4 mt-3 ml-5 mr-5 px-4 py-2 bg-fuchsia-500 border border-green-200 text-white rounded-md">
        {{ $slot }}
    </div>
@endif
