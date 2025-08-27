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
                            <x-lucide-house class="fs-3 text-gray-400 me-n1 tw-h-5 tw-w-5" />
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
                        <x-lucide-chevron-right class="text-gray-400 mx-n1 tw-h-5 tw-w-5" />
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-gray-700">
                        All
                    </li>
                    <!--end::Item-->
                </ul>
                <!--end::Breadcrumb-->
                <!--begin::Title-->
                <h1 class="page-heading d-flex flex-column justify-content-center text-dark fw-bolder fs-1 lh-0">
                    All Assets
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

        <div class="table-responsive">
            <table
                class="table table-hover ps-2 align-middle  table-row-bordered table-row-gray-200 align-middle  fs-6 gy-4"
                id="myTable">
                <thead>
                    <tr class="text-start text-gray-800 fw-bold fs-7 text-uppercase">
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
                order: [[0, 'desc']]
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
                        text: 'Please select a status.',
                    });
                    return;
                }

                if (selectedIds.length > 0) {
                    Swal.fire({
                        title: 'Are you sure?',
                        text: `You are going to confirm the total of ${selectedIds.length} assets as ${status}.`,
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
                                    btn.html('Save changes');
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