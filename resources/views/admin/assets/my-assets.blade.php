@extends('layouts.master')
@section('title', 'My Assets')
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
                        <li class="breadcrumb-item text-gray-700 fw-bold lh-1">
                            Assets
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <x-lucide-chevron-right class="text-gray-400 mx-n1 tw-h-5 tw-w-5"/>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-gray-700">
                            Confirmation
                        </li>
                        <!--end::Item-->
                    </ul>
                    <!--end::Breadcrumb-->
                    <!--begin::Title-->
                    <h1 class="page-heading d-flex flex-column justify-content-center text-dark fw-bolder fs-1 lh-0">
                        Assets
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
            <div class="alert alert-info">
                Please view the assets assigned to you. You are required to confirm whether you have received the asset
                or not.
                If you have received the assets, please click on the "Received" button
                and if you have not received the assets, please click on the "Not Received" button after selecting the
                assets you want to confirm.
            </div>
            <div class="table-responsive">
                <div>
                    <button class="btn btn-success btn-sm" id="confirmation_btn" disabled>
                        <x-lucide-check-circle class="tw-h-5 tw-w-5 me-2"/>
                        Received
                    </button>
                    <button class="btn btn-danger btn-sm" id="not_received_btn" disabled>
                        <x-lucide-x-circle class="tw-h-5 tw-w-5 me-2"/>
                        Not Received
                    </button>
                </div>
                <table
                    class="table table-hover ps-2 align-middle  table-row-bordered table-row-gray-200 align-middle  fs-6 gy-4"
                    id="myTable">
                    <thead>
                    <tr class="text-start text-gray-800 fw-bold fs-7 text-uppercase">
                        <th>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="select_all"
                                       id="select_all">
                            </div>
                        </th>
                        <th>Date</th>
                        <th>Name</th>
                        <th>Tag Number</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                </table>


            </div>
        </div>
        <!--end::Content-->
    </div>


    <div class="modal fade" tabindex="-1" id="myModal">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">
                        User
                    </h3>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                         aria-label="Close">
                        <x-lucide-x class="fs-3  me-n1 tw-h-5 tw-w-5"/>
                    </div>
                    <!--end::Close-->
                </div>

                <form action="{{ route('admin.system.users.store') }}" id="submitForm" method="post">
                    @csrf
                    <input type="hidden" id="id" name="id" value="0"/>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder=""/>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="text" class="form-control" id="email" name="email" placeholder=""/>
                                </div>
                            </div>
                        </div>


                    </div>

                    <div class="modal-footer bg-light">
                        <button type="submit" class="btn btn-primary">Save changes</button>
                        <button type="button" class="btn bg-secondary text-light-emphasis" data-bs-dismiss="modal">
                            Close
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        $(function () {
            let myTable = $('#myTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{!! request()->fullUrl() !!}",
                language: {
                    loadingRecords: '&nbsp;',
                    processing: '<div class="spinner spinner-primary spinner-lg mr-15"></div> Processing...'
                },
                columns: [
                    {

                        data: 'select', name: 'select',
                        render: function (data, type, row) {
                            return `<div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="select[]" value="${row.id}" id="select_${row.id}">
                                    </div>`;
                        }, orderable: false,
                        searchable: false, width: '5%'
                    },
                    {
                        data: 'capitalization_date', name: 'capitalization_date',
                        render: function (data) {
                            return moment(data).format('YYYY-MM-DD');
                        }
                    },
                    {data: 'name', name: 'name'},
                    {data: 'tag_number', name: 'tag_number'},
                    {data: 'status', name: 'status'},
                    // {
                    //     data: 'actions',
                    //     name: 'actions',
                    //     orderable: false,
                    //     searchable: false,
                    //     class: 'text-center',
                    //     width: '15%'
                    // },
                ],
                order: [[1, 'desc']]
            });

            let selectedIds = [];
            const confirmationBtn = $('#confirmation_btn');
            const notReceivedBtn = $('#not_received_btn');

            let clickedBtn = '';

            confirmationBtn.on('click', function () {
                clickedBtn = 'confirmation';
                if (selectedIds.length > 0) {
                    Swal.fire({
                        title: 'Are you sure?',
                        text: `You are going to confirm the total of ${selectedIds.length} assets have been received.`,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Yes, confirm!',
                        cancelButtonText: 'No, cancel!',
                        reverseButtons: true
                    }).then(function (result) {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: '{{ route('admin.my-assets.confirmation') }}',
                                type: 'POST',
                                data: {
                                    _token: '{{ csrf_token() }}',
                                    ids: selectedIds,
                                    status:'received',
                                },
                                success: function () {
                                    myTable.ajax.reload();
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Success!',
                                        text: result?.message ?? 'Assets have been confirmed successfully.',
                                    });
                                    selectedIds = [];
                                    confirmationBtn.prop('disabled', true);
                                    notReceivedBtn.prop('disabled', true);
                                    $('#select_all').prop('checked', false);
                                },
                                error: function (xhr) {
                                    if (xhr.status === 422) {
                                        let errors = xhr.responseJSON.errors;
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Error!',
                                            text: errors.join(', '),
                                        });
                                    } else {
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Error!',
                                            text: 'Something went wrong, please try again.',
                                        });
                                    }
                                }
                            });
                        }
                    });
                }
            });

            notReceivedBtn.on('click', function () {
                clickedBtn = 'not_received';
                if (selectedIds.length > 0) {
                    Swal.fire({
                        title: 'Are you sure?',
                        text: `You are going to confirm the total of ${selectedIds.length} assets have not been received.`,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Yes, confirm!',
                        cancelButtonText: 'No, cancel!',
                        reverseButtons: true
                    }).then(function (result) {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: '{{ route('admin.my-assets.confirmation') }}',
                                type: 'POST',
                                data: {
                                    _token: '{{ csrf_token() }}',
                                    ids: selectedIds,
                                    status:'not_received',
                                },
                                success: function () {
                                    myTable.ajax.reload();
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Success!',
                                        text: result?.message ?? 'Assets have been confirmed as not received successfully.',
                                    });
                                    selectedIds = [];
                                    confirmationBtn.prop('disabled', true);
                                    notReceivedBtn.prop('disabled', true);
                                    $('#select_all').prop('checked', false);
                                },
                                error: function (xhr) {
                                    if (xhr.status === 422) {
                                        let errors = xhr.responseJSON.errors;
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Error!',
                                            text: errors.join(', '),
                                        });
                                    } else {
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Error!',
                                            text: 'Something went wrong, please try again.',
                                        });
                                    }
                                }
                            });
                        }
                    });
                }
            });

            $('#select_all').on('change', function () {
                let isChecked = $(this).is(':checked');
                $('input[name="select[]"]').prop('checked', isChecked);
                if (isChecked) {
                    selectedIds = $('input[name="select[]"]').map(function () {
                        return $(this).val();
                    }).get();
                    confirmationBtn.prop('disabled', false);
                    notReceivedBtn.prop('disabled', false);
                } else {
                    selectedIds = [];
                    confirmationBtn.prop('disabled', true);
                    notReceivedBtn.prop('disabled', true);
                }
            });

            $(document).on('change', 'input[name="select[]"]', function () {
                let allChecked = $('input[name="select[]"]').length === $('input[name="select[]"]:checked').length;
                $('#select_all').prop('checked', allChecked);
                if ($(this).is(':checked')) {
                    selectedIds.push($(this).val());
                    if (selectedIds.length > 0) {
                        confirmationBtn.prop('disabled', false);
                        notReceivedBtn.prop('disabled', false);
                    }
                } else {
                    selectedIds = selectedIds.filter(id => id !== $(this).val());
                    if (selectedIds.length === 0) {
                        confirmationBtn.prop('disabled', true);
                        notReceivedBtn.prop('disabled', true);
                    }
                }
            });


            window.dt = myTable;

            $('#addBtn').click(function () {
                $('#myModal').modal('show');
            });
            $('#myModal').on('hidden.bs.modal', function () {
                $('#submitForm').trigger('reset');
                $('#id').val(0);
            });

            let submitForm = $('#submitForm');
            submitForm.submit(function (e) {
                e.preventDefault();
                let $this = $(this);
                let formData = new FormData(this);
                let id = $('#id').val();
                let url = $this.attr('action');
                let btn = $(this).find('[type="submit"]');
                btn.prop('disabled', true);
                btn.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Saving...');
                // remove the error text
                $this.find('.invalid-feedback').remove();
                // remove the error class
                $this.find('.is-invalid').removeClass('is-invalid');
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        myTable.ajax.reload();
                        $('#myModal').modal('hide');
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: 'Record has been saved successfully.',
                            // showConfirmButton: false,
                            // timer: 1500
                        });

                    },
                    error: function (xhr) {
                        if (xhr.status === 422) {
                            let errors = xhr.responseJSON.errors;
                            $.each(errors, function (key, value) {
                                let $1 = $('#' + key);
                                $1.addClass('is-invalid');
                                // create span element under the input field with a class of invalid-feedback and add the error text returned by the validator
                                $1.parent().append('<span class="invalid-feedback">' + value[0] + '</span>');
                            });
                        }
                    },
                    complete: function () {
                        btn.prop('disabled', false);
                        btn.html('Save changes');
                    }
                });
            });

            $(document).on('click', '.js-edit', function (e) {
                e.preventDefault();
                let id = $(this).data('id');
                let url = '{{ route('admin.system.users.show', ':id') }}';
                url = url.replace(':id', id);
                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function (data) {
                        $('#id').val(data.id);
                        $('#job_title').val(data.job_title);
                        $('#name').val(data.name);
                        $('#email').val(data.email);
                        $('#phone').val(data.phone_number);
                        $('#job_title_id').val(data.job_title_id);
                        $('#department_id').val(data.department_id);
                        $.each(data.roles, function (key, value) {
                            $('#role_' + value.id).prop('checked', true);
                        });

                        $('#myModal').modal('show');
                    }
                });
            });

            $(document).on('click', '.js-toggle-active', function (e) {
                e.preventDefault();
                let url = $(this).attr('href');
                let isActive = $(this).data('is_active');
                let msg = isActive === 1 ? 'deactivate' : 'activate';

                Swal.fire({
                    title: 'Are you sure?',
                    text: 'You want to ' + msg + ' this user?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, do it!',
                    cancelButtonText: 'No, cancel!',
                    reverseButtons: true
                }).then(function (result) {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: url,
                            type: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}'
                            },
                            success: function (data) {
                                myTable.ajax.reload();
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success!',
                                    text: 'User has been ' + msg + 'd successfully.',
                                });
                            }
                        });
                    }
                });

            });

            $('#importBtn').click(function () {
                $('#importModal').modal('show');
            });

        });
    </script>
@endpush
