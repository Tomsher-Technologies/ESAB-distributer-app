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
                                    <select class="form-select form-control" id="floatingSelect"
                                        aria-label="Floating label select example">
                                        <option selected="" value="0">Select</option>
                                        @foreach ($countries as $country)
                                            <option value="{{ $country->id }}">{{ $country->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-3">
                                    <label for="#">GIN Number</label>
                                    <select class="form-select form-control" id="floatingSelect"
                                        aria-label="Floating label select example">
                                        <option selected="" value="0">Select</option>
                                        @foreach ($gins as $gin)
                                            <option value="{{ $gin->GIN }}">{{ $gin->GIN }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-3">
                                    <label for="#">Category</label>
                                    <select class="form-select form-control" id="floatingSelect"
                                        aria-label="Floating label select example">
                                        <option selected="">Select</option>
                                        <option value="FM">FM</option>
                                        <option value="Non-FM">Non-FM</option>
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
                                <tr>
                                    <td>UAE</td>
                                    <td>48004040V0</td>
                                    <td>12</td>
                                    <td>FM</td>
                                    <td>1200</td>
                                    <td> <b class="clr_grn me-2">Yes</b> </td>
                                    <td><a href="#" class="btn btn-view" data-bs-toggle="modal"
                                            data-bs-target="#exampleModal3">Request</a></td>
                                </tr>
                            </tbody>
                        </table>
                        <!-- End Bordered Table -->
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
