laravel new example-app

make db 
set env

php artisan migrate

//using breeze starter kit for login with sanctum
composer require laravel/breeze --dev

//publish all authen
php artisan breeze:install

php artisan migrate
npm install
npm run dev

//make model and migration
php artisan make:model Note -m 

php artisan migrate

npm install -D tailwindcss postcss autoprefixer
npx tailwindcss init -p

//tailwind.config.js
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],

//./resources/css/app.css
@import 'tailwindcss/base';
@import 'tailwindcss/components';
@import 'tailwindcss/utilities';

//at head html
@vite('resources/css/app.css')

//install livewire
composer require livewire/livewire

//to use
...
    @livewireStyles
</head>
<body>
    ...
 
    @livewireScripts
</body>
</html>

//trying
php artisan make:livewire counter


//make controller
php artisan make:controller NoteController 


//ngubah route setelah login
di routeserviceprovider

Carbon::parse($note->time)->diffForHumans() 
<h1>{{ \Carbon\Carbon::parse($temp['time'])->diffForHumans() }}</h1>

<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $waktusekarang = date('Y-m-d H:i:s');
        // string ke carbon
        $time = new Carbon($waktusekarang);

        // mengambil waktu sekarang menggunakan carbon (cara 1)
        // $waktusekarangCarbon = Carbon::now()->format('Y-m-d H:i:s');

        // $time lebih lama dari Carbon now
        // dd($time < Carbon::now());

        $notes = Note::all();
        $temps = [];
        foreach ($notes as $note){
            $diff = Carbon::parse($note->time)->diffInMinutes($waktusekarang);

            $waktunotes = $note->time;
            if($diff>=0 && $diff<=15 && ($waktunotes>$waktusekarang)){
                array_push($temps, $note);
                // dump($tanggalsekarang);

            }

        }


        // $waktu = Carbon::parse($notes->time);
        // $tanggalnotes = $notes->time;
        // dd($tanggalnotes);

        // $notes = Note::where('user_id', Auth::id())->latest('updated_at')->paginate(5);
        // $notes = Auth::user()->notes()->latest('updated_at')->paginate(5);
        $notes = Note::whereBelongsTo(Auth::user())->latest('updated_at')->paginate(5);

        return view('notes.index')->with(['notes'=> $notes, 'temps' => $temps]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('notes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required|max:120',
            'text' => 'required',
            'time' => 'required'
        ]);


        Note::create([
            'user_id' => Auth::user()->id,
            'uuid' => Str::uuid(),
            'title' => $request->title,
            'text' => $request->text,
            'time' => $request->time
        ]);

        return to_route('notes.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Note $note)
    {
        if(!$note->user->is(Auth::user())) {
            return abort(403);
        }

        return view('notes.show')->with('note', $note);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Note $note)
    {
        if(!$note->user->is(Auth::user())) {
            return abort(403);
        }

        return view('notes.edit')->with('note', $note);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Note $note)
    {
        if(!$note->user->is(Auth::user())) {
            return abort(403);
        }

        $request->validate([
            'title' => 'required|max:120',
            'text' => 'required'
        ]);

        $note->update([
            'title' => $request->title,
            'text' => $request->text
        ]);

        return to_route('notes.show', $note)->with('success','Note updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Note $note)
    {
        if(!$note->user->is(Auth::user())) {
            return abort(403);
        }

        $note->delete();

        return to_route('notes.index')->with('success', 'Note Move to Trash');
    }
}


//tampilan

@extends('template.base')

@section('title', 'Tambah Data')

@section('content')




@if($temps)

    <h1 class="text-center mt-20">Hi This Reminder For You!</h1>


    @foreach ($temps as $temp )
    <div class="flex flex-col justify-center items-center mt-10">
    @foreach ($notes as $note)

    <h2 class="font-bold text-2xl">

        <a

        @if(request()->routeIs('notes.index'))
            href="{{ route('notes.show', $note) }}"
        @else
            href="{{ route('trashed.show', $note) }}"
        @endif
        >{{ $note->title }} | <span class="text-sm"> {{ \Carbon\Carbon::parse($note->time)->diffForHumans() }} </span></a>

    </h2>


    @endforeach
    @endforeach



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


@endsection

//tampilan

@if($temps)

    <h1 class="text-center mt-20">Hi This Reminder For You!</h1>


    @foreach ($temps as $temp )
    <div class="flex flex-col justify-center items-center mt-10">
    @foreach ($notes as $note)

    <h2 class="font-bold text-2xl">

        <a

        @if(request()->routeIs('notes.index'))
            href="{{ route('notes.show', $note) }}"
        @else
            href="{{ route('trashed.show', $note) }}"
        @endif
        >{{ $note->title }} | <span class="text-sm"> {{ \Carbon\Carbon::parse($note->time)->diffForHumans() }} </span></a>

    </h2>

</div>
    @endforeach
    @endforeach






@endif
