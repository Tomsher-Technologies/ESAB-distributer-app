@extends('admin.layouts.app', ['body_class' => ''])

@section('content')
    <div class="pagetitle">
        <h1>Settings</h1>
    </div><!-- End Page Title -->
    <section class="section profile">
        <div class="row">
            <div class="col-xl-12">
                <div class="card mb-0">
                    <div class="card-body pt-3">
                        <!-- Bordered Tabs -->
                        <x-form.success />
                        <form method="POST" action="{{ route('profile.update') }}">
                            @csrf
                            <div class="row mb-3">
                                <div class="col-lg-12">
                                    <label for="#" class="col-form-label">Admin Emails</label>
                                    <input type="text" value="" name="admin_email" class="form-control">
                                    <x-form.error name="admin_email" />
                                </div>
                                <div class="col-lg-12">
                                    <label for="#" class="col-form-label">Email</label>
                                    <input type="number" value="" name="stock_notification_limit"
                                        class="form-control">
                                </div>
                                <div class="col-lg-12 align-self-end mt-4">
                                    <button style="color: #000;padding: 15px;line-height: 30px;" type="submit"
                                        class="btn btn-secondary">Save Changes</button>
                                </div>
                            </div>
                        </form><!-- End Profile Edit Form -->

                    </div><!-- End Bordered Tabs -->
                </div>
            </div>
        </div>
    </section>
@endsection
