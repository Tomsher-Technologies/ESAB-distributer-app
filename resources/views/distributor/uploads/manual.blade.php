@extends('distributor.layouts.app', ['body_class' => ''])

@section('content')
    @livewire('distributor.product-create')
    {{-- <form class="repeater" method="POST" action="{{ route('distributor.uploads.manual') }}">
        @csrf
        <div class="d-flex align-items-center justify-content-between mb-3">
            <div class="pagetitle">
                <h1> Add Products </h1>
            </div><!-- End Page Title -->
            <a class="btn btn-add" data-repeater-create="" href="#"> <i class="bi bi-add"></i>Add Row</a>
        </div>
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <!-- General Form Elements -->
                            <div data-repeater-list="group-a">
                                <div data-repeater-item="" class="row mb-2 g-2 justify-content-center align-items-center">
                                    <div class="col">
                                        <label for="#">GIN Number</label>
                                        <select name="gin" class="form-select form-control" id="floatingSelect"
                                            aria-label="Floating label select example" value="outer">
                                            <option selected disabled>Select</option>
                                            @foreach ($gins as $gin)
                                                <option value="{{ $gin->id }}">{{ $gin->GIN }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-1">
                                        <label for="#">Lot</label>
                                        <input name="lot" type="text" class="form-control" placeholder="Category " value="24">
                                    </div>
                                    <div class="col">
                                        <label for="#">Description</label>
                                        <input type="text" class="form-control" placeholder="Enter Distributor Code"
                                            value="OK 48.00 4.0x450mm 3/4 VP " disabled="">
                                    </div>
                                    <div class="col-md-1">
                                        <label for="#">UOM</label>
                                        <input type="text" class="form-control" placeholder="Enter UOM" value="KGM"
                                            disabled="">
                                    </div>
                                    <div class="col-md-1">
                                        <label for="#">Category </label>
                                        <input type="text" class="form-control" placeholder="Category " value="FM"
                                            disabled="">
                                    </div>
                                    <div class="col-md-1">
                                        <label for="#">Stock on Hand</label>
                                        <input type="text" class="form-control" placeholder="Enter Stock on Hand">
                                    </div>
                                    <div class="col-md-1">
                                        <label for="#">Goods in Transit</label>
                                        <input type="text" class="form-control" placeholder="Enter Goods in Transit">
                                    </div>
                                    <div class="col-md-1">
                                        <label for="#">Stock on Order</label>
                                        <input type="text" class="form-control" placeholder="Enter Stock on Order">
                                    </div>
                                    <div class="col">
                                        <label for="#">Avg sales/month </label>
                                        <input type="text" class="form-control"
                                            placeholder="Enter Average Sales per Month">
                                    </div>
                                    <div class="col-md-1">
                                        <label for="#">Over Stock</label>
                                        <select class="form-select form-control" id="floatingSelect"
                                            aria-label="Floating label select example" value="outer">
                                            <option>Select</option>
                                            <option>Yes</option>
                                            <option>No</option>
                                        </select>
                                    </div>
                                    <div class="col-md-1 w-auto align-self-center align-items-center">
                                        <a data-repeater-delete="" href="#"
                                            class="text-danger d-inline-block mt-4 ms-2"> <i class="bi bi-x-lg"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-sm-between mt-3">
                                <button class="btn btn-secondary align-self-end" type="submit">
                                    <i class="bi bi-add"></i>Submit
                                </button>

                            </div>
                            <!-- End General Form Elements -->
                            <!-- outer repeater -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </form> --}}
@endsection

@push('header')
@endpush
@push('footer')
    {{-- <script src="{{ asset('assets/jquery.repeater.min.js') }}"></script> --}}

    <script>
        // jQuery(document).ready(function() {
        //     jQuery(".repeater").repeater({
        //         defaultValues: {
        //             //"text-input": "foo"
        //         },
        //         show: function() {
        //             jQuery(this).slideDown();
        //         },
        //         hide: function(deleteElement) {
        //             if (confirm("Are you sure you want to delete this element?")) {
        //                 jQuery(this).slideUp(deleteElement);
        //                 // Livewire.emit('rowDeleted')
        //             }
        //         },
        //         ready: function(setIndexes) {
        //             //jQuerydragAndDrop.on('drop', setIndexes);
        //         },
        //         repeaters: [{
        //             selector: ".inner-repeater"
        //         }]
        //     });
        // });
    </script>
@endpush
