
@extends('layouts.app')

@section('title', 'Login UMKM')

@section('content')
    @include('auth.partials.login', [
        'role'        => 'UMKM',
        'action'      => route('umkm.login.process'),
        'registerUrl' => route('umkm.register'),
        'color'       => 'primary',
    ])
@endsection
