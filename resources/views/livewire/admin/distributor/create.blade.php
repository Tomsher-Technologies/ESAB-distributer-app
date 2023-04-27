<div>
    <div class="pagetitle">
        <h1> Add Distributor </h1>
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
                                    <label for="#">Company Name</label>
                                    <input type="text" wire:model="company_name" class="form-control"
                                        placeholder="Enter Company Name">
                                    <x-form.l-w-error name="company_name" />
                                </div>
                                <div class="col-sm-4">
                                    <label for="#">Name</label>
                                    <input type="text" class="form-control" wire:model="name"
                                        placeholder="Enter Name">
                                    <x-form.l-w-error name="name" />
                                </div>
                                <div class="col-sm-4">
                                    <label for="#">Email</label>
                                    <input type="email" class="form-control" wire:model="email"
                                        placeholder="Enter Email">
                                    <x-form.l-w-error name="email" />
                                </div>
                                <div class="col-sm-4">
                                    <label for="#">Phone</label>
                                    <input type="text" id="validateNumber" class="form-control" wire:model="phone"
                                        placeholder="Enter Phone">
                                    <x-form.l-w-error name="phone" />
                                </div>
                                <div class="col-sm-4">
                                    <label for="#">Address</label>
                                    <input type="text" class="form-control" wire:model="address"
                                        placeholder="Enter Address">
                                    <x-form.l-w-error name="address" />
                                </div>
                                <div class="col-sm-4">
                                    <label for="#">Country</label>
                                    <select name="country" wire:model="country" class="form-select form-control">
                                        @foreach ($countries as $country)
                                            <option value="{{ $country->code }}">{{ $country->name }}</option>
                                        @endforeach
                                    </select>
                                    <x-form.l-w-error name="country" />
                                </div>
                                <div class="col-sm-4">
                                    <label for="#">Password</label>
                                    <input type="password" wire:model.lazy="password" class="form-control"
                                        placeholder="Enter Password">
                                    <x-form.l-w-error name="password" />
                                </div>
                                <div class="col-sm-4">
                                    <label for="#">Confirm Password </label>
                                    <input type="password" wire:model.lazy="password_confirmation" class="form-control"
                                        placeholder="Enter Confirm Password ">
                                    <x-form.l-w-error name="password_confirmation" />
                                </div>
                                <div class="col-sm-4">
                                    <label for="#">Status</label>
                                    <select wire:model="status" class="form-select form-control" id="floatingSelect"
                                        aria-label="Floating label select example">
                                        <option value="1">Enabled</option>
                                        <option value="0">Disabled</option>
                                    </select>
                                    <x-form.l-w-error name="status" />
                                </div>
                                <div class="col-sm-4">
                                    <label for="#">Manager</label>
                                    <select wire:model="manager" name="manager" class="form-select form-control">
                                        @foreach ($managers as $manager)
                                            <option value="{{ $manager->id }}">{{ $manager->name }}</option>
                                        @endforeach
                                    </select>
                                    <x-form.l-w-error name="manager" />
                                    {{-- <input type="text" class="form-control" placeholder="Enter Manager Name"> --}}
                                </div>
                                <div class="col-sm-4 align-self-end">
                                    <button type="submit" class="btn btn-secondary py-3 w-100">Save <i
                                            class="bi bi-file-earmark-arrow-up"></i></button>
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
                title: 'Distributor created successfully!',
                icon: 'success'
            });
        })

        jQuery('#validateNumber').keypress(function(e) {
            var charCode = (e.which) ? e.which : event.keyCode
            console.log(charCode)
            if (String.fromCharCode(charCode).match(/[^0-9]/g))
                return false;
        });
    </script>
</div>
