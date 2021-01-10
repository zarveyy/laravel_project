@extends('layouts.main')

@section('title', "Board")


@section('content')
    <h2>Welcome to your board {{$board->title}}</h2>
    @foreach ($board->users as $user)
        <p>{{ $user->name }}</p>
    @endforeach
@endsection
