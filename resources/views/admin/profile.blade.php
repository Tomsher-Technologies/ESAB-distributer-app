@extends('admin.layouts.app', ['body_class' => ''])

@section('content')
    <div class="pagetitle">
        <h1>Profile</h1>
    </div><!-- End Page Title -->
    <section class="section profile">
        <div class="row">
            <div class="col-xl-12">
                <div class="card mb-0">
                    <div class="card-body pt-3">
                        <!-- Bordered Tabs -->
                        <ul class="nav nav-tabs nav-tabs-bordered">
                            <li class="nav-item">
                                <button class="nav-link {{ old('isPassword') == 1 ? '' : 'active'  }}" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit
                                    Profile</button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link {{ old('isPassword') == 1 ? 'active' : ''  }}" data-bs-toggle="tab"
                                    data-bs-target="#profile-change-password">Change Password</button>
                            </li>
                        </ul>
                        <div class="tab-content pt-2">
                            <div class="tab-pane fade profile-edit {{ old('isPassword') == 1 ? '' : 'show active'  }} pt-3" id="profile-edit">
                                <!-- Profile Edit Form -->
                                <x-form.success />
                                <form method="POST" action="{{ route('admin.profile.update') }}">
                                    @csrf
                                    <div class="row mb-3">
                                        <div class="col-lg-4">
                                            <label for="#" class="col-form-label">Name</label>
                                            <input type="text" value="{{ auth()->user()->name }}" name="name"
                                                class="form-control">
                                            <x-form.error name="name" />
                                        </div>
                                        <div class="col-lg-4">
                                            <label for="#" class="col-form-label">Email</label>
                                            <input type="email" value="{{ auth()->user()->email }}" disabled
                                                class="form-control">
                                        </div>
                                        <div class="col-lg-4 align-self-end">
                                            <button style="color: #000;padding: 15px;line-height: 30px;" type="submit"
                                                class="btn btn-secondary">Save Changes</button>
                                        </div>
                                    </div>
                                </form><!-- End Profile Edit Form -->
                            </div>
                        </div>

                        <div class="tab-pane fade pt-3 {{ old('isPassword') == 1 ? 'show active' : ''  }}" id="profile-change-password">
                            <!-- Change Password Form -->
                            <x-form.success />
                            <x-form.error name="login" />
                            <form method="POST" action="{{ route('admin.profile.password') }}">
                                @csrf
                                <input type="hidden" name="isPassword" value="1">
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <label for="currentPassword" class="col-form-label">Current Password</label>
                                        <input name="currentPassword" type="password" class="form-control"
                                            id="currentPassword">
                                        <x-form.error name="currentPassword" />
                                    </div>
                                    <div class="col-md-4">
                                        <label for="newPassword" class="col-form-label">New Password</label>
                                        <input name="password" type="password" class="form-control" id="newPassword">
                                        <x-form.error name="password" />
                                    </div>
                                    <div class="col-md-4">
                                        <label for="renewPassword" class="col-form-label">Re-enter New Password</label>
                                        <input name="password_confirmation" type="password" class="form-control"
                                            id="renewPassword">
                                    </div>
                                    <div class="col-md-4 mt-3">
                                        <button style="color: #000;padding: 15px;line-height: 30px;" type="submit"
                                            class="btn btn-secondary">Save Changes</button>
                                    </div>
                                </div>
                            </form><!-- End Change Password Form -->
                        </div>
                    </div><!-- End Bordered Tabs -->
                </div>
            </div>
        </div>
    </section>
@endsection
