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
                        <a href="{{ asset('assets/sample/distributor_template.xlsx') }}" class="btn excel_temp">
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
                            <div class="row mb-3 g-3">
                                <div class="col-sm-8">
                                    <label for="inputNumber" class="col-form-label">Choose File</label>
                                    <input name="product_file" class="form-control" type="file" id="formFile"
                                        accept=".csv,.xlsx,.xls">
                                    
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
