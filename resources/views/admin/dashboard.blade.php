@extends('layouts.master')
@section('title', 'Dashboard')
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
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-gray-700 fw-bold lh-1">Dashboard</li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <x-lucide-chevron-right class="text-gray-400 mx-n1 tw-h-5 tw-w-5"/>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-gray-700">
                            Analytics
                        </li>
                        <!--end::Item-->
                    </ul>
                    <!--end::Breadcrumb-->
                    <!--begin::Title-->
                    <h1 class="page-heading d-flex flex-column justify-content-center text-dark fw-bolder fs-1 lh-0">
                        Dashboard
                    </h1>
                    <!--end::Title-->
                </div>
                <!--end::Page title-->
                <!--begin::Actions-->

                <!--end::Actions-->
            </div>
        </div>
        <!--end::Toolbar-->
        <!--begin::Content-->
        <div class="my-3">

            <div class="card card-flush mb-3 h-xl-100  ">
                <!--begin::Heading-->
                <div
                    class="card-header rounded rounded-bottom-0 bgi-no-repeat bgi-size-cover bgi-position-y-top bgi-position-x-end align-items-start h-md-200px   bg-primary"
                    style="background-image: url({{ asset('assets/media/shapes/abstract-8.svg') }})"
                    data-bs-theme="light">
                    <!--begin::Title-->
                    <div class="h4 card-title align-items-start flex-column text-white pt-4">
                        <span class="fw-bold fs-2x mb-3">Overview</span>
                        <div class="fs-4 text-white">
                            Below are the statistics reported by the system.
                        </div>
                    </div>
                    <!--end::Title-->

                    <!--begin::Toolbar-->
                    <div class="card-toolbar pt-5">

                    </div>
                    <!--end::Toolbar-->
                </div>
                <!--end::Heading-->

                <!--begin::Body-->
                <div class="card-body mt-15 mt-md-n15 mt-lg-15 mt-xl-n20 ">
                    <!--begin::Stats-->
                    <div class="mt-n20 position-relative">
                        <!--begin::Row-->
                        <div class="row g-3 g-lg-6">
                            <!--begin::Col-->
                            <div class="col-12 col-md-6 col-xl-3">
                                <!--begin::Items-->
                                <div
                                    class="bg-warning-subtle  border border-warning-subtle  bg-opacity-70 rounded-2 px-6 py-5">
                                    <!--begin::Symbol-->
                                    <span class="text-warning">
                                    <x-lucide-clock-12 class="fs-3 text-warning tw-h-12 tw-w-12"/>
                                </span>
                                    <!--begin::Stats-->
                                    <div class="m-0">
                                        <!--begin::Number-->
                                        <span class="text-warning-emphasis d-block  lh-1 ls-n1 mb-1 display-5 my-4">
                                        {{ number_format($totalPendingConfirmations) }}
                                    </span>
                                        <!--end::Number-->

                                        <!--begin::Desc-->
                                        <span class="text-warning-emphasis fw-semibold fs-6">Pending Assets</span>
                                        <!--end::Desc-->
                                    </div>
                                    <!--end::Stats-->
                                </div>
                                <!--end::Items-->
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-12 col-md-6 col-xl-3">
                                <!--begin::Items-->
                                <div
                                    class="bg-success-subtle  border border-success-subtle  bg-opacity-70 rounded-2 px-6 py-5">
                                    <!--begin::Symbol-->
                                    <span class="text-success">
                                    <x-lucide-check-circle class="fs-3 text-success tw-h-12 tw-w-12"/>
                                </span>
                                    <!--begin::Stats-->
                                    <div class="m-0">
                                        <!--begin::Number-->
                                        <span class="text-success-emphasis d-block  lh-1 ls-n1 mb-1 display-5 my-4">
                                        {{ number_format($totalConfirmedAssets) }}
                                    </span>
                                        <!--end::Number-->

                                        <!--begin::Desc-->
                                        <span class="text-success-emphasis fw-semibold fs-6">Confirmed Assets</span>
                                        <!--end::Desc-->
                                    </div>
                                    <!--end::Stats-->
                                </div>
                                <!--end::Items-->
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-12 col-md-6 col-xl-3">
                                <!--begin::Items-->
                                <div
                                    class="bg-success-subtle  border border-success-subtle  bg-opacity-70 rounded-2 px-6 py-5">
                                    <!--begin::Symbol-->
                                    <span class="text-success">
                                    <x-lucide-circle-arrow-out-down-left class="fs-3 text-success tw-h-12 tw-w-12"/>
                                </span>
                                    <!--begin::Stats-->
                                    <div class="m-0">
                                        <!--begin::Number-->
                                        <span class="text-success-emphasis d-block  lh-1 ls-n1 mb-1 display-5 my-4">
                                        {{ number_format($totalReceivedAssets) }}
                                    </span>
                                        <!--end::Number-->

                                        <!--begin::Desc-->
                                        <span class="text-success-emphasis fw-semibold fs-6">Received Assets</span>
                                        <!--end::Desc-->
                                    </div>
                                    <!--end::Stats-->
                                </div>
                                <!--end::Items-->
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-12 col-md-6 col-xl-3">
                                <!--begin::Items-->
                                <div
                                    class="bg-warning-subtle  border border-warning-subtle  bg-opacity-70 rounded-2 px-6 py-5">
                                    <!--begin::Symbol-->
                                    <span class="text-warning">
                                    <x-lucide-circle-arrow-out-up-right class="fs-3 text-warning tw-h-12 tw-w-12"/>
                                </span>
                                    <!--begin::Stats-->
                                    <div class="m-0">
                                        <!--begin::Number-->
                                        <span class="text-warning-emphasis d-block  lh-1 ls-n1 mb-1 display-5 my-4">
                                        {{ number_format($totalNotReceivedAssets) }}
                                    </span>
                                        <!--end::Number-->

                                        <!--begin::Desc-->
                                        <span class="text-warning-emphasis fw-semibold fs-6">Not Received Assets</span>
                                        <!--end::Desc-->
                                    </div>
                                    <!--end::Stats-->
                                </div>
                                <!--end::Items-->
                            </div>
                            <!--end::Col-->


                        </div>
                        <!--end::Row-->
                    </div>
                    <!--end::Stats-->
                </div>
                <!--end::Body-->
            </div>
            @can(\App\Constants\Permission::VIEW_ASSETS_REPORT)
                <div class="row">
                    <div class="col-lg-6 my-3">
                        <div class="card card-body h-100">
                            <h4>
                                Confirmed vs Not Confirmed Assets
                            </h4>
                            <p class="text-muted tw-text-sm">
                                Below is the distribution of all users assets that have been confirmed versus those that
                                are
                                still
                                pending confirmation.
                            </p>
                            <div id="confirmed_pending"></div>
                        </div>
                    </div>
                    <div class="col-lg-6 my-3">
                        <div class="card card-body h-100">
                            <h4>
                                Received vs Not Received Assets
                            </h4>
                            <p class="text-muted tw-text-sm">
                                Below is the distribution of all users assets that have been marked as received versus
                                those
                                that are
                                still pending receipt.
                            </p>
                            <div id="received_not_assets"></div>
                        </div>
                    </div>
                </div>
            @endcan

        </div>

        <!--end::Content-->
    </div>
