@extends('layouts.master')
@section('title','Change Password')
@section('content')
    <div>
        <!--begin::Toolbar-->
        <div class="mb-5">
            <div class="app-toolbar-wrapper d-flex flex-stack flex-wrap gap-4 w-100">
                <!--begin::Page title-->
                <div class="page-title d-flex flex-column gap-1 me-3 mb-2">
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold mb-6">
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-gray-700 fw-bold lh-1">
                            <a href="{{ route('admin.dashboard') }}" class="text-gray-500">
                                <x-lucide-house class="fs-3 text-gray-400 me-n1 tw-h-5 tw-w-5"/>
                            </a>
                        </li>
                        <!--end::Item-->
                        <li class="breadcrumb-item">
                            <x-lucide-chevron-right class="text-gray-400 mx-n1 tw-h-5 tw-w-5"/>
                        </li>
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-gray-400 fw-bold lh-1">
                            <a href="" class="text-gray-700">
                                My Profile
                            </a>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <x-lucide-chevron-right class="text-gray-400 mx-n1 tw-h-5 tw-w-5"/>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-gray-700">
                            Change Password
                        </li>
                        <!--end::Item-->
                    </ul>
                    <!--end::Breadcrumb-->
                    <!--begin::Title-->
                    <h1 class="page-heading d-flex flex-column justify-content-center text-dark fw-bolder fs-1 lh-0">
                        Change Password
                    </h1>
                    <!--end::Title-->
                </div>
                <!--end::Page title-->
                <!--begin::Actions-->
                <div>

                </div>
                <!--end::Actions-->
            </div>
        </div>
        <!--end::Toolbar-->
        <!--begin::Content-->
        <div class="my-3">

            <div class="row">
                <div class="col-md-8 col-lg-6">

                    <div class="mb-4">
                        <form method="POST" action="{{ route('admin.system.profile.change-password.post') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="current_password" class="form-label">Current Password</label>
                                <input type="password"
                                       class="form-control @error('current_password') is-invalid @enderror"
                                       id="current_password" name="current_password" >
                                @error('current_password')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="new_password" class="form-label">New Password</label>
                                <input type="password" class="form-control @error('new_password') is-invalid @enderror"
                                       id="new_password" name="new_password" >
                                @error('new_password')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="confirm_password" class="form-label">Confirm New Password</label>
                                <input type="password"
                                       class="form-control @error('confirm_password') is-invalid @enderror"
                                       id="confirm_password" name="confirm_password" >
                                @error('confirm_password')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">Change Password</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

