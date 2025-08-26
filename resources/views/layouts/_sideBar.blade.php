<div id="kt_app_sidebar" class="app-sidebar flex-column" data-kt-drawer="true"
     data-kt-drawer-name="app-sidebar" data-kt-drawer-activate="{default: true, lg: false}"
     data-kt-drawer-overlay="true" data-kt-drawer-width="250px" data-kt-drawer-direction="start"
     data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">
    <!--begin::Main-->
    <div
            class="d-flex flex-column justify-content-between h-100 hover-scroll-overlay-y my-2 d-flex flex-column"
            id="kt_app_sidebar_main" data-kt-scroll="true" data-kt-scroll-activate="true"
            data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_app_header"
            data-kt-scroll-wrappers="#kt_app_main" data-kt-scroll-offset="5px">
        <!--begin::Sidebar menu-->
        <div id="#kt_app_sidebar_menu" data-kt-menu="true" data-kt-menu-expand="false"
             class="flex-column-fluid menu menu-sub-indention menu-column menu-rounded menu-active-bg mb-7">

            <div class="menu-item ">
                <a href="{{ route('admin.dashboard') }}"
                   class="menu-link {{ request()->fullUrl() ==route('admin.dashboard')?'active':'' }}">
                    <div class="menu-icon">
                        <x-lucide-gauge class="tw-w-6 tw-h-6"/>
                    </div>
                    <span class="menu-title">Dashboard</span>
                </a>
            </div>


            <!--end:Menu item-->
            <div data-kt-menu-trigger="click"
                 class="menu-item menu-accordion  {{ Str::of(request()->url())->contains('/admin/my-assets')?'show':'' }}">
                <!--begin:Menu link-->
                <span class="menu-link">
                        <span class="menu-icon">
                              <x-lucide-laptop-minimal class="tw-w-6 tw-h-6"/>
                        </span>
                        <span class="menu-title">
                            My Assets
                        </span>
                        <span class="menu-arrow"></span>
                    </span>
                <!--end:Menu link-->

                <!--begin:Menu sub-->
                <div class="menu-sub menu-sub-accordion">
                    <a class="menu-link  {{ request()->url()==route('admin.my-pending-assets')?'active':'' }}"
                       href="{{ route('admin.my-pending-assets') }}">
                        <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                        <span class="menu-title">Pending</span>
                    </a>
                </div>
                <!--end:Menu item-->
                <!--begin:Menu sub-->
                <div class="menu-sub menu-sub-accordion">
                    <a class="menu-link  {{ request()->url()==route('admin.my-confirmed-assets')?'active':'' }}"
                       href="{{ route('admin.my-confirmed-assets') }}">
                        <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                        <span class="menu-title">Confirmed</span>
                    </a>
                </div>
                <!--end:Menu item-->
                <!--begin:Menu sub-->
                <div class="menu-sub menu-sub-accordion">
                    <a class="menu-link  {{ request()->url()==route('admin.my-assets.all')?'active':'' }}"
                       href="{{ route('admin.my-assets.all') }}">
                        <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                        <span class="menu-title">All Assets</span>
                    </a>
                </div>
                <!--end:Menu item-->

            </div>

            @can(\App\Constants\Permission::VIEW_ASSETS_REPORT)
                <div class="menu-item ">
                    <a href="{{ route('admin.confirmed-assets') }}"
                       class="menu-link {{ str_contains(request()->fullUrl(),route('admin.confirmed-assets'))?'active':'' }}">
                        <div class="menu-icon">
                            <x-lucide-check-square class="tw-w-6 tw-h-6"/>
                        </div>
                        <span class="menu-title">Confirmed Assets</span>
                    </a>
                </div>
            @endcan

            @canany([\App\Constants\Permission::MANAGE_DEPARTMENTS,\App\Constants\Permission::MANAGE_JOB_TITLES])

                <!--end:Menu item-->
                <div data-kt-menu-trigger="click"
                     class="menu-item menu-accordion  {{ Str::of(request()->url())->contains('/admin/settings')?'show':'' }}">
                    <!--begin:Menu link-->
                    <span class="menu-link">
                        <span class="menu-icon">
                              <x-lucide-settings-2 class="tw-w-6 tw-h-6"/>
                        </span>
                        <span class="menu-title">
                            Settings
                        </span>
                        <span class="menu-arrow"></span>
                    </span>
                    <!--end:Menu link-->

                    <!--begin:Menu sub-->
                    <div class="menu-sub menu-sub-accordion">
                        @can(\App\Constants\Permission::MANAGE_DEPARTMENTS)
                            <a class="menu-link  {{ request()->url()==route('admin.settings.departments.index')?'active':'' }}"
                               href="{{ route('admin.settings.departments.index') }}">
                                <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                                <span class="menu-title">Departments</span>
                            </a>
                        @endcan
                        @can(\App\Constants\Permission::MANAGE_JOB_TITLES)
                            <a class="menu-link  {{ request()->url()==route('admin.settings.job-titles.index')?'active':'' }}"
                               href="{{ route('admin.settings.job-titles.index') }}">
                                <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                                <span class="menu-title">Job Titles</span>
                            </a>
                        @endcan
                    </div>
                    <!--end:Menu item-->

                </div>
            @endcanany


            @canany([\App\Constants\Permission::MANAGE_ROLES,\App\Constants\Permission::MANAGE_PERMISSIONS,\App\Constants\Permission::MANAGE_USERS])
                <div data-kt-menu-trigger="click"
                     class="menu-item menu-accordion {{ Str::of(request()->url())->contains('/admin/system')?'show':'' }}">
                    <!--begin:Menu link-->
                    <span class="menu-link">
                        <span class="menu-icon">
                         <x-lucide-users class="tw-w-6 tw-h-6"/>
                        </span>
                        <span class="menu-title">
                            User Management
                        </span>
                    <span class="menu-arrow"></span>
                </span>
                    <!--end:Menu link-->
                    <!--begin:Menu sub-->
                    <div class="menu-sub menu-sub-accordion">

                        <!--begin:Menu item-->
                        <!--begin:Menu link-->
                        @can(\App\Constants\Permission::MANAGE_USERS)
                            <a class="menu-link {{ request()->url()==route('admin.system.users.index')?'active':'' }}"
                               href="{{ route('admin.system.users.index') }}">
                                <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                                <span class="menu-title">Users</span>
                            </a>
                        @endcan
                        <!--end:Menu link-->
                        <!--begin:Menu link-->
                        @can(\App\Constants\Permission::MANAGE_ROLES)
                            <a class="menu-link  {{ request()->url()==route('admin.system.roles.index')?'active':'' }}"
                               href="{{ route('admin.system.roles.index') }}">
                                <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                                <span class="menu-title">Roles</span>
                            </a>
                            <!--end:Menu link-->
                        @endcan

                        @can(\App\Constants\Permission::MANAGE_PERMISSIONS)
                            <!--begin:Menu link-->
                            <a class="menu-link {{ request()->url()==route('admin.system.permissions.index')?'active':'' }}"

                               href="{{ route('admin.system.permissions.index') }}">
                                <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                                <span class="menu-title">Permissions</span>
                            </a>
                            <!--end:Menu link-->
                        @endcan

                    </div>
                    <!--end:Menu item-->
                </div>
            @endcanany
        </div>


    </div>
    <!--end::Sidebar menu-->

</div>
<!--end::Main-->
