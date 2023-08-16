<div>
    <div class="pagetitle">
        <h1>Upload History</h1>
    </div>
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="d-flex justify-content-end mb-3">
                    <div class="search_calendar w-50">
                        <div class="row">
                            <div class="col-sm-6">
                                <label for="#">From</label>
                                <input wire:model="form_start_date" type="date" class="form-control border-0">
                                <x-form.l-w-error name="form_start_date" />
                            </div>
                            <div class="col-sm-6">
                                <label for="#">To</label>
                                <input wire:model="form_end_date" type="date" class="form-control border-0">
                            </div>
                        </div>
                    </div>
                    <button wire:click="filter" type="button" class="btn btn-secondary ms-3 align-self-end px-4">
                        <i class="bi bi-funnel"></i>
                        Filter
                    </button>
                </div>
                <div class="card">
                    <div class="card-body">
                        <!-- Bordered Table -->
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="table_bg" scope="col">GIN</th>
                                    <th class="table_bg" scope="col">Lot No</th>
                                    <th class="table_bg" scope="col">Stock On Hand</th>
                                    <th class="table_bg" scope="col">Goods In Transit</th>
                                    <th class="table_bg" scope="col">Stock On Order</th>
                                    <th class="table_bg" scope="col">Avg Sales/Month</th>
                                    <th class="table_bg" scope="col">Overstock</th>
                                    <th class="table_bg" scope="col">Created At</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($uploads as $upload)
                                    <tr>
                                        <th scope="row">{{ $upload->product->GIN }}</th>
                                        <td>{{ $upload->lot_no }}</td>
                                        <td>{{ $upload->stock_on_hand }}</td>
                                        <td>{{ $upload->goods_in_transit }}</td>
                                        <td>{{ $upload->stock_on_order }}</td>
                                        <td>{{ $upload->avg_sales_month }}</td>
                                        @if ($upload->over_stock)
                                            <td><b class="clr_grn me-2">Yes</b></td>
                                        @else
                                            <td><b class="clr_red me-2">No </b></td>
                                        @endif
                                        <td>{{ $upload->created_at->format('d-m-Y - h-i A') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $uploads->links() }}
                        <!-- End Bordered Table -->
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
