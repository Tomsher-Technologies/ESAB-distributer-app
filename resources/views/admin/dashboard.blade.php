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
                                    <select name="country" class="form-select form-control">
                                        <option selected="" value="all">All</option>
                                        @foreach ($countries as $country)
                                            <option {{ $old_request->country == $country->code ? 'selected' : '' }}
                                                value="{{ $country->code }}">{{ $country->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-sm-3">
                                    <label for="#">Distributor</label>
                                    <select name="distributor" class="form-select form-control">
                                        <option selected="" value="all">All</option>
                                        @foreach ($distributors as $distributor)
                                            <option {{ $old_request->distributor == $distributor->id ? 'selected' : '' }}
                                                value="{{ $distributor->id }}">{{ $distributor->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-sm-3">
                                    <label for="#">GIN Number</label>
                                    <select name="gin" class="form-select form-control">
                                        <option selected="" value="all">All</option>
                                        @foreach ($gins as $gin)
                                            <option {{ $old_request->gin == $gin->id ? 'selected' : '' }}
                                                value="{{ $gin->id }}">{{ $gin->GIN }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-sm-3">
                                    <label for="#">Category</label>
                                    <select name="category" class="form-select form-control" id="floatingSelect"
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
                                    <select name="overstock" class="form-select form-control" id="floatingSelect"
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
                                <div class="col-sm-3 align-self-end">

                                    @if ($old_request->search)
                                        <div class="d-flex gap-2">
                                            <button name="search" value="1" class="btn btn-primary w-100"
                                                type="submit">
                                                Search <i class="bi bi-search ps-2"></i>
                                            </button>
                                            <button id="formClear" class="btn btn-secondary w-100" type="button">
                                                Clear </i>
                                            </button>
                                        </div>
                                    @else
                                        <button name="search" value="1" class="btn btn-primary w-100" type="submit">
                                            Search <i class="bi bi-search ps-2"></i>
                                        </button>
                                    @endif


                                </div>
                            </div>
                        </form>
                        <!-- End General Form Elements -->
                        <hr class="my-4" />

                        <form method="POST" action="{{ route('admin.dashboard.download') }}">
                            @csrf
                            <input type="hidden" name="d_country" value="{{ $old_request->country ?? 'all' }}">
                            <input type="hidden" name="d_distributor" value="{{ $old_request->distributor ?? 'all' }}">
                            <input type="hidden" name="d_gin" value="{{ $old_request->gin ?? 'all' }}">
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
            <div class="col-lg-12">
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
                                <h5 class="card-title">No. of Distributor</h5>
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

                    <!-- End Customers Card -->
                    <!-- Reports -->

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
                                                    @php
                                                        $p_product = $gins->where('id', $pro->product_id)->first();
                                                    @endphp

                                                    <tr>
                                                        <td id='country-{{ $pro->id }}'>
                                                            {{ $countries->where('code', $p_product->country_code)->first()->name }}
                                                        </td>
                                                        <td id='distributor-{{ $pro->id }}'>
                                                            {{ $distributors->where('id', $pro->user_id)->first()->name }}
                                                        </td>
                                                        <td id='GIN-{{ $pro->id }}'>{{ $p_product->GIN }}</td>
                                                        <td id='lot_no-{{ $pro->id }}'>{{ $p_product->lot_no }}</td>
                                                        <td id='category-{{ $pro->id }}'>
                                                            {{ $p_product->category }}
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
                                                            value="{{ $p_product->description }}">
                                                        <input type="hidden" id='uom-{{ $pro->id }}'
                                                            value="{{ $p_product->UOM }}">
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
