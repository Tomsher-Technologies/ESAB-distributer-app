<div>
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
                        <div class="card-body">
                            <!-- General Form Elements -->
                            @foreach ($inputs as $key => $input)
                                @php
                                    $cur = $lot_a = null;
                                    $cur = $gins->find($inputs[$key]['gin']);
                                @endphp

                                <div data-repeater-list="group-a">
                                    <div data-repeater-item=""
                                        class="row mb-2 g-2 justify-content-center align-items-center">
                                        <div class="col">
                                            <label for="#">GIN Number</label>
                                            <select wire:change="change" wire:model="inputs.{{ $key }}.gin"
                                                name="gin" class="form-select form-control">
                                                <option selected disabled value="0">Select</option>
                                                @foreach ($gins as $gin)
                                                    <option value="{{ $gin->id }}">{{ $gin->GIN }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-1">
                                            <label for="#">Lot</label>
                                            <input wire:model.defer="inputs.{{ $key }}.lot" name="lot"
                                                type="text" class="form-control" placeholder="Category "
                                                value="24">
                                        </div>
                                        <div class="col">
                                            <label for="#">Description</label>
                                            <input type="text" class="form-control"
                                                placeholder="Enter Distributor Code"
                                                value="{{ $cur !== null ? $cur->description : '' }}" disabled>
                                        </div>
                                        <div class="col-md-1">
                                            <label for="#">UOM</label>
                                            <input type="text" class="form-control" placeholder="Enter UOM"
                                                value="{{ $cur !== null ? $cur->UOM : '' }}" disabled="">
                                        </div>
                                        <div class="col-md-1">
                                            <label for="#">Category </label>
                                            <input type="text" class="form-control" placeholder="Category "
                                                value="{{ $cur !== null ? $cur->category : '' }}" disabled="">
                                        </div>
                                        <div class="col-md-1">
                                            <label for="#">Stock on Hand</label>
                                            <input wire:model="inputs.{{ $key }}.stock_hand" type="number"
                                                class="form-control" placeholder="Enter Stock on Hand">
                                        </div>
                                        <div class="col-md-1">
                                            <label for="#">Goods in Transit</label>
                                            <input wire:model="inputs.{{ $key }}.stock_transit" type="number"
                                                class="form-control" placeholder="Enter Goods in Transit">
                                        </div>
                                        <div class="col-md-1">
                                            <label for="#">Stock on Order</label>
                                            <input wire:model="inputs.{{ $key }}.stock_order" type="number"
                                                class="form-control" placeholder="Enter Stock on Order">
                                        </div>
                                        <div class="col">
                                            <label for="#">Avg sales/month </label>
                                            <input wire:model="inputs.{{ $key }}.avg_sale" type="number"
                                                step=".01" class="form-control"
                                                placeholder="Enter Average Sales per Month">
                                        </div>
                                        <div class="col-md-1">
                                            <label for="#">Over Stock</label>
                                            <select wire:model="inputs.{{ $key }}.over_stock"
                                                class="form-select form-control" id="">
                                                <option>Select</option>
                                                <option>Yes</option>
                                                <option>No</option>
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
</div>
