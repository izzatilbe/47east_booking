<aside class="main-sidebar sidebar-dark-primary elevation-4" style="min-height: 917px;">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <span class="brand-text font-weight-light">{{ trans('panel.site_title') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route("admin.home") }}" class="nav-link">
                        <p>
                            <i class="fas fa-fw fa-tachometer-alt">

                            </i>
                            <span>{{ trans('global.dashboard') }}</span>
                        </p>
                    </a>
                </li>
                @can('user_management_access')
                    <li class="nav-item has-treeview {{ request()->is('admin/permissions*') ? 'menu-open' : '' }} {{ request()->is('admin/roles*') ? 'menu-open' : '' }} {{ request()->is('admin/users*') ? 'menu-open' : '' }} {{ request()->is('admin/business-units*') ? 'menu-open' : '' }} {{ request()->is('admin/employees*') ? 'menu-open' : '' }} {{ request()->is('admin/customers*') ? 'menu-open' : '' }} {{ request()->is('admin/audit-logs*') ? 'menu-open' : '' }}">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class="fa-fw fas fa-users">

                            </i>
                            <p>
                                <span>{{ trans('cruds.userManagement.title') }}</span>
                                <i class="right fa fa-fw fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('permission_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.permissions.index") }}" class="nav-link {{ request()->is('admin/permissions') || request()->is('admin/permissions/*') ? 'active' : '' }}">
                                        <i class="fa-fw fas fa-unlock-alt">

                                        </i>
                                        <p>
                                            <span>{{ trans('cruds.permission.title') }}</span>
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('role_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.roles.index") }}" class="nav-link {{ request()->is('admin/roles') || request()->is('admin/roles/*') ? 'active' : '' }}">
                                        <i class="fa-fw fas fa-briefcase">

                                        </i>
                                        <p>
                                            <span>{{ trans('cruds.role.title') }}</span>
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('user_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.users.index") }}" class="nav-link {{ request()->is('admin/users') || request()->is('admin/users/*') ? 'active' : '' }}">
                                        <i class="fa-fw fas fa-user">

                                        </i>
                                        <p>
                                            <span>{{ trans('cruds.user.title') }}</span>
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('business_unit_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.business-units.index") }}" class="nav-link {{ request()->is('admin/business-units') || request()->is('admin/business-units/*') ? 'active' : '' }}">
                                        <i class="fa-fw fas fa-briefcase">

                                        </i>
                                        <p>
                                            <span>{{ trans('cruds.businessUnit.title') }}</span>
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('employee_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.employees.index") }}" class="nav-link {{ request()->is('admin/employees') || request()->is('admin/employees/*') ? 'active' : '' }}">
                                        <i class="fa-fw fas fa-user-tie">

                                        </i>
                                        <p>
                                            <span>{{ trans('cruds.employee.title') }}</span>
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('customer_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.customers.index") }}" class="nav-link {{ request()->is('admin/customers') || request()->is('admin/customers/*') ? 'active' : '' }}">
                                        <i class="fa-fw fas fa-user-plus">

                                        </i>
                                        <p>
                                            <span>{{ trans('cruds.customer.title') }}</span>
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('audit_log_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.audit-logs.index") }}" class="nav-link {{ request()->is('admin/audit-logs') || request()->is('admin/audit-logs/*') ? 'active' : '' }}">
                                        <i class="fa-fw fas fa-file-alt">

                                        </i>
                                        <p>
                                            <span>{{ trans('cruds.auditLog.title') }}</span>
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('booking_management_access')
                    <li class="nav-item has-treeview {{ request()->is('admin/staycation-bookings*') ? 'menu-open' : '' }} {{ request()->is('admin/dormitory-bookings*') ? 'menu-open' : '' }} {{ request()->is('admin/venue-bookings*') ? 'menu-open' : '' }} {{ request()->is('admin/venue-packages*') ? 'menu-open' : '' }} {{ request()->is('admin/coworkings*') ? 'menu-open' : '' }}">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class="fa-fw fas fa-book-open">

                            </i>
                            <p>
                                <span>{{ trans('cruds.bookingManagement.title') }}</span>
                                <i class="right fa fa-fw fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('staycation_booking_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.staycation-bookings.index") }}" class="nav-link {{ request()->is('admin/staycation-bookings') || request()->is('admin/staycation-bookings/*') ? 'active' : '' }}">
                                        <i class="fa-fw fas fa-clipboard">

                                        </i>
                                        <p>
                                            <span>{{ trans('cruds.staycationBooking.title') }}</span>
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('dormitory_booking_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.dormitory-bookings.index") }}" class="nav-link {{ request()->is('admin/dormitory-bookings') || request()->is('admin/dormitory-bookings/*') ? 'active' : '' }}">
                                        <i class="fa-fw fas fa-clipboard">

                                        </i>
                                        <p>
                                            <span>{{ trans('cruds.dormitoryBooking.title') }}</span>
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('venue_booking_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.venue-bookings.index") }}" class="nav-link {{ request()->is('admin/venue-bookings') || request()->is('admin/venue-bookings/*') ? 'active' : '' }}">
                                        <i class="fa-fw fas fa-clipboard">

                                        </i>
                                        <p>
                                            <span>{{ trans('cruds.venueBooking.title') }}</span>
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('venue_package_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.venue-packages.index") }}" class="nav-link {{ request()->is('admin/venue-packages') || request()->is('admin/venue-packages/*') ? 'active' : '' }}">
                                        <i class="fa-fw fas fa-clipboard">

                                        </i>
                                        <p>
                                            <span>{{ trans('cruds.venuePackage.title') }}</span>
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('coworking_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.coworkings.index") }}" class="nav-link {{ request()->is('admin/coworkings') || request()->is('admin/coworkings/*') ? 'active' : '' }}">
                                        <i class="fa-fw fas fa-clipboard">

                                        </i>
                                        <p>
                                            <span>{{ trans('cruds.coworking.title') }}</span>
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('venue_management_access')
                    <li class="nav-item has-treeview {{ request()->is('admin/venue-categories*') ? 'menu-open' : '' }} {{ request()->is('admin/venue-tags*') ? 'menu-open' : '' }} {{ request()->is('admin/venue-amenities*') ? 'menu-open' : '' }} {{ request()->is('admin/venues*') ? 'menu-open' : '' }}">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class="fa-fw fas fa-edit">

                            </i>
                            <p>
                                <span>{{ trans('cruds.venueManagement.title') }}</span>
                                <i class="right fa fa-fw fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('venue_category_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.venue-categories.index") }}" class="nav-link {{ request()->is('admin/venue-categories') || request()->is('admin/venue-categories/*') ? 'active' : '' }}">
                                        <i class="fa-fw fas fa-folder">

                                        </i>
                                        <p>
                                            <span>{{ trans('cruds.venueCategory.title') }}</span>
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('venue_tag_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.venue-tags.index") }}" class="nav-link {{ request()->is('admin/venue-tags') || request()->is('admin/venue-tags/*') ? 'active' : '' }}">
                                        <i class="fa-fw fas fa-folder">

                                        </i>
                                        <p>
                                            <span>{{ trans('cruds.venueTag.title') }}</span>
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('venue_amenity_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.venue-amenities.index") }}" class="nav-link {{ request()->is('admin/venue-amenities') || request()->is('admin/venue-amenities/*') ? 'active' : '' }}">
                                        <i class="fa-fw fas fa-folder">

                                        </i>
                                        <p>
                                            <span>{{ trans('cruds.venueAmenity.title') }}</span>
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('venue_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.venues.index") }}" class="nav-link {{ request()->is('admin/venues') || request()->is('admin/venues/*') ? 'active' : '' }}">
                                        <i class="fa-fw fas fa-hotel">

                                        </i>
                                        <p>
                                            <span>{{ trans('cruds.venue.title') }}</span>
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('accommodation_management_access')
                    <li class="nav-item has-treeview {{ request()->is('admin/accom-categories*') ? 'menu-open' : '' }} {{ request()->is('admin/accom-tags*') ? 'menu-open' : '' }} {{ request()->is('admin/accom-amenities*') ? 'menu-open' : '' }} {{ request()->is('admin/accommodations*') ? 'menu-open' : '' }}">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class="fa-fw fas fa-edit">

                            </i>
                            <p>
                                <span>{{ trans('cruds.accommodationManagement.title') }}</span>
                                <i class="right fa fa-fw fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('accom_category_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.accom-categories.index") }}" class="nav-link {{ request()->is('admin/accom-categories') || request()->is('admin/accom-categories/*') ? 'active' : '' }}">
                                        <i class="fa-fw fas fa-folder">

                                        </i>
                                        <p>
                                            <span>{{ trans('cruds.accomCategory.title') }}</span>
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('accom_tag_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.accom-tags.index") }}" class="nav-link {{ request()->is('admin/accom-tags') || request()->is('admin/accom-tags/*') ? 'active' : '' }}">
                                        <i class="fa-fw fas fa-folder">

                                        </i>
                                        <p>
                                            <span>{{ trans('cruds.accomTag.title') }}</span>
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('accom_amenity_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.accom-amenities.index") }}" class="nav-link {{ request()->is('admin/accom-amenities') || request()->is('admin/accom-amenities/*') ? 'active' : '' }}">
                                        <i class="fa-fw fas fa-folder">

                                        </i>
                                        <p>
                                            <span>{{ trans('cruds.accomAmenity.title') }}</span>
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('accommodation_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.accommodations.index") }}" class="nav-link {{ request()->is('admin/accommodations') || request()->is('admin/accommodations/*') ? 'active' : '' }}">
                                        <i class="fa-fw fas fa-concierge-bell">

                                        </i>
                                        <p>
                                            <span>{{ trans('cruds.accommodation.title') }}</span>
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('expense_management_access')
                    <li class="nav-item has-treeview {{ request()->is('admin/expense-categories*') ? 'menu-open' : '' }} {{ request()->is('admin/income-categories*') ? 'menu-open' : '' }} {{ request()->is('admin/expenses*') ? 'menu-open' : '' }} {{ request()->is('admin/incomes*') ? 'menu-open' : '' }} {{ request()->is('admin/expense-reports*') ? 'menu-open' : '' }}">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class="fa-fw fas fa-money-bill">

                            </i>
                            <p>
                                <span>{{ trans('cruds.expenseManagement.title') }}</span>
                                <i class="right fa fa-fw fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('expense_category_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.expense-categories.index") }}" class="nav-link {{ request()->is('admin/expense-categories') || request()->is('admin/expense-categories/*') ? 'active' : '' }}">
                                        <i class="fa-fw fas fa-list">

                                        </i>
                                        <p>
                                            <span>{{ trans('cruds.expenseCategory.title') }}</span>
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('income_category_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.income-categories.index") }}" class="nav-link {{ request()->is('admin/income-categories') || request()->is('admin/income-categories/*') ? 'active' : '' }}">
                                        <i class="fa-fw fas fa-list">

                                        </i>
                                        <p>
                                            <span>{{ trans('cruds.incomeCategory.title') }}</span>
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('expense_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.expenses.index") }}" class="nav-link {{ request()->is('admin/expenses') || request()->is('admin/expenses/*') ? 'active' : '' }}">
                                        <i class="fa-fw fas fa-arrow-circle-right">

                                        </i>
                                        <p>
                                            <span>{{ trans('cruds.expense.title') }}</span>
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('income_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.incomes.index") }}" class="nav-link {{ request()->is('admin/incomes') || request()->is('admin/incomes/*') ? 'active' : '' }}">
                                        <i class="fa-fw fas fa-arrow-circle-right">

                                        </i>
                                        <p>
                                            <span>{{ trans('cruds.income.title') }}</span>
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('expense_report_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.expense-reports.index") }}" class="nav-link {{ request()->is('admin/expense-reports') || request()->is('admin/expense-reports/*') ? 'active' : '' }}">
                                        <i class="fa-fw fas fa-chart-line">

                                        </i>
                                        <p>
                                            <span>{{ trans('cruds.expenseReport.title') }}</span>
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                <li class="nav-item">
                    <a href="{{ route("admin.systemCalendar") }}" class="nav-link {{ request()->is('admin/system-calendar') || request()->is('admin/system-calendar/*') ? 'active' : '' }}">
                        <i class="fas fa-fw fa-calendar">

                        </i>
                        <p>
                            <span>{{ trans('global.systemCalendar') }}</span>
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                        <p>
                            <i class="fas fa-fw fa-sign-out-alt">

                            </i>
                            <span>{{ trans('global.logout') }}</span>
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>