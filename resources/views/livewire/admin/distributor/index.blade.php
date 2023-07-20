<div>
    <div class="pagetitle">
        <h1> Distributor </h1>
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
                    @if (auth()->user()->can('create-distributor'))
                        <a class="btn btn-secondary ms-3 py-2" href="{{ route('admin.distributor.create') }}"> ADD
                            <i class="bi bi-plus-lg"></i>
                        </a>
                    @endif
                </div>
                <div class="card">
                    <div class="card-body">
                        <!-- Bordered Table -->
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="table_bg" scope="col">Company Name</th>
                                    <th class="table_bg" scope="col">Country</th>
                                    <th class="table_bg" scope="col">Address</th>
                                    <th class="table_bg" scope="col">Contact Number</th>
                                    <th class="table_bg" scope="col">Email</th>
                                    <th class="table_bg" scope="col">Contact Person</th>
                                    <th class="table_bg" scope="col">Code</th>
                                    <th class="table_bg" scope="col">Sales Manager</th>
                                    <th class="table_bg" scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($distributors as $distributor)
                                    <tr>
                                        <td>{{ $distributor->distributor->company_name }}</td>
                                        <td>{{ $distributor->distributor->country->name }}</td>
                                        <td>{{ $distributor->distributor->address }}</td>
                                        <td>{{ $distributor->distributor->phone }}</td>
                                        <td>{{ $distributor->email }}</td>
                                        <td>{{ $distributor->name }}</td>
                                        <td>{{ $distributor->distributor->distributer_code }}</td>
                                        <td>{{ $distributor->distributor->manager->name }}</td>
                                        <td>

                                            @can('edit-distributor')
                                                <span>
                                                    <a href="{{ route('admin.distributor.edit', $distributor->id) }}"
                                                        class="btn btn-view">
                                                        <i class="bi bi-pencil-square"></i>
                                                    </a>
                                                </span>
                                            @endcan

                                            @can('delete-distributor')
                                                <span>
                                                    <a href="#"
                                                        onclick="confirm('Are you sure you want to remove the user from this group?') || event.stopImmediatePropagation()"
                                                        wire:click="deleteRecord({{ $distributor->id }})"
                                                        class="btn btn-delete">
                                                        <i class="bi bi-trash3-fill"></i>
                                                    </a>
                                                </span>
                                            @endcan


                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $distributors->links() }}
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
                    <p>Distributor will be deleted!</p>
                </div>
                <div class="modal-footer">
                    {{-- <form wire:submit.prevent="deleteRecord" id="deleteRecord"> --}}
                    {{-- <input type="hidden" value="0" name="deleteId" wire:model="deleteid" id="deleteId"> --}}
                    <button type="button" id="dtl_Btn" class="btn btn-secondary">
                        Delete
                    </button>
                    {{-- </form> --}}
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        window.addEventListener('deleted', event => {
            $('#exampleModal').modal('hide');
            // @this.set('deleteid', 0);
            Swal.fire({
                title: 'Distributor deleted successfully!',
                icon: 'success'
            });
        })

        window.addEventListener('deletedFailed', event => {
            $('#exampleModal').modal('hide');
            // @this.set('deleteid', 0);
            Swal.fire({
                title: 'Delete failed',
                icon: 'danger'
            });
        })
    </script>

    <script>
        $('#dtl_Btn').on('click', function() {
            console.log($(this).data('id'));
        });

        $('#exampleModal').on('shown.bs.modal', function(event) {
            var reference_tag = $(event.relatedTarget);
            var id = reference_tag.data('id');
            // @this.set('deleteid', id);
            $('#dtl_Btn').data('id')
        })
    </script>

</div>
