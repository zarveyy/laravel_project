@extends('layouts.app')

@section('title', 'Display Category')


@section('content')
    <h2>{{$categories}}</h2>
    <p>id : {{$categories->id}}</p>
@endsection
