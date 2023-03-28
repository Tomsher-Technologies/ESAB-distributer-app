@extends('admin.layouts.app', ['body_class' => ''])

@section('content')
    @livewire('admin.distributor.edit', [
        'distributor_id' => $distributor_id,
    ])
@endsection
