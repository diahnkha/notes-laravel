<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
{

    // menampilkan semua daftar notes
    public function index()
    {

        $waktusekarang = date('Y-m-d H:i:s');
        $notes = Note::where('user_id', '=', Auth::user()->id)->get();
        // $notes = Note::all();
        $temps = [];
        foreach ($notes as $note){
            $diff = Carbon::parse($waktusekarang)->diffInMinutes($note->time);

            $waktunotes = $note->time;
            if($diff<=15 && $diff>0 && ($waktusekarang<=$waktunotes)){
                array_push($temps, $note);
                    // dump($diff);
                // dump($tanggalsekarang);

            }

        }
        // dd($temps);


        // $waktu = Carbon::parse($notes->time);
        // $tanggalnotes = $notes->time;
        // dd($tanggalnotes);

        // $notes = Note::where('user_id', Auth::id())->latest('updated_at')->paginate(5);
        // $notes = Auth::user()->notes()->latest('updated_at')->paginate(5);
        $notes = Note::whereBelongsTo(Auth::user())->latest('updated_at')->paginate(5);

        return view('notes.index')->with(['notes'=> $notes, 'temps' => $temps]);
    }

    //menampilkan halaman membuat note
    public function create()
    {
        return view('notes.create');
    }

    //membuat note baru
    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required|max:120',
            'text' => 'required'
        ]);


        Note::create([
            'user_id' => Auth::user()->id,
            'uuid' => Str::uuid(),
            'title' => $request->title,
            'text' => $request->text,
            'time' => $request->time

        ]);

        return to_route('notes.index')->with('success','Note Added successfully');;
    }

    //menampilkan note detail
    public function show(Note $note)
    {
        if(!$note->user->is(Auth::user())) {
            return abort(403);
        }

        return view('notes.show')->with('note', $note);
    }

    //mengupdate note
    public function edit(Note $note)
    {
        if(!$note->user->is(Auth::user())) {
            return abort(403);
        }

        return view('notes.edit')->with('note', $note);
    }

    //mengupdate note
    public function update(Request $request, Note $note)
    {
        if(!$note->user->is(Auth::user())) {
            return abort(403);
        }

        $request->validate([
            'title' => 'required|max:120',
            'text' => 'required',
            'time' => 'required'
        ]);

        $note->update([
            'title' => $request->title,
            'text' => $request->text,
            'user_id' => Auth::user()->id,
            'time' => $request->time
        ]);

        return to_route('notes.show', $note)->with('success','Note updated successfully');
    }

    //menghapus note dengan fitur softdelete
    public function destroy(Note $note)
    {
        if(!$note->user->is(Auth::user())) {
            return abort(403);
        }

        $note->delete();

        return to_route('notes.index')->with('success', 'Note Move to Trash');
    }

    //api mendapatkan jumlah daftar note reminder
    public function notif($id){

        $waktusekarang = date('Y-m-d H:i:s');
        $notes = Note::where('user_id', '=', $id)->get();

        // $notes = Note::all();
        $temps = [];
        foreach ($notes as $note){
            $diff = Carbon::parse($waktusekarang)->diffInMinutes($note->time);

            $waktunotes = $note->time;
            if($diff<=15 && $diff>0 && ($waktusekarang<=$waktunotes)){
                array_push($temps, $note);
                    // dump($diff);
                // dump($tanggalsekarang);

            }

        }

        $jumlah = count($temps);

        return response()->json([
            "status" => true,
            "message" => "",
            "data" => $jumlah
        ]);
    }
}
