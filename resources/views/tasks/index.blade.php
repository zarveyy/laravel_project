@extends('layouts.main')

@section('title', "Board's tasks")


@section('content')
    <h2>{{$board->title}}</h2>
    <h3>Tasks list</h3>
    @foreach ($board->tasks as $task)
        <p>{{ $task->title }}.

            <a href="{{route('tasks.show', [$board, $task])}}">detail</a>

            @can('update', $task)
                <a href="{{route('tasks.edit', [$board, $task])}}">edit</a></p>
        @endcan
        @can('delete', $task)
            <form action="{{route('tasks.destroy', [$board, $task])}}" method='POST'>

                @method('DELETE')
                @csrf

                <button type="submit">Delete</button>
            </form>
        @endcan
    @endforeach
@endsection
