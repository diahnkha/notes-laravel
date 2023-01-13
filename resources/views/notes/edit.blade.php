@extends('template.base')

@section('title', 'Edit Notes')

@section('content')

    {{-- <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="my-6 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg">
                <form action="{{ route('notes.update', $note) }}" method="post">
                    @method('put')
                    @csrf
                    <input name="title" type="text" placeholder="Title" value="{{$note->title}}">
                    <br>
                    <label for="time">Waktu Reminder:</label>
                    <br>
                    <input type="datetime-local" id="time" name="time" value="{{$note->time}}">
                    <br>
                    <textarea name="text" id="" cols="30" rows="10" placeholder="Typing Your Notes Here..." >{{$note->text}}</textarea>
                    <br>
                    <button>Edit Notes</button>
                </form>
            </div>
        </div>
    </div> --}}

    <div class="mx-auto my-0   justify-center block p-6 rounded-lg shadow-lg bg-white ">
        <form action="{{ route('notes.update', $note) }}" method="post">
        @csrf
          <div class="form-group mb-6">
            <input type="text" class="form-control block
              w-full
              px-3
              py-1.5
              text-base
              font-normal
              text-gray-700
              bg-white bg-clip-padding
              border border-solid border-gray-300
              rounded
              transition
              ease-in-out
              m-0
              focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" id="title" name="title"
              placeholder="Title" value="{{$note->title}}">
          </div>

          <div class="form-group mb-6">
            <textarea
            class="
              form-control
              block
              w-full
              px-3
              py-1.5
              h-80
              text-base
              font-normal
              text-gray-700
              bg-white bg-clip-padding
              border border-solid border-gray-300
              rounded
              transition
              ease-in-out
              m-0
              focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none
            "
            name="text"
            id="text"
            rows="3"
            placeholder="Add your notes...."
          >{{ $note->text }}</textarea>
          </div>
          {{-- <div class="form-group form-check text-center mb-6">
            <input type="checkbox"
              class="form-check-input appearance-none h-4 w-4 border border-gray-300 rounded-sm bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain mr-2 cursor-pointer"
              id="exampleCheck87" checked>
            <label class="form-check-label inline-block text-gray-800" for="exampleCheck87">Add Reminder?</label>
          </div> --}}

          @if($note->time == null)
          <div x-data="notif" class="flex flex-col justify-center items-center mb-5">
            <div class="mb-5 flex justify-center items-center">
                <input class="mr-5" type="checkbox" value="red" x-model="colors">
                <label class="form-check-label inline-block text-gray-800" for="exampleCheck87">Add Reminder?</label><br>
            </div>

            <template x-if="colors ? tampilga : !tampilga ">
                <div class="form-group mb-6">
                    <input type="datetime-local" name="time" class="form-control block
                      w-full
                      px-3
                      py-1.5
                      text-base
                      font-normal
                      text-gray-700
                      bg-white bg-clip-padding
                      border border-solid border-gray-300
                      rounded
                      transition
                      ease-in-out
                      m-0
                      focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" id="time">
                  </div>
            </template>
          </div>


          @endif

          @if($note->time !== null)
          <div class="form-group mb-6 max-w-sm mx-auto my-0">
            <input type="datetime-local" name="time" class="form-control block
              w-full
              px-3
              py-1.5
              text-base
              font-normal
              text-gray-700
              bg-white bg-clip-padding
              border border-solid border-gray-300
              rounded
              transition
              ease-in-out
              m-0
              focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" id="time" value="{{$note->time}}">
          </div>
          @endif
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
            ease-in-out">Save Notes</button>
        </form>
      </div>

      <script>
        setInterval(function() {
            location.reload();
        }, 50000);
    </script>

@endsection
