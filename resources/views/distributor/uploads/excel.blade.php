@extends('distributor.layouts.app', ['body_class' => ''])

@section('content')
    <div class="pagetitle">
        <h1>Upload <small>(Excel)</small></h1>
    </div>
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mb-0">Example Excel Format</h5>
                        <p>Download the excel template. Fill the data and re-upload the template</p>
                        <a href="{{ asset('assets/sample/ESAB_product_import_template.xlsx') }}" class="btn excel_temp">
                            <span>
                                <img src="{{ adminAsset('img/excel.png') }}" width="30" alt="">
                            </span>
                            Download Excel Template
                        </a>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mb-0">Upload New File</h5>
                        <!-- General Form Elements -->
                        <form method="POST" action="{{ route('distributor.uploads.excel') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <x-form.error name="error" />
                            <x-form.success />

                            @if (session('completed'))
                                <div class="alert alert-success">
                                    <p class="mb-0">
                                        Rows successfully imported: {{ implode(',', session('completed')) }}
                                    </p>
                                </div>
                            @endif

                            @if (session('error_msg'))
                                <div class="alert alert-danger">
                                    {{ session('error_msg') }}
                                    <br>
                                    <ul>
                                        @foreach (session('err_array') as $key => $err_item)
                                            @foreach ($err_item as $item)
                                                <li>{{ $item }} </li>
                                            @endforeach
                                        @endforeach
                                    </ul>

                                </div>
                            @endif

                            <div class="row mb-3 g-3">
                                <div class="col-sm-8">
                                    <label for="inputNumber" class="col-form-label">Choose File</label>
                                    <input name="product_file" class="form-control" type="file" id="formFile"
                                        accept=".csv,.xlsx,.xls" required>

                                </div>
                                <div class="col-sm-4 align-self-end">
                                    <button class="btn btn-secondary px-4">
                                        Upload <i class="bi bi-cloud-upload"></i>
                                    </button>
                                </div>
                            </div>
                            <x-form.error name="product_file" />
                        </form><!-- End General Form Elements -->
                    </div>
                </div>

            </div>

        </div>
    </section>
@endsection
