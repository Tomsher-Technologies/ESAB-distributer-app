<div>
    <div class="pagetitle">
        <h1>Requests</h1>
    </div>
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card m-0">
                    <div class="card-body">
                        <!-- General Form Elements -->
                        <form>
                            <div class="row g-3">
                                <div class="col-sm-3">
                                    <label for="#">Date</label>
                                    <input wire:model="date" type="date" class="form-control">
                                </div>
                                <div class="col-sm-3">
                                    <label for="#">From Distributor</label>
                                    <select wire:model.lazy="from" class="form-select form-control">
                                        <option selected="" value="0">All</option>
                                        @foreach ($distributors as $distributor)
                                            <option value="{{ $distributor->id }}">{{ $distributor->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-sm-3">
                                    <label for="#">To Distributor</label>
                                    <select wire:model.lazy="to" class="form-select form-control">
                                        <option selected="" value="0">All</option>
                                        @foreach ($distributors as $distributor)
                                            <option value="{{ $distributor->id }}">{{ $distributor->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-sm-3">
                                    <label for="#">GIN Number</label>
                                    <select wire:model.lazy="gin" class="form-select form-control">
                                        <option selected="" value="0">All</option>
                                        @foreach ($gins as $products)
                                            <option value="{{ $products->id }}">{{ $products->GIN }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-3">
                                    <label for="#">Status</label>
                                    <select wire:model.lazy="status" class="form-select form-control"
                                        id="floatingSelect" aria-label="Floating label select example">
                                        <option selected="" value="0">All</option>
                                        <option value="1">Pending</option>
                                        <option value="2">Completed</option>
                                        {{-- <option value="3">Rejected</option> --}}
                                    </select>
                                </div>

                            </div>
                        </form><!-- End General Form Elements -->
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="d-flex justify-content-end mb-3">
                </div>
                <div class="card">
                    <div class="card-body">
                        <!-- Bordered Table -->
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="table_bg" scope="col">#</th>
                                    <th class="table_bg" scope="col">From Distributor</th>
                                    <th class="table_bg" scope="col">To Distributor</th>
                                    <th class="table_bg" scope="col">GIN Number</th>
                                    <th class="table_bg" scope="col">Lot</th>
                                    <th class="table_bg" scope="col">Quantity</th>
                                    <th class="table_bg" scope="col">Date</th>
                                    <th class="table_bg" scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($requests as $request)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $request->fromDistributor->name }}</td>
                                        <td>{{ $request->toDistributor->name }}</td>
                                        <td>{{ $request->product->GIN }}</td>
                                        <td>{{ $request->product->lot_no }}</td>
                                        <td>{{ $request->quantity }}</td>
                                        <td>{{ $request->created_at->format('d-m-Y') }}</td>
                                        <td>
                                            @if ($request->status == 1)
                                                <button class="btn btn-view" wire:click="markCompleted({{ $request->id }})">
                                                    <i class="bi bi-check-all"></i> Mark as Completed
                                                </button>
                                            @else
                                                <b class="clr_grn">Completed</b>
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
    <script>
        window.addEventListener('created', event => {
            Swal.fire({
                title: 'Request updated successfully!',
                icon: 'success'
            });
        })
    </script>
</div>
