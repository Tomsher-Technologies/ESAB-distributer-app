@extends('admin.layouts.app', ['body_class' => ''])

@section('content')
    @livewire('admin.users.edit', [
        'user' => $user,
    ])
@endsection
