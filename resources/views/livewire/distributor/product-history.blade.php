<div>
    <div class="pagetitle">
        <h1>Upload History</h1>
    </div>
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="d-flex justify-content-end mb-3">
                    <div class="search_calendar w-50">
                        <div class="row">
                            <div class="col-sm-6">
                                <label for="#">From</label>
                                <input wire:model="form_start_date" type="date" class="form-control border-0">
                                <x-form.l-w-error name="form_start_date" />
                            </div>
                            <div class="col-sm-6">
                                <label for="#">To</label>
                                <input wire:model="form_end_date" min="{{ $form_start_date }}" type="date" class="form-control border-0">
                            </div>
                        </div>
                    </div>
                    <button wire:click="filter" type="button" class="btn btn-secondary ms-3 align-self-end px-4">
                        <i class="bi bi-funnel"></i>
                        Filter
                    </button>
                </div>
                <div class="card">
                    <div class="card-body">
                        <!-- Bordered Table -->
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="table_bg" scope="col">#</th>
                                    <th class="table_bg" scope="col">File Name</th>
                                    <th class="table_bg" scope="col">Date and Time</th>
                                    <th class="table_bg" scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($uploads as $upload)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $upload->name }}</td>
                                        <td>{{ $upload->created_at->format('d-m-Y - h:i A') }}</td>
                                        <td>
                                            <a href="{{ URL::to($upload->path) }}" download="{{ $upload->name }}"
                                                class="btn btn-view">
                                                <i class="bi bi-download"></i>
                                                Download
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $uploads->links() }}
                        <!-- End Bordered Table -->
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>