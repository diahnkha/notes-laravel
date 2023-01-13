@extends('template.base')

@section('title', 'Detail Note')

@section('content')

<x-alert-success>
    {{ session('success') }}
</x-alert-success>

    <div class="py-12">
        <div class=" mx-auto sm:px-6 lg:px-8">

            <div >
                @if(!$note->trashed())
                    <div class="flex justify-between">
                        <div class="flex ml-5">
                            <p class="opacity-70">
                                <strong>Created: </strong> {{ $note->created_at->diffForHumans() }}
                            </p>
                            <p class="opacity-70 ml-8">
                                <strong>Updated: </strong> {{ $note->updated_at->diffForHumans() }}
                            </p>
                        </div>

                        <div class="flex">
                            <div class="flex mr-5 ml-5">
                                <a href="{{ route('notes.edit', $note) }}">
                                    <button type="submit" class="
                                    w-full
                                    px-6
                                    py-2.5
                                    bg-blue-600
                                    text-white
                                    font-medium
                                    text-xs
                                    leading-tight
                                    uppercase
                                    rounded
                                    shadow-md
                                    hover:bg-blue-700 hover:shadow-lg
                                    focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0
                                    active:bg-blue-800 active:shadow-lg
                                    transition
                                    duration-150
                                    ease-in-out">Edit Notes</button></a>
                            </div>

                            <form action="{{ route('notes.destroy', $note) }}" method="post">
                                @method('delete')
                                @csrf
                                <button type="submit" class="
                                w-full
                                px-6
                                py-2.5
                                bg-blue-600
                                text-white
                                font-medium
                                text-xs
                                leading-tight
                                uppercase
                                rounded
                                shadow-md
                                hover:bg-blue-700 hover:shadow-lg
                                focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0
                                active:bg-blue-800 active:shadow-lg
                                transition
                                duration-150
                                ease-in-out"
                                onclick="return confirm('Are you sure you wish to move this to trash?')"
                                >Move to Trash</button>
                            </form>
                        </div>
                    </div>


                @else
                <div class="flex gap-5 ">
                    <p class="opacity-70 ml-5">
                        <strong>Deleted: </strong> {{ $note->deleted_at->diffForHumans() }}
                    </p>
                    <form action="{{ route('trashed.update', $note) }}" method="post" class="ml-auto">
                        @method('put')
                        @csrf
                        <button type="submit" class="
                            px-6
                            py-2.5
                            bg-blue-600
                            text-white
                            font-medium
                            text-xs
                            leading-tight
                            uppercase
                            rounded
                            shadow-md
                            hover:bg-blue-700 hover:shadow-lg
                            focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0
                            active:bg-blue-800 active:shadow-lg
                            transition
                            duration-150
                            ease-in-out">Restore Note</button>

                    </form>

                    <form action="{{ route('trashed.destroy', $note) }}" method="post">
                        @method('delete')
                        @csrf
                        <button type="submit" class="
                        px-6
                        py-2.5
                        bg-blue-600
                        text-white
                        font-medium
                        text-xs
                        leading-tight
                        uppercase
                        rounded
                        shadow-md
                        hover:bg-blue-700 hover:shadow-lg
                        focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0
                        active:bg-blue-800 active:shadow-lg
                        transition
                        duration-150
                        ease-in-out" onclick="return confirm('Are you sure you wish to delete this note forever? This action cannot be undone')">Delete Forever</button>
                    </form>
                </div>


                @endif
            </div>
            <div class="my-6 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg">
                <h2 class="font-bold text-4xl">
                    {{ $note->title }}
                </h2>
                <p class="mt-6 whitespace-pre-wrap">{{ $note->text }}</p>
                @if($note->time !== null)
                <p class="mt-6 whitespace-pre-wrap">{{ \Carbon\Carbon::parse($note->time)->translatedFormat('d F Y H:i:s') }}</p>
                @endif
                <p class="mt-6 whitespace-pre-wrap">{{ \Carbon\Carbon::parse($note->time)->diffForHumans() }}</p>
            </div>
        </div>
    </div>

    <script>
        setInterval(function() {
            location.reload();
        }, 10000);
    </script>

@endsection
