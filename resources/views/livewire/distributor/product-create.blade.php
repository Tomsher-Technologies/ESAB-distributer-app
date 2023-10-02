<div>

    <style>
        .loopelements .loopitem:not(:first-of-type) label {
            display: none;
        }
    </style>

    <form class="repeater" wire:submit.prevent="save()">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <div class="pagetitle">
                <h1> Add Products </h1>
            </div><!-- End Page Title -->
            <a class="btn btn-add" wire:click="addInput" data-repeater-create="" href="#"> <i class="bi bi-add"></i>Add
                Row</a>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body loopelements">
                            <!-- General Form Elements -->
                            @foreach ($inputs as $key => $input)
                                {{-- @php
                                    // $cur = $cur_a = $lot_a = null;
                                @endphp 
                                wire:model="inputs.{{ $key }}.gin"
                                --}}

                                <div class="loopitem" data-repeater-list="group-a">
                                    <div data-repeater-item=""
                                        class="row mb-2 g-2 justify-content-center align-items-center">
                                        <div class="col" wire:ignore>
                                            <label for="#">GIN Number</label>
                                            <select data-var="inputs.{{ $key }}.gin"
                                                data-model="{{ $key }}"
                                                wire:change="changeLot({{ $key }},$event.target.value)"
                                                name="gin"
                                                class="form-select form-control select2PickerGIN2 <x-form.error-class name='inputs.{{ $key }}.gin' />">
                                                <option selected disabled value="0">Select</option>
                                            </select>
                                        </div>
                                        <div class="col-md-1">
                                            <label for="#">Lot</label>
                                            <input type="text"
                                                class="form-control <x-form.error-class name='inputs.{{ $key }}.lot' />"
                                                placeholder="Enter Lot Number"
                                                wire:model.defer="inputs.{{ $key }}.lot" name="lot"
                                                value="{{ $this->getValue($key, 'description') }}">
                                        </div>
                                        <div class="col">
                                            <label for="#">Description</label>
                                            <input type="text" class="form-control"
                                                placeholder="Enter Distributor Code"
                                                value="{{ $this->getValue($key, 'description') }}" disabled>
                                        </div>
                                        <div class="col-md-1">
                                            <label for="#">UOM</label>
                                            <input type="text" class="form-control" placeholder="Enter UOM"
                                                value="{{ $this->getValue($key, 'UOM') }}" disabled="">
                                        </div>
                                        <div class="col-md-1">
                                            <label for="#">Category </label>
                                            <input type="text" class="form-control" placeholder="Category "
                                                value="{{ $this->getValue($key, 'category') }}" disabled="">
                                        </div>
                                        <div class="col-md-1">
                                            <label for="#">Stock on Hand</label>
                                            <input wire:model.defer="inputs.{{ $key }}.stock_hand"
                                                type="number"
                                                class="form-control <x-form.error-class name='inputs.{{ $key }}.stock_hand' />"
                                                placeholder="Enter Stock on Hand">

                                        </div>
                                        <div class="col-md-1">
                                            <label for="#">Goods in Transit</label>
                                            <input wire:model.defer="inputs.{{ $key }}.stock_transit"
                                                type="number"
                                                class="form-control <x-form.error-class name='inputs.{{ $key }}.stock_transit' />"
                                                placeholder="Enter Goods in Transit">
                                        </div>
                                        <div class="col-md-1">
                                            <label for="#">Stock on Order</label>
                                            <input wire:model.defer="inputs.{{ $key }}.stock_order"
                                                type="number"
                                                class="form-control <x-form.error-class name='inputs.{{ $key }}.stock_order' />"
                                                placeholder="Enter Stock on Order">
                                        </div>
                                        <div class="col">
                                            <label for="#">Avg sales/month </label>
                                            <input wire:model.defer="inputs.{{ $key }}.avg_sale"
                                                type="number" step=".01"
                                                class="form-control <x-form.error-class name='inputs.{{ $key }}.avg_sale' />"
                                                placeholder="Enter Average Sales per Month">
                                        </div>
                                        <div class="col-md-1">
                                            <label for="#">Over Stock</label>
                                            <select wire:model.defer="inputs.{{ $key }}.over_stock"
                                                class="form-select form-control <x-form.error-class name='inputs.{{ $key }}.over_stock' />"
                                                id="">
                                                <option selected disabled value="3">Select</option>
                                                <option value="1">Yes</option>
                                                <option value="0">No</option>
                                            </select>
                                        </div>
                                        <div class="col-md-1 w-auto align-self-center align-items-center">
                                            <a wire:click="removeInput({{ $key }})" data-repeater-delete=""
                                                href="#" class="text-danger d-inline-block mt-4 ms-2"> <i
                                                    class="bi bi-x-lg"></i></a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                            <div class="d-flex justify-content-sm-between mt-3">
                                <button class="btn btn-secondary align-self-end" type="submit">
                                    <i class="bi bi-add"></i>Submit
                                </button>
                            </div>
                            <!-- End General Form Elements -->
                            <!-- outer repeater -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </form>

    <script>
        window.addEventListener('created', event => {
            Swal.fire({
                title: 'Products added successfully!',
                icon: 'success'
            }).then(function() {
                location.reload();
            });
        })
        window.addEventListener('empty', event => {
            Swal.fire({
                title: 'Please add a product first',
                icon: 'warning'
            });
        })
    </script>

    <script>
        loadContactDeviceSelect2 = () => {
            $('.select2Picker2').select2({
                placeholder: 'Select an option',
                disabled: $(this).data('disabled') ?? false,
                maximumSelectionLength: $(this).data('max') ?? 0,
            }).on('select2:select', function(e) {

                var model = $(this).data('model')
                var data = $(this).select2("val");

                @this.changeLot(model, data)

                var l_v = $(this).data('var')

                @this.set(l_v, data);
            }).on('change', function() {
                var model = $(this).data('model')
                var l_v = $(this).data('var')
                var data = $(this).select2("val");

                @this.changeLot(model, data)
                @this.set(l_v, data);
            });

            $('.select2PickerGIN2').select2({
                placeholder: 'Select an option',
                disabled: $(this).data('disabled') ?? false,
                maximumSelectionLength: $(this).data('max') ?? 0,
                minimumInputLength: 2,
                ajax: {
                    url: '{{ route('gins') }}',
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        var query = {
                            search: params.term,
                        }
                        return query;
                    }
                }
            }).on('select2:select', function(e) {

                var model = $(this).data('model')
                var data = $(this).select2("val");

                @this.changeLot(model, data)

                var l_v = $(this).data('var')

                @this.set(l_v, data);
            }).on('change', function() {
                var model = $(this).data('model')
                var l_v = $(this).data('var')
                var data = $(this).select2("val");

                @this.changeLot(model, data)
                @this.set(l_v, data);
            });
        }
        loadContactDeviceSelect2();

        window.livewire.on('added_new_row', () => {
            loadContactDeviceSelect2();
        });

        window.addEventListener('clear_select', event => {
            $(".select2Picker2").val('').trigger('change')
        })
    </script>

</div>
