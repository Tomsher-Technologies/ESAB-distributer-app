@extends('admin.layouts.app', ['body_class' => ''])

@section('content')
    <div class="pagetitle">
        <h1>Dashboard</h1>
    </div>
    <!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <!-- General Form Elements -->
                        <form method="POST" id="form" action="{{ route('admin.dashboard') }}">
                            @csrf
                            <div class="row g-3">
                                <div class="col-sm-3">
                                    <label for="#">Country</label>
                                    <select name="country[]" class="form-select form-control select2PickerCountry" multiple>
                                        <option {{ optionSelected($old_request->country) }} value="all">All</option>

                                        @foreach ($countries as $key => $c_group)
                                            <optgroup label="{{ $key }}">
                                                @foreach ($countries[$key] as $country)
                                                    <option {{ optionSelected($old_request->country, $country->code) }}
                                                        value="{{ $country->code }}">{{ $country->name }}</option>
                                                @endforeach
                                            </optgroup>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-sm-3">
                                    <label for="#">Distributor</label>
                                    <select name="distributor[]" class="form-select form-control select2Picker"
                                        data-live-search="true" multiple>
                                        <option {{ optionSelected($old_request->distributor) }} value="all">All</option>
                                        @foreach ($distributors as $distributor)
                                            <option {{ optionSelected($old_request->distributor, $distributor->id) }}
                                                value="{{ $distributor->id }}">{{ $distributor->distributor->company_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-sm-3">
                                    <label for="#">GIN Number</label>
                                    <select name="gin[]" class="form-select form-control select2PickerGIN"
                                        data-live-search="true" multiple>
                                        <option selected value="all">All</option>
                                        {{-- @foreach ($gins as $gin)
                                            <option {{ optionSelected($old_request->gin, $gin->id) }}
                                                value="{{ $gin->id }}">{{ $gin->GIN }}</option>
                                        @endforeach --}}
                                    </select>
                                </div>
                                <div class="col-sm-3 align-self-end">
                                    <label for="#">Lot Number</label>
                                    <input type="text" name="lot_number" value="{{ $old_request->lot_number }}"
                                        class="form-control" />
                                </div>
                                <div class="col-sm-3">
                                    <label for="#">Category</label>
                                    <select name="category" class="form-select form-control select2Picker"
                                        aria-label="Floating label select example">
                                        <option selected="" value="all">All</option>
                                        <option {{ $old_request->category == 'FM' ? 'selected' : '' }} value="FM">FM
                                        </option>
                                        <option {{ $old_request->category == 'Non-FM' ? 'selected' : '' }} value="Non-FM">
                                            Non-FM</option>
                                    </select>
                                </div>
                                <div class="col-sm-3">
                                    <label for="#">Overstocked</label>
                                    <select name="overstock" class="form-select form-control select2Picker"
                                        data-live-search="true" id="floatingSelect"
                                        aria-label="Floating label select example">
                                        <option selected="" value="all">All</option>
                                        <option {{ $old_request->overstock == '1' ? 'selected' : '' }} value="1">Yes
                                        </option>
                                        <option {{ $old_request->overstock == '0' ? 'selected' : '' }} value="0">No
                                        </option>
                                    </select>
                                </div>
                                <div class="col-sm-3">
                                    <label for="#">From</label>
                                    <input value="{{ $old_request->from_date }}" name="from_date" type="date"
                                        class="form-control" />
                                </div>
                                <div class="col-sm-3">
                                    <label for="#">To</label>
                                    <input value="{{ $old_request->to_date }}" name="to_date" type="date"
                                        class="form-control" />
                                </div>

                                <div class="col-3">
                                    <div class="d-flex gap-2">
                                        <button name="search" value="1" class="btn btn-primary w-100" type="submit">
                                            Search <i class="bi bi-search ps-2"></i>
                                        </button>
                                        @if ($old_request->search)
                                            <button id="formClear" class="btn btn-secondary w-100" type="button">
                                                Clear </i>
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </form>
                        <!-- End General Form Elements -->
                        <hr class="my-4" />

                        <form method="POST" action="{{ route('admin.dashboard.download') }}">
                            @csrf
                            <input type="hidden" name="d_country"
                                value="{{ $old_request->country ? implode(',', $old_request->country) : 'all' }}">
                            <input type="hidden" name="d_distributor"
                                value="{{ $old_request->distributor ? implode(',', $old_request->distributor) : 'all' }}">
                            <input type="hidden" name="d_gin"
                                value="{{ $old_request->gin ? implode(',', $old_request->gin) : 'all' }}">
                            <input type="hidden" name="d_lot_number" value="{{ $old_request->lot_number }}">
                            <input type="hidden" name="d_category" value="{{ $old_request->category ?? 'all' }}">
                            <input type="hidden" name="d_overstock" value="{{ $old_request->overstock ?? 'all' }}">
                            <input type="hidden" name="d_from_date" value="{{ $old_request->from_date }}">
                            <input type="hidden" name="d_to_date" value="{{ $old_request->to_date }}">
                            <div class="btn_group d-flex justify-content-end mt-3 gap-3">
                                <button class="btn btn-secondary align-self-end" name="download" type="submit">
                                    <i class="bi bi-download"></i> Download
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Left side columns -->
            {{-- <div class="col-lg-12">
                <div class="row">
                    <!-- Sales Card -->
                    <div class="col-xxl-3 col-md-6">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <h5 class="card-title">Stock on Hand</h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-basket"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ $data['stock_on_hand'] }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Sales Card -->

                    <!-- Revenue Card -->
                    <div class="col-xxl-3 col-md-6">
                        <div class="card info-card revenue-card">
                            <div class="card-body">
                                <h5 class="card-title">Goods in Transit</h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-truck"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ $data['goods_in_transit'] }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Revenue Card -->

                    <!-- Customers Card -->
                    <div class="col-xxl-3 col-xl-12">
                        <div class="card info-card customers-card">
                            <div class="card-body">
                                <h5 class="card-title">Stock on Order</h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-cart-check"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ $data['stock_on_order'] }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Customers Card -->

                    <!-- Customers Card -->
                    <div class="col-xxl-3 col-xl-12">
                        <div class="card info-card customers-card overstock-card">
                            <div class="card-body">
                                <h5 class="card-title">No. of Distributor with Stock</h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-shop-window"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ $data['no_distributor'] }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
--}}

            @if ($products !== null)
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            @if ($products->count())
                                <!-- Bordered Table -->
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="table_bg" scope="col">Country</th>
                                            <th class="table_bg" scope="col">Distributor</th>
                                            <th class="table_bg" scope="col">GIN Number</th>
                                            <th class="table_bg" scope="col">Lot</th>
                                            <th class="table_bg" scope="col">Category</th>
                                            <th class="table_bg" scope="col">Stock on Hand</th>
                                            <th class="table_bg" scope="col">Overstocked</th>
                                            <th class="table_bg" scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($products as $pro)
                                            <tr>
                                                <td id='country-{{ $pro->id }}'>
                                                    {{ $countries->flatten()->where('code', $pro->product->country_code)->first()->name }}
                                                </td>
                                                <td id='distributor-{{ $pro->id }}'>
                                                    {{ $distributors->where('id', $pro->user_id)->first()->distributor->company_name }}
                                                </td>
                                                <td id='GIN-{{ $pro->id }}'>{{ $pro->product->GIN }}</td>
                                                <td id='lot_no-{{ $pro->id }}'>{{ $pro->lot_number }}</td>
                                                <td id='category-{{ $pro->id }}'>
                                                    {{ $pro->product->category }}
                                                </td>
                                                <td id='stock_on_hand-{{ $pro->id }}'>
                                                    {{ number_format($pro->stock_on_hand, 0) }}</td>
                                                <td id='overstocked-{{ $pro->id }}'>
                                                    @if ($pro->overstocked)
                                                        <b class="clr_grn me-2">Yes</b>
                                                    @else
                                                        <b class="clr_red me-2">No</b>
                                                    @endif
                                                </td>
                                                <input type="hidden" id='disc-{{ $pro->id }}'
                                                    value="{{ $pro->product->description }}">
                                                <input type="hidden" id='uom-{{ $pro->id }}'
                                                    value="{{ $pro->product->UOM }}">
                                                <input type="hidden" id='goods_in_transit-{{ $pro->id }}'
                                                    value="{{ number_format($pro->goods_in_transit, 0) }}">
                                                <input type="hidden" id='stock_on_order-{{ $pro->id }}'
                                                    value="{{ number_format($pro->stock_on_order, 0) }}">
                                                <input type="hidden" id='avg_sales-{{ $pro->id }}'
                                                    value="{{ number_format($pro->avg_sales, 2) }}">
                                                <input type="hidden" id='date-{{ $pro->id }}'
                                                    value="{{ $pro->created_at->format('d/m/Y') }}">
                                                <td>
                                                    <span>
                                                        <a href="#" data-id={{ $pro->id }}
                                                            class="btn btn-view modal-toggle">
                                                            <i class="bi bi-binoculars"></i> Quick View</a>
                                                    </span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <!-- End Bordered Table -->
                            @else
                                <h4 class="text-center">No Result Found</h4>
                            @endif
                        </div>
                    </div>
                </div>

            @endif


        </div>
        </div>
        <!-- End Left side columns -->
        </div>
    </section>

    <script>
        $('#formClear').on('click', function() {
            window.location.href = "{{ route('admin.dashboard') }}";
        });

        $('.modal-toggle').on('click', function(e) {

            $id = $(this).data('id')

            $('#m_country').html($('#country-' + $id).html());
            $('#m_distributor').html($('#distributor-' + $id).html());
            $('#m_GIN').html($('#GIN-' + $id).html());
            $('#m_lot_no').html($('#lot_no-' + $id).html());
            $('#m_disc').html($('#disc-' + $id).val());
            $('#m_uom').html($('#uom-' + $id).val());
            $('#m_category').html($('#category-' + $id).html());
            $('#m_stock_on_hand').html($('#stock_on_hand-' + $id).html());
            $('#m_goods_in_transit').html($('#goods_in_transit-' + $id).val());
            $('#m_stock_on_order').html($('#stock_on_order-' + $id).val());
            $('#m_avg_sales').html($('#avg_sales-' + $id).val());
            $('#m_date').html($('#date-' + $id).val());
            $('#m_overstocked').html($('#overstocked-' + $id).html());

            $('#quick-view').modal('show');
        })
    </script>

    @if ($old_request->gin)
        <script>
            function getData() {
                $.ajax({
                    url: '{{ route('selected_gins') }}',
                    dataType: 'json',
                    data: {
                        "old_gin": "{{ implode($old_request->gin, ',') }}",
                    }
                }).done(function(data) {
                    console.log(data);
                    $('.select2PickerGIN').val(null);
                    data.forEach(element => {
                        var newOption = new Option(element.text, element.id, true, true);
                        $('.select2PickerGIN').append(newOption);
                    });

                    $('.select2PickerGIN').trigger('change');

                    $('.select2PickerGIN').trigger('change.select2');
                });
            }

            $(document).ready(function() {
                getData()
            })
        </script>
    @endif

    {{-- <script>
        // $(document).ready(function() {
        //     console.log("a");
        //     $('.selectpicker').each(function() {
        //         $(this).on('select2:select', function(e) {
        //             console.log("a");
        //         })
        //     });
        // })

        $('.selectpicker').on('changed.bs.select', function(e, clickedIndex, isSelected, previousValue) {
            console.log(clickedIndex);
            console.log(isSelected);
            if (clickedIndex == 0) {
                console.log("a");
                $(this).selectpicker('deselectAll');
                $(this).selectpicker('val', 'all');

            } else {
                // console.log("b");
                // values = $(this).val();
                // var arr = Object.keys(values).map(function(key) {
                //     if (values[key] !== 'all') {
                //         return values[key];
                //     }
                // });
                // console.log(arr);
                // $(this).selectpicker('val', arr);
            }
        });
    </script> --}}
@endsection


@section('modal')
    <div class="modal fade" id="quick-view" tabindex="-1" aria-labelledby="quick-viewModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <!-- Bordered Table -->
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="table_bg" scope="col">Country</th>
                                            <th class="table_bg" scope="col">Distributor</th>
                                            <th class="table_bg" scope="col">GIN Number</th>
                                            <th class="table_bg" scope="col">Lot</th>
                                            <th class="table_bg" scope="col">Description</th>
                                            <th class="table_bg" scope="col">UOM</th>
                                            <th class="table_bg" scope="col">Category</th>
                                            <th class="table_bg" scope="col">Stock on Hand</th>
                                            <th class="table_bg" scope="col">Goods in Transit</th>
                                            <th class="table_bg" scope="col">Stock on Order</th>
                                            <th class="table_bg" scope="col">Avg Sales/Month</th>
                                            <th class="table_bg" scope="col">Created Date</th>
                                            <th class="table_bg" scope="col">Overstocked</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td id="m_country"></td>
                                            <td id="m_distributor"></td>
                                            <td id="m_GIN"></td>
                                            <td id="m_lot_no"></td>
                                            <td id="m_disc"></td>
                                            <td id="m_uom"></td>
                                            <td id="m_category"></td>
                                            <td id="m_stock_on_hand"></td>
                                            <td id="m_goods_in_transit"></td>
                                            <td id="m_stock_on_order"></td>
                                            <td id="m_avg_sales"></td>
                                            <td id="m_date"></td>
                                            <td id="m_overstocked"></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <!-- End Bordered Table -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
