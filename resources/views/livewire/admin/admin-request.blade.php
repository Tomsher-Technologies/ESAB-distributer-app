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
                                    <div wire:ignore>
                                        <select wire:model="from" data-model="from"
                                            class="form-select form-control select2Picker2" data-live-search="true"
                                            multiple>
                                            <option selected="" value="all">All</option>
                                            @foreach ($distributors as $distributor)
                                                <option value="{{ $distributor->id }}">{{ $distributor->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <label for="#">To Distributor</label>
                                    <div wire:ignore>
                                        <select wire:model="to" data-model="to" name="to[]"
                                            class="form-select form-control select2Picker2" data-live-search="true"
                                            multiple>
                                            <option selected="" value="all">All</option>
                                            @foreach ($distributors as $distributor)
                                                <option value="{{ $distributor->id }}">{{ $distributor->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <label for="#">GIN Number</label>
                                    <div wire:ignore>
                                        <select wire:model="gin" data-model="gin"
                                            class="form-select form-control select2Picker2" data-live-search="true"
                                            multiple>
                                            <option selected="" value="all">All</option>
                                            @foreach ($gins as $products)
                                                <option value="{{ $products->id }}">{{ $products->GIN }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <label for="#">Status</label>
                                    <div wire:ignore>
                                        <select wire:model="status" data-model="status"
                                            class="form-select form-control select2Picker2" data-live-search="true"
                                            multiple id="floatingSelect" aria-label="Floating label select example">
                                            <option selected="" value="all">All</option>
                                            <option value="1">Pending</option>
                                            <option value="3">Rejected</option>
                                            <option value="2">Completed</option>
                                        </select>
                                    </div>
                                </div>
                                @if ($showReset)
                                    <div class="col-sm-3">
                                        <label for="#">&nbsp;</label>
                                        <button wire:click="resetForm()" type="button" value="1"
                                            class="btn btn-primary w-100">
                                            Clear
                                        </button>
                                    </div>
                                @endif
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
                                    <th class="table_bg" scope="col">Tracking Number</th>
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
                                        <td>{{ $request->lot_number }}</td>
                                        <td>{{ $request->quantity }}</td>
                                        <td>{{ $request->tracking_number }}</td>
                                        <td>{{ $request->created_at->format('d-m-Y') }}</td>
                                        <td>
                                            @if ($request->status == 1)
                                                <button class="btn btn-view"
                                                    wire:click="markCompleted({{ $request->id }})">
                                                    <i class="bi bi-check-all"></i> Mark as Completed
                                                </button>
                                                <button class="btn btn-delete"
                                                    wire:click="markRejected({{ $request->id }})">
                                                    Reject
                                                </button>
                                            @else
                                                @if ($request->status == 2)
                                                    <b class="clr_grn">Completed</b>
                                                @else
                                                    <b class="clr_red">Rejected</b>
                                                @endif
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

    <script>
        window.loadContactDeviceSelect2 = () => {
            $('.select2Picker2').select2({
                placeholder: 'Select an option',
                disabled: $(this).data('disabled') ?? false,
                maximumSelectionLength: $(this).data('max') ?? 0,
            }).on('select2:select', function(e) {
                var data = e.params.data;
                if (data.id == 'all') {
                    $(this).val('all').change();
                } else {
                    var wanted_option = $(this).find('option[value="all"]');
                    wanted_option.prop('selected', false);
                    $(this).trigger('change.select2');
                }

                var model = $(this).data('model')
                var data = $(this).select2("val");
                @this.set(model, data);
            }).on('change', function() {

                var count = $(this).select2('data').length
                console.log(count);
                if (count == 0) {
                    $(this).val('all').change();
                }

                var model = $(this).data('model')
                var data = $(this).select2("val");
                @this.set(model, data);
            });
        }
        loadContactDeviceSelect2();
        window.livewire.on('loadContactDeviceSelect2', () => {
            loadContactDeviceSelect2();
        });
    </script>

</div>
