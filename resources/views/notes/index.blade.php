@extends('template.base')

@section('title', 'Notes')

@section('content')

<x-alert-success>
    {{ session('success') }}
</x-alert-success>

@if($temps)

<h1 class="text-center mt-20">Hi This Reminder For You!</h1>

<div class="mt-10 flex flex-col justify-center items-center">
    @foreach ($temps as $temp )

    <div class=" mt-5 text-2xl" >
        <a
        @if(request()->routeIs('notes.index'))
            href="{{ route('notes.show', $temp) }}"
        @else
            href="{{ route('trashed.show', $temp) }}"
        @endif
        >{{ $temp->title }}</a>

        <span class="text-sm">{{ \Carbon\Carbon::parse($temp->time)->diffForHumans() }}</span>
    </div>
    <br>


    @endforeach
</div>




</div>


@endif





@if(request()->routeIs('notes.index'))
<div class="flex items-center justify-center mt-20">
    <a href="{{ route('notes.create') }}" class="btn-link btn-lg mb-2">      <button type="submit" class="
        px-6
        py-2.5
        bg-fuchsia-500
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
        ease-in-out">+ New Notes</button></a>
</div>

@endif

@if($notes==null)
    <div class="mx-auto my-20 text-center">

        <h1 class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-6xl dark:text-white">{{ Auth::user()->name }}'s <mark class="px-2 text-white hover:bg-fuchsia-500 bg-blue-600 rounded dark:bg-blue-500">notes</mark> </h1>

    </div>
@endif


@forelse ($notes as $note)
    <div class="my-6 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg">
        <h2 class="font-bold text-2xl">
            <a
            @if(request()->routeIs('notes.index'))
                href="{{ route('notes.show', $note) }}"
            @else
                href="{{ route('trashed.show', $note) }}"
            @endif
            >{{ $note->title }}</a>
        </h2>
        <p class="mt-2">
            {{ Str::limit($note->text, 200) }}
        </p>
        <span class="block mt-4 text-sm opacity-70">{{ $note->updated_at->diffForHumans() }}</span>
    </div>
@empty
    @if(request()->routeIs('notes.index'))
    <div class="mx-auto my-20 text-center">

        <h1 class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-6xl dark:text-white"> You have no <mark class="px-2 text-white hover:bg-fuchsia-500 bg-blue-600 rounded dark:bg-blue-500">notes</mark> yet. </h1>
        <h4>make your Own Notes</h4>

    </div>
    @else

    <div class="mx-auto my-60 text-center">

        <h1 class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-6xl dark:text-white"> Nothing <mark class="px-2 text-white hover:bg-fuchsia-500 bg-blue-600 rounded dark:bg-blue-500">Notes</mark> in the Trash </h1>

    </div>

    @endif


@endforelse

<div class="p-7">
    {{ $notes->links() }}
</div>


<script>
    setInterval(function() {
        location.reload();
    }, 10000);
</script>

@endsection

