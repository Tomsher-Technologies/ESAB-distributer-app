<div>
    <div class="pagetitle">
        <h1> Admin User </h1>
    </div><!-- End Page Title -->
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="d-flex justify-content-between mb-3">
                    <form action="#" class="w-50">
                        <div class="row g-2">
                            <div class="col-md-10">
                                <input type="search" wire:model="search" class="form-control"
                                    placeholder="Search : Company Name, Country, Address, Contact Number">
                            </div>
                            {{-- <div class="col-2 w-auto">
                                <a class="btn btn-secondary py-2" href="update_distributor.html"> Search </a>
                            </div> --}}
                        </div>
                    </form>
                    <a class="btn btn-secondary ms-3 py-2" href="{{ route('admin.users.create') }}"> ADD
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
                                    <th class="table_bg" scope="col">User Name</th>
                                    <th class="table_bg" scope="col">Email ID</th>
                                    <th class="table_bg" scope="col">Role Name</th>
                                    <th class="table_bg" scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->roles->first()->title }}</td>
                                        <td>
                                            <span>
                                                <a href="{{ route('admin.users.edit', $user->id) }}"
                                                    class="btn btn-view">
                                                    <i class="bi bi-pencil-square"></i>
                                                </a>
                                            </span>
                                            <span>
                                                <a href="#" data-id="{{ $user->id }}" data-bs-toggle="modal"
                                                    data-bs-target="#exampleModal" class="btn btn-delete">
                                                    <i class="bi bi-trash3-fill"></i>
                                                </a>
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $users->links() }}
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
                    <p>User will be deleted!</p>
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
                title: 'User deleted successfully!',
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
