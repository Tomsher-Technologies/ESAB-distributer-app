<div>
    <div class="pagetitle">
        <h1> Add Products </h1>
    </div><!-- End Page Title -->
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <!-- General Form Elements -->
                        <form wire:submit.prevent="save">
                            <div class="row g-3">
                                <div class="col-sm-4">
                                    <label for="#">GIN</label>
                                    <input type="text" wire:model="gin" class="form-control" placeholder="Enter GIN">
                                    <x-form.l-w-error name="gin" />
                                </div>
                                <div class="col-sm-4">
                                    <label for="#">Lot</label>
                                    <input type="text" wire:model="lot_no" class="form-control"
                                        placeholder="Enter Lot">
                                    <x-form.l-w-error name="lot_no" />
                                </div>
                                <div class="col-sm-4">
                                    <label for="#">Description</label>
                                    <input type="text" wire:model="description" class="form-control"
                                        placeholder="Enter Description">
                                    <x-form.l-w-error name="description" />
                                </div>
                                <div class="col-sm-4">
                                    <label for="#">UOM</label>
                                    <input type="text" wire:model="uom" class="form-control" placeholder="Enter UOM">
                                    <x-form.l-w-error name="uom" />
                                </div>
                                <div class="col-sm-4">
                                    <label for="#">Category</label>
                                    <select wire:model="category" class="form-select form-control" id="floatingSelect">
                                        <option value="0" disabled selected="">Select</option>
                                        <option value="FM">FM</option>
                                        <option value="Non-FM">Non-FM</option>
                                    </select>
                                    <x-form.l-w-error name="category" />
                                </div>
                                <div class="col-sm-4 align-self-end">
                                    <button class="btn btn-secondary w-100" type="submit"> Add Now <i
                                            class="bi bi-plus-lg ps-2"></i></button>
                                </div>
                            </div>
                        </form><!-- End General Form Elements -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        window.addEventListener('created', event => {
            Swal.fire({
                title: 'Product created successfully!',
                icon: 'success'
            });
        })
    </script>
</div>
