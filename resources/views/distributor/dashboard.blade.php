@extends('distributor.layouts.app', ['body_class' => ''])

@section('content')
    <div class="pagetitle">
        <h1>Check Over Stock Data</h1>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <!-- General Form Elements -->
                        <form method="POST" action="{{ route('distributor.dashboard') }}">
                            @csrf
                            <div class="row g-3">
                                <div class="col-sm-3">
                                    <label for="#">Country</label>
                                    <select name="country[]" class="form-select form-control select2PickerCountry" multiple>
                                        <option {{ optionSelected($request->country, 'all') }} value="all">All</option>
                                        @foreach ($countries as $key => $c_group)
                                            <optgroup label="{{ $key }}">
                                                @foreach ($countries[$key] as $country)
                                                    <option {{ optionSelected($request->country, $country->code) }}
                                                        value="{{ $country->code }}">{{ $country->name }}</option>
                                                @endforeach
                                            </optgroup>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-3">
                                    <label for="#">GIN Number</label>
                                    <select name="gin[]" class="form-select form-control select2PickerGIN" id="gin"
                                        multiple>
                                        <option selected value="all">All</option>
                                        {{-- @foreach ($gins as $gin)
                                            <option {{ optionSelected($request->gin, $gin->id) }}
                                                value="{{ $gin->id }}">{{ $gin->GIN }}</option>
                                        @endforeach --}}
                                    </select>
                                </div>
                                <div class="col-sm-3">
                                    <label for="#">Lot</label>
                                    <select name="lot[]" class="form-select form-control select2Picker" id="lot"
                                        multiple>
                                        <option {{ optionSelected($request->lot, 'all') }} value="all">All</option>
                                        @if (count($old_lots) > 0)
                                            @foreach ($old_lots as $old_lot)
                                                <option {{ optionSelected($request->lot, $old_lot['id']) }}
                                                    value="{{ $old_lot['id'] }}">
                                                    {{ $old_lot['lot_no'] }}
                                                </option>
                                            @endforeach
                                        @endif

                                    </select>
                                </div>
                                <div class="col-sm-3">
                                    <label for="#">Category</label>
                                    <select name="category" class="form-select form-control select2Picker">
                                        <option selected="all" value="all">All</option>
                                        <option {{ $request->category == 'FM' ? 'selected' : '' }} value="FM">FM
                                        </option>
                                        <option {{ $request->category == 'Non-FM' ? 'selected' : '' }} value="Non-FM">
                                            Non-FM
                                        </option>
                                    </select>
                                </div>
                                <div class="col-sm-3 align-self-end">
                                    <button name="search" value="1" type="submit" class="btn btn-secondary w-100">
                                        Search <i class="bi bi-search ps-2"></i>
                                    </button>
                                </div>
                            </div>
                        </form><!-- End General Form Elements -->
                    </div>
                </div>
                <x-form.success />
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                <div class="card">
                    <div class="card-body">
                        <!-- Bordered Table -->
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="table_bg" scope="col">Country</th>
                                    <th class="table_bg" scope="col">GIN Number</th>
                                    <th class="table_bg" scope="col">Lot</th>
                                    <th class="table_bg" scope="col">Category</th>
                                    <th class="table_bg" scope="col">Stock on Hand</th>
                                    <th class="table_bg" scope="col">Overstocked</th>
                                    <th class="table_bg" scope="col">Status</th>
                                    <th class="table_bg" scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $pro)
                                    <tr>
                                        @php
                                            $show_form = 1;
                                            $status = '';
                                            $request = $pro->request->where('from_distributor', auth()->user()->id)->last();
                                            if ($request) {
                                                if ($request->status == 1) {
                                                    $show_form = 0;
                                                }
                                            }
                                        @endphp
                                        <td>{{ $pro->product->country->name }}</td>
                                        <td>{{ $pro->product->GIN }}</td>
                                        <td>{{ $pro->lot_number }}</td>
                                        <td>{{ $pro->product->category }}</td>
                                        <td>{{ $pro->stock_on_hand }}</td>
                                        <td>
                                            @if ($pro->overstocked)
                                                <b class="clr_grn me-2">Yes</b>
                                            @else
                                                <b class="clr_red me-2">No</b>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($request)
                                                @switch($request->status)
                                                    @case(1)
                                                        <b class="clr_yellow me-2">Pending</b>
                                                    @break

                                                    @case(2)
                                                        <b class="clr_grn me-2">Completed</b>
                                                    @break

                                                    @case(3)
                                                        <b class="clr_red me-2">Rejected</b>
                                                    @break
                                                @endswitch
                                                <br>Tracking Number: <b>{{ $request->tracking_number }}</b>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($show_form)
                                                <form class="form-inline"
                                                    action="{{ route('distributor.product.request') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $pro->id }}">
                                                    <input type="hidden" name="to" value="{{ $pro->user_id }}">
                                                    <div class="row">
                                                        <div class="col-xl-8">
                                                            <input type="number" required max="{{ $pro->stock_on_hand }}"
                                                                class="form-control" name="quantity" placeholder="Quantity">
                                                        </div>
                                                        <div class="col-xl-4 mt-sm-2">
                                                            <button type="submit" class="btn btn-view h-100 w-100">
                                                                Request
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- End Bordered Table -->
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('header')
    <style>
        .clr_yellow {
            color: #ffc30d
        }
    </style>
@endpush

@push('footer')
    <script>
        if ($('.select2PickerGIN').length > 0) {
            $('.select2PickerGIN').select2({
                placeholder: 'Select an GIN',
                disabled: $(this).data('disabled') ?? false,
                maximumSelectionLength: $(this).data('max') ?? 0,
                ajax: {
                    url: '{{ route('gins') }}',
                    dataType: 'json',
                    delay: 250,
                    minimumInputLength: 2,
                    data: function(params) {
                        var query = {
                            search: params.term,
                        }
                        return query;
                    }
                }
            }).on('select2:select', function(e) {
                var data = e.params.data;
                if (data.id == 'all') {
                    $(this).val('all').change();
                } else {
                    var wanted_option = $(this).find('option[value="all"]');
                    wanted_option.prop('selected', false);
                }
                $(this).trigger('change.select2');
            }).on('change', function() {
                var count = $(this).select2('data').length
                if (count == 0) {
                    $(this).val('all').change();
                }


                var gins = $(this).select2('data');
                var selectedGins = [];
                $.each(gins, function(key, value) {
                    selectedGins.push(value.id);
                });
                if (selectedGins.length > 1 && jQuery.inArray("All", selectedGins) !== -1) {
                    selectedGins.splice(selectedGins.indexOf('All'), 1);
                }
                appendDefault()
                $.ajax({
                    url: "{{ route('distributor.product.getLot') }}",
                    type: 'GET',
                    data: {
                        'selectedGins': selectedGins
                    },
                    dataType: 'json', // added data type
                    success: function(res) {
                        if (res.length > 0) {
                            $.each(res, function(key, value) {
                                $('#lot')
                                    .append($("<option></option>")
                                        .attr("value", value.id)
                                        .text(value.lot_no));
                            });
                        }
                    }
                });

            });
        }

        // $('#gin').on('change', function() {



        //     console.log(selectedGins);





        // });

        function appendDefault() {
            $('#lot')
                .empty()
                .append($("<option></option>")
                    .attr("value", 'all')
                    .attr("selected", true)
                    .text('All'));
        }
    </script>
@endpush
