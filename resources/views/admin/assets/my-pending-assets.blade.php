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
                If you have received the assets, please choose  "Received" option
                and if you have not received the assets, please choose  "Not Received" option with comment after selecting the
                assets you want to confirm .
            </div>
            <div class="table-responsive">
                <div>
                    <button class="btn btn-success btn-sm" id="confirmation_btn" disabled>
                        <x-lucide-check-circle class="tw-h-5 tw-w-5 me-2"/>
                        Confirm
                    </button>
                    {{--      <button class="btn btn-danger btn-sm" id="not_received_btn" disabled>
                              <x-lucide-x-circle class="tw-h-5 tw-w-5 me-2"/>
                              Not Received
                          </button>--}}
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
                        <th>Location</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                </table>


            </div>
        </div>
        <!--end::Content-->
    </div>


    <div class="modal fade" tabindex="-1" id="confirmationModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">
                        Confirm Asset
                    </h3>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                         aria-label="Close">
                        <x-lucide-x class="fs-3  me-n1 tw-h-5 tw-w-5"/>
                    </div>
                    <!--end::Close-->
                </div>

                <form action="{{ route('admin.my-assets.confirmation') }}" id="submitForm" method="post">
                    @csrf
                    <input type="hidden" id="id" name="id" value="0"/>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">
                                Options
                            </label>
                            <select class="form-select" id="status" name="status">
                                <option value="">Select an option</option>
                                <option value="received">Received</option>
                                <option value="not_received">Not Received</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="comment" class="form-label">Comment</label>
                            <textarea class="form-control" id="comment" name="comment"></textarea>
                        </div>
                    </div>

                    <div class="modal-footer bg-light">
                        <button type="submit" class="btn btn-primary">Submit</button>
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
                    {data: 'location', name: 'location'},
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
            const confirmationBtn = $('#confirmation_btn');
            confirmationBtn.on('click', function () {
                if (selectedIds.length > 0) {
                    $('#confirmationModal').modal('show');
                }
            });
            submitForm.submit(function (e) {
                e.preventDefault();
                let $this = $(this);
                let formData = new FormData(this);
                let url = $this.attr('action');
                let btn = $(this).find('[type="submit"]');

                const status = $('#status').val();
                if (status === '') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Please choose an option.',
                    });
                    return;
                }

                if (selectedIds.length > 0) {
                    // replace _ with empty space in the status value and capitalize the first letter of each word
                    const normalizedStatus = status.replace(/_/g, ' ').replace(/\w\S*/g, function (txt) {
                        return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();
                    })
                    Swal.fire({
                        title: 'Are you sure?',
                        text: `You are going to confirm the total of ${selectedIds.length} assets as ${normalizedStatus}.`,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Yes, confirm!',
                        cancelButtonText: 'No, cancel!',
                        reverseButtons: true
                    }).then(function (result) {
                        if (result.isConfirmed) {
                            btn.prop('disabled', true);
                            btn.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Saving...');
                            // remove the error text
                            $this.find('.invalid-feedback').remove();
                            // remove the error class
                            $this.find('.is-invalid').removeClass('is-invalid');
                            $.ajax({
                                url: url,
                                type: 'POST',
                                data: {
                                    ids: selectedIds,
                                    status: status,
                                    comment: $('#comment').val(),
                                    _token: '{{ csrf_token() }}'
                                },
                                success: function (data) {
                                    myTable.ajax.reload();
                                    $('#confirmationModal').modal('hide');
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Success!',
                                        text: 'Record has been saved successfully.',
                                    });
                                    // reset the selectedIds array
                                    selectedIds = [];
                                    // reset the checkboxes
                                    $('input[name="select[]"]').prop('checked', false);
                                    $('#select_all').prop('checked', false);
                                    confirmationBtn.prop('disabled', true);
                                    // reset the form
                                    submitForm.trigger('reset');
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
                                    }else{
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Error!',
                                            text: 'Something went wrong. Please try again later.',
                                        });
                                    }
                                },
                                complete: function () {
                                    btn.prop('disabled', false);
                                    btn.html('Submit');
                                }
                            });
                        }
                    });
                }
            });




            /* */

        });
    </script>
@endpush
