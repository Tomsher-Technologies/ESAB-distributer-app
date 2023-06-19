<div>
    <div class="pagetitle mb-4">
        <h1>My Products</h1>
    </div>
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <!-- General Form Elements -->
                        <div class="row g-3">
                            <div class="col-sm-4">
                                <label for="#">GIN Number</label>
                                <div wire:ignore>
                                    <select wire:model="selected_gin" class="form-select form-control select2Picker2"
                                        data-model="selected_gin" multiple>
                                        <option value="all" selected="0">All</option>
                                        @foreach ($gins->unique('product.GIN') as $gin)
                                            <option value="{{ $gin->product->id }}">{{ $gin->product->GIN }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <label for="#">Category</label>
                                <div wire:ignore>
                                    <select wire:model="category" class="form-select form-control select2Picker2"
                                        data-model="category">
                                        <option selected="" value="all">All</option>
                                        <option value="FM">FM</option>
                                        <option value="Non-FM">Non-FM</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <label for="#">Overstocked</label>
                                <div wire:ignore>
                                    <select wire:model="overstocked" class="form-select form-control select2Picker2"
                                        data-model="overstocked">
                                        <option selected="" value="all">All</option>
                                        <option value="1">Yes</option>
                                        <option value="0">No </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <label for="#">From</label>
                                <input wire:model="start_date" type="date" class="form-control ">
                            </div>
                            <div class="col-sm-4">
                                <label for="#">To</label>
                                <input wire:model="end_date" type="date" class="form-control">
                            </div>
                            <div class="col-sm-4 align-self-end">
                                <div class="btn_group d-flex justify-content-between mt-3 gap-3 ">
                                    @if ($show_clear)
                                        <button class="btn btn-secondary" wire:click="clearForm">
                                            Clear Search
                                        </button>
                                    @endif
                                    <a wire:click.prevent="download" class="btn btn-secondary align-self-end" href="#"> <i
                                            class="bi bi-download"></i> Download</a>
                                </div>
                            </div>
                        </div>
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
                                    <th class="table_bg" scope="col">Overstocked</th>
                                    <th class="table_bg" scope="col">Created At</th>
                                    <th class="table_bg" scope="col">Last Updated At</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($products as $pro)
                                    <tr>
                                        <td>{{ $pro->product->GIN }}</td>
                                        <td>{{ $pro->lot_number }}</td>
                                        <td>{{ $pro->product->description }}</td>
                                        <td>{{ $pro->product->UOM }}</td>
                                        <td>{{ $pro->product->category }}</td>
                                        <td>{{ number_format($pro->stock_on_hand) }}</td>
                                        <td>{{ number_format($pro->goods_in_transit) }}</td>
                                        <td>{{ number_format($pro->stock_on_order) }}</td>
                                        <td>{{ number_format($pro->avg_sales, 2) }}</td>
                                        @if ($pro->overstocked)
                                            <td><b class="clr_grn me-2">Yes</b></td>
                                        @else
                                            <td><b class="clr_red me-2">No </b></td>
                                        @endif
                                        <td>{{ $pro->created_at ? $pro->created_at->format('d-m-Y') : '--' }}</td>
                                        <td>{{ $pro->updated_at ? $pro->updated_at->format('d-m-Y') : '--' }}</td>
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

        window.addEventListener('clear_select', event => {
            $(".select2Picker2").val('').trigger('change')
            // $("#selected_gin").val('').trigger('change')
            // $("#selected_gin").val('').trigger('change')
        })
    </script>

</div>
