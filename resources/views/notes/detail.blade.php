@extends('template.base')

@section('title', 'Detail Notes')

@section('content')

<form action="{{ route('notes.update', $note) }}" method="post">
    @method('put')
    @csrf
    <h1>ini edit</h1>
    <label for="title">Judul:</label>
    <input name="title" type="text" placeholder="Title">
    <br>
    <label for="text">Your Notes:</label>
    <br>
    <textarea name="text" id="" cols="30" rows="10" placeholder="Typing Your Notes Here..."></textarea>
    <br>
    <label for="time">Waktu Reminder:</label>
    <br>
    <input type="datetime-local" id="time" name="time">
    <br>
    <button>Edit Notes</button>

    <div class="mt-20 mx-auto my-0   justify-center block p-6 rounded-lg shadow-lg bg-white max-w-md">
        <form action="{{ route('notes.store') }}" method="post">
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
              focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" id="exampleInput7"
              placeholder="Title">
          </div>


          <div class="form-group mb-6">
            <textarea
            class="
              form-control
              block
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
              focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none
            "
            id="exampleFormControlTextarea13"
            rows="3"
            placeholder="Add your notes...."
          ></textarea>
          </div>
          <div class="form-group form-check text-center mb-6">
            <input type="checkbox"
              class="form-check-input appearance-none h-4 w-4 border border-gray-300 rounded-sm bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain mr-2 cursor-pointer"
              id="exampleCheck87" checked>
            <label class="form-check-label inline-block text-gray-800" for="exampleCheck87">Add Reminder?</label>
          </div>
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
            ease-in-out">Edit Notes</button>
        </form>
      </div>
</form>

<script>
    setInterval(function() {
        location.reload();
    }, 10000);
</script>

@endsection

