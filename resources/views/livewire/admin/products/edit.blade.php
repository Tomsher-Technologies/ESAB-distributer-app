<div>
    <div class="pagetitle">
        <h1> Edit Products </h1>
    </div><!-- End Page Title -->
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <!-- General Form Elements -->
                        <form wire:submit.prevent="save">
                            <div class="row g-3">
                                <div class="col-sm-6">
                                    <label for="#">GIN</label>
                                    <input type="text" wire:model="product.GIN" class="form-control"
                                        placeholder="Enter GIN">
                                    <x-form.l-w-error name="product.GIN" />
                                </div>
                                {{-- <div class="col-sm-4">
                                    <label for="#">Lot</label>
                                    <input type="text" wire:model="product.lot_no" class="form-control"
                                        placeholder="Enter Lot">
                                    <x-form.l-w-error name="product.lot_no" />
                                </div> --}}
                                <div class="col-sm-6">
                                    <label for="#">Description</label>
                                    <input type="text" wire:model="product.description" class="form-control"
                                        placeholder="Enter Description">
                                    <x-form.l-w-error name="product.description" />
                                </div>
                                <div class="col-sm-6">
                                    <label for="#">UOM</label>
                                    <input type="text" wire:model="product.UOM" class="form-control"
                                        placeholder="Enter UOM">
                                    <x-form.l-w-error name="product.UOM" />
                                </div>
                                <div class="col-sm-6">
                                    <label for="#">Category</label>
                                    <div wire:ignore>
                                        <select wire:model="product.category"
                                            class="form-select form-control selectpicker" id="floatingSelect">
                                            <option value="0" disabled selected="">Select</option>
                                            <option value="FM">FM</option>
                                            <option value="Non-FM">Non-FM</option>
                                        </select>
                                    </div>
                                    <x-form.l-w-error name="product.category" />
                                </div>
                                {{-- <div class="col-sm-4">
                                    <label for="#">Country</label>
                                    <div wire:ignore>
                                        <select wire:model="product.country_code" class="form-select form-control selectpicker" data-live-search="true">
                                            <option value="0" disabled>Select</option>
                                            @foreach ($countries as $country)
                                                <option value="{{ $country->code }}">{{ $country->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <x-form.l-w-error name="category" />
                                </div> --}}
                                <div class="col-sm-4 align-self-end">
                                    <button class="btn btn-secondary w-100" type="submit"> Update
                                        <i class="bi bi-file-earmark-arrow-up"></i>
                                    </button>
                                </div>
                            </div>
                        </form><!-- End General Form Elements -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        window.addEventListener('updated', event => {
            Swal.fire({
                title: 'Product updated successfully!',
                icon: 'success'
            });
        })
    </script>
</div>
