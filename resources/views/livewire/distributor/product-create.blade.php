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
                                @endphp --}}

                                <div class="loopitem" data-repeater-list="group-a">
                                    <div data-repeater-item=""
                                        class="row mb-2 g-2 justify-content-center align-items-center">
                                        <div class="col">
                                            <label for="#">GIN Number</label>
                                            <select wire:change="changeLot({{ $key }},$event.target.value)"
                                                wire:model="inputs.{{ $key }}.gin" name="gin"
                                                class="form-select form-control <x-form.error-class name='inputs.{{ $key }}.gin' />">
                                                <option selected disabled value="0">Select</option>
                                                @foreach ($gins as $gin)
                                                    <option value="{{ $gin->id }}">{{ $gin->GIN }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-1">
                                            <label for="#">Lot</label>
                                            <input type="text"
                                                class="form-control <x-form.error-class name='inputs.{{ $key }}.lot' />"
                                                placeholder="Enter Lot Number"
                                                wire:model="inputs.{{ $key }}.lot" name="lot"
                                                value="{{ $this->getValue($key, 'description') }}">
                                            {{-- <select wire:change="changeLot({{ $key }},$event.target.value)"
                                                wire:model="inputs.{{ $key }}.lot" name="lot"
                                                class="form-select form-control <x-form.error-class name='inputs.{{ $key }}.lot' />">

                                                @if (array_key_exists($key, $lots))
                                                    @foreach ($lots[$key] as $lot)
                                                        <option value="{{ $lot['id'] }}">{{ $lot['lot_no'] }}
                                                        </option>
                                                    @endforeach
                                                @else
                                                    <option selected value="0">Select</option>
                                                @endif
                                            </select> --}}
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
                                            <input wire:model="inputs.{{ $key }}.stock_hand" type="number"
                                                class="form-control <x-form.error-class name='inputs.{{ $key }}.stock_hand' />"
                                                placeholder="Enter Stock on Hand">

                                        </div>
                                        <div class="col-md-1">
                                            <label for="#">Goods in Transit</label>
                                            <input wire:model="inputs.{{ $key }}.stock_transit" type="number"
                                                class="form-control <x-form.error-class name='inputs.{{ $key }}.stock_transit' />"
                                                placeholder="Enter Goods in Transit">
                                        </div>
                                        <div class="col-md-1">
                                            <label for="#">Stock on Order</label>
                                            <input wire:model="inputs.{{ $key }}.stock_order" type="number"
                                                class="form-control <x-form.error-class name='inputs.{{ $key }}.stock_order' />"
                                                placeholder="Enter Stock on Order">
                                        </div>
                                        <div class="col">
                                            <label for="#">Avg sales/month </label>
                                            <input wire:model="inputs.{{ $key }}.avg_sale" type="number"
                                                step=".01"
                                                class="form-control <x-form.error-class name='inputs.{{ $key }}.avg_sale' />"
                                                placeholder="Enter Average Sales per Month">
                                        </div>
                                        <div class="col-md-1">
                                            <label for="#">Over Stock</label>
                                            <select wire:model="inputs.{{ $key }}.over_stock"
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
            });
        })
    </script>

</div>
