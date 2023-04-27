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
                                    <select name="country" class="form-select form-control" id="floatingSelect"
                                        aria-label="Floating label select example">
                                        <option selected="" value="all">All</option>
                                        @foreach ($countries as $country)
                                            <option {{ $request->country == $country->code ? 'selected' : '' }}
                                                value="{{ $country->code }}">{{ $country->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-3">
                                    <label for="#">GIN Number</label>
                                    <select name="gin" class="form-select form-control" id="floatingSelect"
                                        aria-label="Floating label select example">
                                        <option selected="" value="all">All</option>
                                        @foreach ($gins as $gin)
                                            <option {{ $request->gin == $gin->GIN ? 'selected' : '' }}
                                                value="{{ $gin->GIN }}">{{ $gin->GIN }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-3">
                                    <label for="#">Category</label>
                                    <select name="category" class="form-select form-control" id="floatingSelect"
                                        aria-label="Floating label select example">
                                        <option selected="all" value="all">All</option>
                                        <option {{ $request->category == 'FM' ? 'selected' : '' }} value="FM">FM
                                        </option>
                                        <option {{ $request->category == 'Non-FM' ? 'selected' : '' }} value="Non-FM">Non-FM
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
                                    <th class="table_bg" scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $pro)
                                    <tr>
                                        <td>{{ $pro->product->country->name }}</td>
                                        <td>{{ $pro->product->GIN }}</td>
                                        <td>{{ $pro->product->lot_no }}</td>
                                        <td>{{ $pro->product->category }}</td>
                                        <td>{{ $pro->stock_on_hand }}</td>
                                        @if ($pro->overstocked)
                                            <td> <b class="clr_grn me-2">Yes</b> </td>
                                        @else
                                            <td> <b class="clr_red me-2">No</b> </td>
                                        @endif
                                        <td>
                                            @if ( $pro->product->request->where('from_distributor', auth()->user()->id)->count() )
                                                Already requested
                                            @else
                                                <form class="form-inline"
                                                    action="{{ route('distributor.product.request') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $pro->product->id }}">
                                                    <input type="hidden" name="to" value="{{ $pro->user_id }}">
                                                    <div class="row">
                                                        <div class="col-9">
                                                            <input type="number" required max="{{ $pro->stock_on_hand }}"
                                                                class="form-control" name="quantity" placeholder="Quantity">
                                                        </div>
                                                        <div class="col-3">
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
