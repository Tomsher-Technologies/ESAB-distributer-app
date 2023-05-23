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
                                    <input type="text" wire:model="role.title" class="form-control"
                                        placeholder="Enter Name">
                                    <x-form.l-w-error name="role.title" />
                                </div>
                                <div class="col-sm-4">
                                    <label for="#">Permissions</label>
                                    <div wire:ignore>
                                        <select wire:model="selectpermission" data-model="selectpermission"
                                            name="permission" class="select2Picker2 form-select form-control"
                                            data-live-search="true" multiple>
                                            @foreach ($permissions as $permission)
                                                <option {{ in_array($permission->name, $selectpermission) ? 'selected' : '' }}
                                                    value="{{ $permission->name }}">{{ $permission->title }}
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
        window.addEventListener('updated', event => {
            Swal.fire({
                title: 'User updated successfully!',
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
                if (data.id == '*') {
                    $(this).val('*').change();
                } else {
                    var wanted_option = $(this).find('option[value="*"]');
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
                    $(this).val('*').change();
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
