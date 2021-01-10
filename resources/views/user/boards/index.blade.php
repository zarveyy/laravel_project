@extends('layouts.main')

@section('title', "User's board")


@section('content')
    @if(count($boards) == 0)
        <p>You don't have any boards</p>
    @else
        <p>Go through all boards</p>
    @endif
    @foreach ($boards as $board)
        <p>Board : {{ $board->title }}.
            @can('view', $board)
                <a href="{{route('boards.show', $board)}}">detail</a>
            @endcan
            @can('update', $board)
                <a href="{{route('boards.edit', $board)}}">edit</a></p></p>
        @endcan
        @can('delete', $board)
            <form action="{{route('boards.destroy', $board->id)}}" method='POST'>
                @method('DELETE')
                @csrf

                <button type="submit">Delete</button>
            </form>
        @endcan
    @endforeach

@endsection
