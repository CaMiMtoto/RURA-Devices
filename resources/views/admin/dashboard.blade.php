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
                        <div class="d-flex justify-content-end gap-3">
                            <input type="date" class="form-control form-control-solid rounded-1" value="{{ now()->startOfWeek()->format('Y-m-d') }}"/>
                            <input type="date" class="form-control form-control-solid rounded-1" value="{{ now()->format('Y-m-d') }}"/>
                        </div>
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
                                    <x-lucide-kanban class="fs-3 text-warning tw-h-12 tw-w-12"/>
                                </span>
                                    <!--begin::Stats-->
                                    <div class="m-0">
                                        <!--begin::Number-->
                                        <span class="text-warning-emphasis d-block  lh-1 ls-n1 mb-1 display-5 my-4">
                                        {{ random_int(0,100) }}
                                    </span>
                                        <!--end::Number-->

                                        <!--begin::Desc-->
                                        <span class="text-warning-emphasis fw-semibold fs-6">Pending Review</span>
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
                                    class="bg-primary-subtle  border border-primary-subtle  bg-opacity-70 rounded-2 px-6 py-5">
                                    <!--begin::Symbol-->
                                    <span class="text-success">
                                    <x-lucide-square-check-big class="fs-3 text-primary tw-h-12 tw-w-12"/>
                                </span>

                                    <!--end::Symbol-->

                                    <!--begin::Stats-->
                                    <div class="m-0">
                                        <!--begin::Number-->
                                        <span class="text-primary-emphasis d-block  lh-1 ls-n1 mb-1 display-5 my-4">
                                        {{ random_int(0,100) }}
                                    </span>
                                        <!--end::Number-->

                                        <!--begin::Desc-->
                                        <span class="text-primary-emphasis fw-semibold fs-6">Submitted Reports</span>
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
                                    <x-lucide-check-check class="fs-3 text-success tw-h-12 tw-w-12"/>
                                </span>

                                    <!--end::Symbol-->

                                    <!--begin::Stats-->
                                    <div class="m-0">
                                        <!--begin::Number-->
                                        <span class="text-success-emphasis d-block  lh-1 ls-n1 mb-1 display-5 my-4">
                                       {{ random_int(0,100) }}
                                    </span>
                                        <!--end::Number-->

                                        <!--begin::Desc-->
                                        <span class="text-success-emphasis fw-semibold fs-6">Submitted to DG</span>
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
                                    class="bg-danger-subtle  border border-danger-subtle  bg-opacity-70 rounded-2 px-6 py-5">
                                    <!--begin::Symbol-->
                                    <span class="text-danger">
                                    <x-lucide-users class="fs-3 text-danger tw-h-12 tw-w-12"/>
                                </span>

                                    <!--end::Symbol-->

                                    <!--begin::Stats-->
                                    <div class="m-0">
                                        <!--begin::Number-->
                                        <span class="text-danger-emphasis d-block  lh-1 ls-n1 mb-1 display-5 my-4">
                                        {{ \App\Models\User::query()->count() }}
                                    </span>
                                        <!--end::Number-->

                                        <!--begin::Desc-->
                                        <span class="text-danger-emphasis fw-semibold fs-6">
                                            System Users
                                        </span>
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


            <!-- Table -->
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                        Recent Activity
                    </h4>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>User</th>
                            <th>Activity</th>
                            <th>Date</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>Jean Paul</td>
                            <td>Logged in</td>
                            <td>June 25, 2025</td>
                        </tr>
                        <tr>
                            <td>Eric</td>
                            <td>Uploaded report</td>
                            <td>June 24, 2025</td>
                        </tr>
                        <tr>
                            <td>Alice</td>
                            <td>Changed settings</td>
                            <td>June 23, 2025</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>


        </div>

        <!--end::Content-->
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            fetchRoomUtilizationData();

            function fetchRoomUtilizationData() {

                $.ajax({
                    url: '',
                    type: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        let roomNames = [];
                        let hoursBooked = [];

                        data.forEach(room => {
                            roomNames.push(room.room_number); // Customize room label
                            hoursBooked.push(room.total_hours_booked);
                        });
                        renderRoomUtilizationChart(roomNames, hoursBooked);
                    }
                });
            }

            function renderRoomUtilizationChart(roomNames, hoursBooked) {
                const options = {
                    chart: {
                        type: 'bar'
                    },
                    theme: {
                        mode: localStorage.getItem('data-bs-theme-mode'), // Detect theme
                    },
                    series: [{
                        name: 'Total Hours Booked',
                        data: hoursBooked
                    }],
                    colors: ['#023B6D'],
                    plotOptions: {
                        bar: {
                            borderRadius: 4,
                            borderRadiusApplication: 'end',
                            horizontal: true,
                            width: '20%',
                        }
                    },
                    dataLabels: {
                        enabled: false
                    },
                    xaxis: {
                        categories: roomNames
                    },
                    title: {
                        text: 'Room Utilization (Total Hours Booked)',
                        align: 'left'
                    }
                };

                const chart = new ApexCharts(document.querySelector("#roomUtilizationChart"), options);
                chart.render();
            }

            fetchPeakUsageTimesData();

            function fetchPeakUsageTimesData() {
                $.ajax({
                    url: '',
                    type: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        let hoursOfDay = [];
                        let bookingCounts = [];

                        data.forEach(booking => {
                            hoursOfDay.push(booking.hour_of_day + ':00'); // Format hour for display
                            bookingCounts.push(booking.booking_count);
                        });

                        renderPeakUsageTimesChart(hoursOfDay, bookingCounts);
                    },
                    error: function (xhr, status, error) {
                        console.log(error);
                    }
                })
            }

            function renderPeakUsageTimesChart(hoursOfDay, bookingCounts) {
                const options = {
                    chart: {
                        type: 'area',
                        stacked: false,
                        zoom: {
                            type: 'x',
                            enabled: true,
                            autoScaleYaxis: true
                        },
                        toolbar: {
                            autoSelected: 'zoom'
                        }
                    },
                    markers: {
                        size: 0,
                        style: 'hollow',
                    },
                    dataLabels: {
                        enabled: false
                    },
                    stroke: {
                        width: 5,
                        curve: 'smooth'
                    },
                    series: [{
                        name: 'Bookings',
                        data: bookingCounts
                    }],
                    xaxis: {
                        categories: hoursOfDay,
                        type: 'time',
                    },
                    title: {
                        text: 'Peak Room Usage Times (By Hour of Day)',
                        align: 'left'
                    },
                    fill: {
                        type: 'gradient',
                        gradient: {
                            shadeIntensity: 1,
                            inverseColors: false,
                            opacityFrom: 0.5,
                            opacityTo: 0,
                            stops: [0, 90, 100]
                        },
                    },
                };

                const chart = new ApexCharts(document.querySelector("#peakUsageChart"), options);
                chart.render();
            }

        });
    </script>
@endpush
