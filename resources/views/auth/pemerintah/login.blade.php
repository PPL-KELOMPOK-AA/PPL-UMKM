
@extends('layouts.app')

@section('title', 'Login Pemerintah')

@section('content')
    @include('auth.partials.login', [
        'role'   => 'Pemerintah',
        'action' => route('pemerintah.login.process'),
        'color'  => 'primary',
    ])
@endsection
