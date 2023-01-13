<div wire:poll.keep-alive>
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


</div>