@endsection

@push('scripts')
    <script>
        function renderChart(elementId, series, labels, colors, type = 'pie', width = 380) {
            const options = {
                series: series,
                chart: {
                    width: width,
                    type: type,
                },
                labels: labels,
                colors: colors,
                legend: {
                    position: 'bottom'   // ✅ Always show legend at bottom
                },
                responsive: [{
                    breakpoint: 640,
                    options: {
                        chart: {
                            width: '80%'
                        },
                        legend: {
                            position: 'right'   // ✅ Always show legend at bottom
                        }
                    }
                }]
            };

            const element = document.querySelector(elementId);
            if (element) {
                const chart = new ApexCharts(element, options);
                chart.render();
            }
        }


        document.addEventListener('DOMContentLoaded', function () {
            // Confirmed vs Pending
            renderChart(
                "#confirmed_pending",
                [{{ $allConfirmedAssets }}, {{ $allPendingAssets }}],
                ["Confirmed", "Pending"],
                ["#2ECC71", "#F39C12"],
                "pie",
                250
            );

// Received vs Not Received
            renderChart(
                "#received_not_assets",
                [{{ $allReceivedAssets }}, {{ $allNotReceivedAssets }}],
                ["Received", "Not Received"],
                ["#2ECC71", "#f32512"],
                "donut",
                250
            );

        });
    </script>
@endpush
