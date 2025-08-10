@extends('layout')

@section('content')
    <h1>User Dashboard</h1>
    <p>{{ Auth::user()->name }} Welcome to your dashboard!</p>
@endsection
