<div>
    <div class="pagetitle">
        <h1> Admin Roles </h1>
    </div><!-- End Page Title -->
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="d-flex justify-content-end mb-3">
                    <a class="btn btn-secondary ms-3 py-2" href="{{ route('admin.roles.create') }}"> ADD
                        <i class="bi bi-plus-lg"></i>
                    </a>
                </div>
                <div class="card">
                    <div class="card-body">
                        <!-- Bordered Table -->
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="table_bg" scope="col">#</th>
                                    <th class="table_bg" scope="col">Role Name</th>
                                    <th class="table_bg" scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($roles as $role)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $role->title }}</td>
                                        <td>
                                            <span>
                                                <a href="{{ route('admin.roles.edit', $role->id) }}"
                                                    class="btn btn-view">
                                                    <i class="bi bi-pencil-square"></i>
                                                </a>
                                            </span>
                                            <span>
                                                <a href="#" data-id="{{ $role->id }}" data-bs-toggle="modal"
                                                    data-bs-target="#exampleModal" class="btn btn-delete">
                                                    <i class="bi bi-trash3-fill"></i>
                                                </a>
                                            </span>
                                        </td>
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

    <div wire:ignore class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <span class="bi bi-x-circle close_icon"></span>
                    <h4>Are You Sure?</h4>
                    <p>Role will be deleted!</p>
                </div>
                <div class="modal-footer">
                    <form wire:submit.prevent="deleteRecord" id="deleteRecord">
                        <button type="submit" class="btn btn-secondary">
                            Delete
                        </button>
                    </form>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        window.addEventListener('deleted', event => {
            $('#exampleModal').modal('hide');
            Swal.fire({
                title: 'Role deleted successfully!',
                icon: 'success'
            });
        })
    </script>

    <script>
        $('#exampleModal').on('shown.bs.modal', function(event) {
            var reference_tag = $(event.relatedTarget);
            var id = reference_tag.data('id');
            @this.set('deleteid', id);
        })
    </script>
</div>
