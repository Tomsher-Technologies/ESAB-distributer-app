@extends('admin.layouts.app', ['body_class' => ''])

@section('content')
    @livewire('admin.products.edit', [
        'product' => $product,
    ])
@endsection
