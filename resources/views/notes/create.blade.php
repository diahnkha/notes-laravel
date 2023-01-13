@extends('template.base')

@section('title', 'Add Notes')

@section('content')

{{-- <form action="{{ route('notes.store') }}" method="post">
    @csrf
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
    <button>Save Notes</button>
</form> --}}

<div class="mx-auto my-0   justify-center block p-6 rounded-lg shadow-lg bg-white">
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
          focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" id="title" name="title"
          placeholder="Title"
          :value="@old('title')">
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
        :value="@old('text')"
      ></textarea>
      </div>
      {{-- <div class="form-group form-check text-center mb-6">
        <input type="checkbox"
          class="form-check-input appearance-none h-4 w-4 border border-gray-300 rounded-sm bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain mr-2 cursor-pointer"
          id="exampleCheck87" checked>
        <label class="form-check-label inline-block text-gray-800" for="exampleCheck87">Add Reminder?</label>
      </div> --}}
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
                  focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" id="time" :value="@old('time')">
              </div>
        </template>
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
        ease-in-out">Save Notes</button>
    </form>
  </div>

  <script>
    setInterval(function() {
        location.reload();
    }, 50000);
</script>

@endsection



