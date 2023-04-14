<div>
    <div class="pagetitle">
        <h1>Add Admin Roles</h1>
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
                                    <label for="#">Permissions</label>
                                    <div wire:ignore>
                                        <select wire:model="selectpermission" name="permission"
                                            class="selectpicker form-select form-control" data-live-search="true"
                                            multiple>
                                            @foreach ($permissions as $permission)
                                                <option value="{{ $permission->name }}">{{ $permission->title }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <x-form.l-w-error name="selectpermission" />
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
@push('header')
    <link rel='stylesheet'
        href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/css/bootstrap-select.min.css'>
@endpush
@push('footer')
    <script src='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/js/bootstrap-select.min.js'></script>

    <script>
        $('.selectpicker').on('change', function(e) {
            @this.set('selectpermission', $('.selectpicker').val())
        });
    </script>
@endpush
