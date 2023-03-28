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
                        <form>
                            <div class="row g-3">
                                <div class="col-sm-3">
                                    <label for="#">Country</label>
                                    <select class="form-select form-control">
                                        <option selected="">Select</option>
                                        <option value="1">UAE</option>
                                        <option value="2">KSA</option>
                                        <option value="3">Nigeria</option>
                                    </select>
                                </div>

                                <div class="col-sm-3">
                                    <label for="#">Distributor</label>
                                    <select class="form-select form-control">
                                        <option selected="">Select</option>
                                        <option value="1">UAE</option>
                                        <option value="2">KSA</option>
                                        <option value="3">Nigeria</option>
                                    </select>
                                </div>

                                <div class="col-sm-3">
                                    <label for="#">GIN Number</label>
                                    <select class="form-select form-control">
                                        <option selected="">Select</option>
                                        <option value="1">48004040V0</option>
                                        <option value="2">35004040V1</option>
                                        <option value="3">67004040V2</option>
                                    </select>
                                </div>

                                <div class="col-sm-3">
                                    <label for="#">Category</label>
                                    <select class="form-select form-control" id="floatingSelect"
                                        aria-label="Floating label select example">
                                        <option selected="">Select</option>
                                        <option value="1">FM</option>
                                        <option value="2">Non-FM</option>
                                    </select>
                                </div>
                                <div class="col-sm-3">
                                    <label for="#">Overstocked</label>
                                    <select class="form-select form-control" id="floatingSelect"
                                        aria-label="Floating label select example">
                                        <option selected="">Select</option>
                                        <option value="1">Yes</option>
                                        <option value="2">No</option>
                                    </select>
                                </div>
                                <div class="col-sm-3">
                                    <label for="#">From</label>
                                    <input type="date" class="form-control" />
                                </div>
                                <div class="col-sm-3">
                                    <label for="#">To</label>
                                    <input type="date" class="form-control" />
                                </div>
                                <div class="col-sm-3 align-self-end">
                                    <a class="btn btn-secondary w-100" href="#">
                                        Search <i class="bi bi-search ps-2"></i></a>
                                </div>
                            </div>
                        </form>
                        <!-- End General Form Elements -->
                        <hr class="my-4" />

                        <div class="btn_group d-flex justify-content-end mt-3 gap-3">
                            <a class="btn btn-secondary align-self-end" href="#">
                                <i class="bi bi-download"></i> Download
                            </a>
                        </div>
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
                                        <h6>145</h6>
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
                                        <h6>3,264</h6>
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
                                        <h6>1244</h6>
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
                                        <h6>{{ $no_distributor }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- End Customers Card -->
                    <!-- Reports -->
                    <div class="col-lg-12">
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
                                            <th class="table_bg" scope="col">Category</th>
                                            <th class="table_bg" scope="col">Stock on Hand</th>
                                            <th class="table_bg" scope="col">Overstocked</th>
                                            <th class="table_bg" scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>UAE</td>
                                            <td>ARSA</td>
                                            <td>48004040V0</td>
                                            <td>12</td>
                                            <td>FM</td>
                                            <td>1,500</td>
                                            <td><b class="clr_grn me-2">Yes</b></td>
                                            <td>
                                                <span>
                                                    <a href="#" class="btn btn-view" data-bs-toggle="modal"
                                                        data-bs-target="#quick-view">
                                                        <i class="bi bi-binoculars"></i> Quick View</a>
                                                </span>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>KSA</td>
                                            <td>ARSA</td>
                                            <td>48004040V0</td>
                                            <td>14</td>
                                            <td>FM</td>
                                            <td>480</td>
                                            <td><b class="clr_red me-2">No</b></td>
                                            <td>
                                                <span>
                                                    <a href="#" class="btn btn-view" data-bs-toggle="modal"
                                                        data-bs-target="#quick-view">
                                                        <i class="bi bi-binoculars"></i> Quick View</a>
                                                </span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <!-- End Bordered Table -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Left side columns -->
        </div>
    </section>
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
                                            <td>UAE</td>
                                            <td>ARSA</td>
                                            <td>48004040V0</td>
                                            <td>12</td>
                                            <td>OK 48.00 4.0x450mm 3/4 VP</td>
                                            <td>KGM</td>
                                            <td>FM</td>
                                            <td>1,815</td>
                                            <td>0</td>
                                            <td>5,000</td>
                                            <td>1,290</td>
                                            <td>28-01-2023</td>
                                            <td><b class="clr_grn me-2">Yes</b></td>
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