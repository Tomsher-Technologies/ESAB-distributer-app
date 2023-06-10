@extends('admin.layouts.app', ['body_class' => ''])

@section('content')
    <div class="pagetitle">
        <h1> Upload <small>(Excel)</small></h1>
    </div><!-- End Page Title -->
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mb-0">Example Excel Format</h5>
                        <p>Download the excel template. Fill the data and re-upload the template</p>
                        <a href="{{ adminAsset('samples/admin_template.xlsx') }}" download="" class="btn excel_temp">
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
                        <form method="POST" action="{{ route('admin.products.import') }}" enctype="multipart/form-data">
                            @csrf
                            <x-form.error name="error" />
                            <x-form.success />

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
                                    <label for="inputNumber" class="col-form-label mb-0">Choose File</label>
                                    <input class="form-control" type="file" name="product_file" accept=".csv,.xlsx,.xls"
                                        id="formFile">
                                    <x-form.error name="product_file" />
                                </div>
                                <div class="col-sm-4 align-self-end">
                                    <button class="btn btn-secondary px-4" type="submit">Upload <i
                                            class="bi bi-cloud-upload"></i></button>
                                </div>
                            </div>
                        </form><!-- End General Form Elements -->
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
