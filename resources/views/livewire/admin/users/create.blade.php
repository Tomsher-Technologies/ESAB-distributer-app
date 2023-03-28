<div>
    <div class="pagetitle">
        <h1> Add Admin Users </h1>
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
                                    <label for="#">Name</label>
                                    <input type="text" wire:model="name" class="form-control"
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
                                    <label for="#">Password</label>
                                    <input type="password" wire:model.debounce.500ms="password" class="form-control"
                                        placeholder="Enter Password">
                                    <x-form.l-w-error name="password" />
                                </div>
                                <div class="col-sm-4">
                                    <label for="#">Confirm Password </label>
                                    <input type="password" wire:model.debounce.500ms="password_confirmation" class="form-control"
                                        placeholder="Enter Confirm Password ">
                                    <x-form.l-w-error name="password_confirmation" />
                                </div>

                                <div class="col-sm-4">
                                    <label for="#">Role</label>
                                    <select wire:model="role" name="role" class="form-select form-control">
                                        @foreach ($roles as $_role)
                                            <option value="{{ $_role->name }}">{{ $_role->title }}</option>
                                        @endforeach
                                    </select>
                                    <x-form.l-w-error name="role" />
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

                                <div class="col-sm-4 align-self-end">
                                    <button type="submit" class="btn btn-secondary py-2">Save <i
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
                title: 'User created successfully!',
                icon: 'success'
            });
        })
    </script>
</div>
