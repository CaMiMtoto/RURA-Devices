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
                    <li class="breadcrumb-item">
                        <x-lucide-chevron-right class="text-gray-400 mx-n1 tw-h-5 tw-w-5"/>
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
                        Confirmed
                    </li>
                    <!--end::Item-->
                </ul>
                <!--end::Breadcrumb-->
                <!--begin::Title-->
                <h1 class="page-heading d-flex flex-column justify-content-center text-dark fw-bolder fs-1 lh-0">
                    Confirmed Assets
                </h1>
                <!--end::Title-->
            </div>
            <!--end::Page title-->
            <!--begin::Actions-->
            <div class="d-flex flex-column gap-2 align-items-start flex-md-row">

                <div>
                    <button wire:click.prevent="exportToExcel"
                            wire:loading.attr="disabled"
                            class="btn btn-light-success btn-sm ">
                            <span wire:loading.remove wire:target="exportToExcel">
                                <x-lucide-download class="me-1 tw-h-5 tw-w-5"/> Export to Excel
                            </span>
                        <span wire:loading wire:target="exportToExcel">
                            <x-lucide-loader class="me-1 tw-h-5 tw-w-5 tw-animate-spin"/> Preparing...
                        </span>
                    </button>
                </div>
            </div>

            <!--end::Actions-->
        </div>
    </div>
    <!--end::Toolbar-->

    <div class="my-3">

        <div class="d-flex flex-column flex-lg-row justify-content-between gap-3 align-items-lg-center mb-4">
            <div class="d-flex flex-column flex-sm-row align-items-sm-center gap-3">
                <div>
                    <label for="perPage" class="visually-hidden">Show</label>
                    <select class="form-select form-select-sm" id="perPage" wire:model.live="perPage">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                </div>
                <div class="d-flex flex-column flex-sm-row align-items-sm-center gap-3">

                </div>
            </div>
            <div class="d-flex flex-column flex-sm-row align-items-sm-center gap-3">


                <div>
                    <label for="search" class="visually-hidden">Search</label>
                    <input type="text" placeholder="Search ... " class="form-control form-control-sm min-w-lg-250px"
                           id="search" wire:model.live.debounce="search"/>
                </div>
            </div>
        </div>
        <div class="table-responsive position-relative">
            <div
                class="position-absolute top-50 start-50 z-3 translate-middle  border border-gray-300 rounded-3 p-3 opacity-100 shadow"
                wire:loading>
                <x-lucide-loader class="tw-animate-spin tw-h-5 tw-w-5"/>
                <span>Please wait...</span>
            </div>
            <table
                class="table ps-2 align-middle position-relative table-row-bordered table-row-gray-200 align-middle  fs-6 gy-4"
                wire:loading.class="opacity-25">
                <thead>
                <tr class="text-start text-gray-800 fw-bold fs-7 text-uppercase">
                    <x-table.sortable label="Confirmed At" column="created_at" :sortCol="$sortCol" :dir="$dir"
                                      wireClick="handleSort('created_at')"/>
                    <th>Asset Name</th>
                    <th>Tag Number</th>
                    <x-table.sortable label="Status" column="status" :sortCol="$sortCol" :dir="$dir"
                                      wireClick="handleSort('status')"/>
                    <x-table.sortable label="Comment" column="comment" :sortCol="$sortCol" :dir="$dir"
                                      wireClick="handleSort('comment')"/>
                    <th>Confirmed By</th>
                </tr>
                </thead>
                <tbody>
                @forelse($assets as $item)
                    <tr>
                        <td>{{ $item->created_at->format('d/m/Y H:i:s') }}</td>
                        <td>{{ $item->asset->name }}</td>
                        <td>{{ $item->asset->tag_number }}</td>
                        <td>
                        <span
                            class="badge bg-light-{{$item->status_color}} rounded-pill text-{{$item->status_color}}-emphasis">
                            {{ $item->real_status }}
                        </span>
                        </td>
                        <td>{{ $item->comment }}</td>
                        <td>{{ $item->confirmedBy->name }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">
                            No transactions found.
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
            {{ $assets->links() }}
        </div>
    </div>


</div>
