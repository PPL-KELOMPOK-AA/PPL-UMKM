
@extends('layouts.app')

@section('title', 'Login Investor')

@section('content')
    @include('auth.partials.login', [
        'role'        => 'Investor',
        'action'      => route('investor.login.process'),
        'registerUrl' => route('investor.register'),
        'color'       => 'primary',
    ])
@endsection
