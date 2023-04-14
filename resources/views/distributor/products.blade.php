@extends('distributor.layouts.app', ['body_class' => ''])

@section('content')
    <div class="pagetitle mb-4">
        <h1>All Products</h1>
    </div>
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <!-- General Form Elements -->
                        <form>
                            <div class="row g-3">
                                <div class="col-sm-4">
                                    <label for="#">GIN Number</label>
                                    <select class="form-select form-control" id="floatingSelect"
                                        aria-label="Floating label select example">
                                        <option selected="">Select</option>
                                        <option value="1">48004040V0 </option>
                                        <option value="2">48004040V1</option>
                                    </select>
                                </div>
                                <div class="col-sm-4">
                                    <label for="#">Category</label>
                                    <select class="form-select form-control" id="floatingSelect"
                                        aria-label="Floating label select example">
                                        <option selected="">Select</option>
                                        <option value="1">FM</option>
                                        <option value="2">Non-FM</option>
                                    </select>
                                </div>
                                <div class="col-sm-4">
                                    <label for="#">Overstocked</label>
                                    <select class="form-select form-control" id="floatingSelect"
                                        aria-label="Floating label select example">
                                        <option selected="">Select</option>
                                        <option value="1">Yes</option>
                                        <option value="2">No </option>
                                    </select>
                                </div>
                                <div class="col-sm-4">
                                    <label for="#">From</label>
                                    <input type="date" class="form-control">
                                </div>
                                <div class="col-sm-4">
                                    <label for="#">To</label>
                                    <input type="date" class="form-control">
                                </div>
                                <div class="col-sm-4 align-self-end">
                                    <div class="btn_group d-flex justify-content-between mt-3 gap-3 ">
                                        <a class="btn btn-secondary" href="#"> Search <i
                                                class="bi bi-search ps-2"></i></a>
                                        <a class="btn btn-secondary align-self-end" href="#"> <i
                                                class="bi bi-download"></i> Download</a>
                                    </div>
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
                                    <th class="table_bg" scope="col">GIN Number</th>
                                    <th class="table_bg" scope="col">Lot</th>
                                    <th class="table_bg" scope="col">Description</th>
                                    <th class="table_bg" scope="col">UOM</th>
                                    <th class="table_bg" scope="col">Category</th>
                                    <th class="table_bg" scope="col">Stock on Hand</th>
                                    <th class="table_bg" scope="col">Goods in Transit</th>
                                    <th class="table_bg" scope="col">Stock on Order</th>
                                    <th class="table_bg" scope="col">Avg Sales/Month</th>
                                    <th class="table_bg">Created Date</th>
                                    <th class="table_bg" scope="col">Overstocked</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>48004040V0 </td>
                                    <td>24</td>
                                    <td>OK 48.00 4.0x450mm 3/4 VP </td>
                                    <td>KGM </td>
                                    <td>FM</td>
                                    <td>1,815</td>
                                    <td>0</td>
                                    <td>4,000</td>
                                    <td>9.1</td>
                                    <td>28-01-2023</td>
                                    <td><b class="clr_grn me-2">Yes</b></td>
                                </tr>
                                <tr>
                                    <td>48004040V0 </td>
                                    <td>18</td>
                                    <td>OK 48.00 4.0x450mm 3/4 VP </td>
                                    <td>KGM </td>
                                    <td>Non-FM</td>
                                    <td>1,815</td>
                                    <td>0</td>
                                    <td>6,000</td>
                                    <td>7.4</td>
                                    <td>28-01-2023</td>
                                    <td><b class="clr_red me-2">No </b></td>
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
