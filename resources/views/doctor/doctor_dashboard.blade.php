@extends('layout')
@section('breadcrumb')
<x-breadcrumb title="Dashboard" />
@endsection
@section('content')
<h1>Doctor Dashboard</h1>
<p>Hello {{ auth()->user()->name }}! Welcome to your dashboard!</p>
@endsection
