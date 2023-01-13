

<form action="{{ route('notes.store') }}" method="post">
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
</form>



