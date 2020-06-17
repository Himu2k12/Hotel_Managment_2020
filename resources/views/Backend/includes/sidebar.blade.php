<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon">
            <img src="{{asset('/Images/')}}/logo.png" width="200px">
        </div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">
@can('isSuper')
    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="{{url('/')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>
@endcan
    <!-- Divider -->
    <hr class="sidebar-divider">
    <!-- Heading -->
    <div class="sidebar-heading">
        Links
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    @can('isSuper')
    <li class="nav-item {!! Request::is('view-add-role-page') ? 'active':'' !!}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Role</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Role Management:</h6>
                <a class="collapse-item {!! Request::is('view-add-role-page') ? 'active':'' !!}" href="{{url('/view-add-role-page')}}">Add Role</a>
            </div>
        </div>
    </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
                <i class="fas fa-fw fa-users-cog"></i>
                <span>Employee</span>
            </a>
            <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Employee Related:</h6>
                    <a class="collapse-item {!! Request::is('/manager-registration-page') ? 'active':'' !!}" href="{{url('/manager-registration-page')}}">Add Manager</a>
                    <a class="collapse-item {!! Request::is('view-hotel-staffs') ? 'active':'' !!}" href="{{url('/view-hotel-staffs')}}">All Employee</a>
                </div>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities34" aria-expanded="true" aria-controls="collapseUtilities2">
                <i class="fas fa-fw fa-file-pdf"></i>
                <span>Reports</span>
            </a>
            <div id="collapseUtilities34" class="collapse {!! Request::is('daily-transaction') ? 'show':'' !!}" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Report Management:</h6>
                    <a class="collapse-item {!! Request::is('overall-report') ? 'active':'' !!}" href="{{url('overall-report')}}">Overall Summery </a>
                    <a class="collapse-item {!! Request::is('booking-reports') ? 'active':'' !!}" href="{{url('booking-reports')}}">Booking Reports</a>
                    <a class="collapse-item {!! Request::is('staff-leave-reports') ? 'active':'' !!}" href="{{url('staff-leave-reports')}}">Staff Leave Reports</a>
                    <a class="collapse-item {!! Request::is('Expense-reports') ? 'active':'' !!}" href="{{url('Expense-reports')}}">Expense Report</a>
                    <a class="collapse-item {!! Request::is('house-keeping-reports') ? 'active':'' !!}" href="{{url('house-keeping-reports')}}">HouseKeeping (Booking)</a>
                    <a  class="collapse-item {!! Request::is('regular-house-keeping-reports') ? 'active':'' !!}" href="{{url('regular-house-keeping-reports')}}">HouseKeeping (Regular)</a>
                </div>
            </div>
        </li>

    @endcan

    @can('isManager')
    <!-- Nav Item - Utilities Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
                <i class="fas fa-fw fa-users-cog"></i>
                <span>Employee</span>
            </a>
            <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Employee Related:</h6>
                    <a class="collapse-item {!! Request::is('employee-registration-page') ? 'active':'' !!}" href="{{url('/employee-registration-page')}}">Employees</a>
                    <a class="collapse-item {!! Request::is('leave-records-staffs') ? 'active':'' !!}" href="{{url('/leave-records-staffs')}}">Leave Record</a>
                </div>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities2" aria-expanded="true" aria-controls="collapseUtilities">
                <i class="fas fa-fw fa-hotel"></i>
                <span>Room</span>
            </a>
            <div id="collapseUtilities2" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Room Management:</h6>
                    <a class="collapse-item {!! Request::is('add-room-type') ? 'active':'' !!}" href="{{url('add-room-type')}}">Room Types</a>
                    <a class="collapse-item {!! Request::is('room-add-form') ? 'active':'' !!}" href="{{url('room-add-form')}}">Rooms</a>
                </div>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities3" aria-expanded="true" aria-controls="collapseUtilities">
                <i class="fas fa-fw fa-home"></i>
                <span>Bookings</span>
            </a>
            <div id="collapseUtilities3" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Booking Management:</h6>
                    <a class="collapse-item {!! Request::is('book-room') ? 'active':'' !!}" href="{{url('book-room')}}">Book Now</a>
                    <a class="collapse-item {!! Request::is('show-all-bookings') ? 'active':'' !!}" href="{{url('show-all-bookings')}}">Booking History</a>
                    <a class="collapse-item {!! Request::is('all-current-bookings') ? 'active':'' !!}" href="{{url('all-current-bookings')}}">Active Bookings</a>
                    <a class="collapse-item {!! Request::is('advance-bookings') ? 'active':'' !!}" href="{{url('advance-bookings')}}">Advance Bookings</a>
                    <a class="collapse-item {!! Request::is('show-all-edited-bookings') ? 'active':'' !!}" href="{{url('show-all-edited-bookings')}}">Edited Bookings</a>
                    <a class="collapse-item {!! Request::is('all-cancel-bookings') ? 'active':'' !!}" href="{{url('all-cancel-bookings')}}">Cancel Bookings</a>
                </div>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilitiesCustomer" aria-expanded="true" aria-controls="collapseUtilities">
                <i class="fas fa-fw fa-users"></i>
                <span>Customers</span>
            </a>
            <div id="collapseUtilitiesCustomer" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Customer Management:</h6>
                    <a class="collapse-item {!! Request::is('customer-entry-form') ? 'active':'' !!}" href="{{url('customer-entry-form')}}">New Customer</a>
                    <a class="collapse-item {!! Request::is('show-all-customers') ? 'active':'' !!}" href="{{url('show-all-customers')}}">All Customer</a>
                </div>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilitiesCost" aria-expanded="true" aria-controls="collapseUtilities">
                <i class="fas fa-fw fa-money-check-alt"></i>
                <span>Additional Expenses</span>
            </a>
            <div id="collapseUtilitiesCost" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Expense Related:</h6>
                    <a class="collapse-item {!! Request::is('additional-cost-form') ? 'active':'' !!}" href="{{url('/additional-cost-form')}}">New Expense</a>
                </div>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilitiesSalary" aria-expanded="true" aria-controls="collapseUtilities">
                <i class="fas fa-fw fa-money-bill-wave"></i>
                <span>Salary</span>
            </a>
            <div id="collapseUtilitiesSalary" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Salary Related:</h6>
                    <a class="collapse-item {!! Request::is('salary-form') ? 'active':'' !!}" href="{{url('salary-form')}}">New Salary</a>
                    <a class="collapse-item {!! Request::is('search-salaries') ? 'active':'' !!}" href="{{url('search-salaries')}}">Find Salaries</a>
                </div>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilitiesTax" aria-expanded="true" aria-controls="collapseUtilities">
                <i class="fab fa-tumblr-square"></i>
                <span>VAT</span>
            </a>
            <div id="collapseUtilitiesTax" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">VAT Related:</h6>
                    <a class="collapse-item {!! Request::is('view-tax-page') ? 'active':'' !!}" href="{{url('/view-tax-page')}}">VAT</a>
                </div>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities34" aria-expanded="true" aria-controls="collapseUtilities2">
                <i class="fas fa-fw fa-file-pdf"></i>
                <span>Reports</span>
            </a>
            <div id="collapseUtilities34" class="collapse {!! Request::is('daily-transaction') ? 'show':'' !!}" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Report Management:</h6>
                    <a class="collapse-item {!! Request::is('overall-report') ? 'active':'' !!}" href="{{url('overall-report')}}">Overall Summery </a>
                    <a class="collapse-item {!! Request::is('booking-reports') ? 'active':'' !!}" href="{{url('booking-reports')}}">Booking Reports</a>
                    <a class="collapse-item {!! Request::is('staff-leave-reports') ? 'active':'' !!}" href="{{url('staff-leave-reports')}}">Staff Leave Reports</a>
                    <a class="collapse-item {!! Request::is('Expense-reports') ? 'active':'' !!}" href="{{url('Expense-reports')}}">Expense Report</a>
                    <a class="collapse-item {!! Request::is('house-keeping-reports') ? 'active':'' !!}" href="{{url('house-keeping-reports')}}">HouseKeeping (Booking)</a>
                    <a  class="collapse-item {!! Request::is('regular-house-keeping-reports') ? 'active':'' !!}" href="{{url('regular-house-keeping-reports')}}">HouseKeeping (Regular)</a>
                </div>
            </div>
        </li>
        @endcan
    @can('isDeputyManager')
        <li class="nav-item">
            <a class="nav-link" href="{{url('/front-desk')}}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
        </li>
        <li class="nav-item {!! Request::is('book-room') ? 'active':'' !!}">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities2" aria-expanded="true" aria-controls="collapseUtilities2">
                <i class="fas fa-fw fa-wrench"></i>
                <span>Booking</span>
            </a>
            <div id="collapseUtilities2" class="collapse {!! Request::is('book-room') ? 'show':'' !!}" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Booking Management:</h6>
                    <a class="collapse-item {!! Request::is('book-room') ? 'active':'' !!}" href="{{url('book-room')}}">Book Now</a>
                    <a class="collapse-item {!! Request::is('all-current-bookings') ? 'active':'' !!}" href="{{url('all-current-bookings')}}">Current Bookings</a>
                    <a class="collapse-item {!! Request::is('advance-bookings') ? 'active':'' !!}" href="{{url('advance-bookings')}}">Advance Bookings</a>
                    <a class="collapse-item {!! Request::is('bookings-history') ? 'active':'' !!}" href="{{url('/bookings-history')}}">Booking History</a>
                </div>
            </div>
        </li>
        <li class="nav-item {!! Request::is('daily-transaction') ? 'active':'' !!}">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities3" aria-expanded="true" aria-controls="collapseUtilities2">
                <i class="fas fa-fw fa-wrench"></i>
                <span>Transaction</span>
            </a>
            <div id="collapseUtilities3" class="collapse {!! Request::is('daily-transaction') ? 'show':'' !!}" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Transaction Management:</h6>
                    <a class="collapse-item {!! Request::is('daily-transaction') ? 'active':'' !!}" href="{{url('daily-transaction')}}">Daily</a>
                </div>
            </div>
        </li>
        <li class="nav-item {!! Request::is('House-Keeping') ? 'active':'' !!}">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities4" aria-expanded="true" aria-controls="collapseUtilities2">
                <i class="fas fa-fw fa-wrench"></i>
                <span>House Keeping</span>
            </a>
            <div id="collapseUtilities4" class="collapse {!! Request::is('house-keeping') ? 'show':'' !!}" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">House Keeping Management</h6>
                    <a class="collapse-item {!! Request::is('house-keeping') ? 'active':'' !!}" href="{{url('house-keeping')}}">DashBoard</a>
                    <a class="collapse-item {!! Request::is('Room-Status') ? 'active':'' !!}" href="{{url('Room-Status')}}">Post Booking Service</a>
                    <a class="collapse-item {!! Request::is('Regular-room-service') ? 'active':'' !!}" href="{{url('Regular-room-service')}}">Regular Service</a>
                    <a class="collapse-item {!! Request::is('active-Services') ? 'active':'' !!}" href="{{url('active-Services')}}">Active Services</a>
                    <a class="collapse-item {!! Request::is('daily-history') ? 'active':'' !!}" href="{{url('daily-history')}}">Daily History</a>
                </div>
            </div>
        </li>
    @endcan

         @can('isReceptionist')
                <li class="nav-item">
            <a class="nav-link" href="{{url('/front-desk')}}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
        </li>
                <li class="nav-item {!! Request::is('book-room') ? 'active':'' !!}">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities2" aria-expanded="true" aria-controls="collapseUtilities2">
                        <i class="fas fa-fw fa-wrench"></i>
                        <span>Booking</span>
                    </a>
                    <div id="collapseUtilities2" class="collapse {!! Request::is('book-room') ? 'show':'' !!}" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Booking Management:</h6>
                            <a class="collapse-item {!! Request::is('book-room') ? 'active':'' !!}" href="{{url('book-room')}}">Book Now</a>
                            <a class="collapse-item {!! Request::is('all-current-bookings') ? 'active':'' !!}" href="{{url('all-current-bookings')}}">Current Bookings</a>
                            <a class="collapse-item {!! Request::is('advance-bookings') ? 'active':'' !!}" href="{{url('advance-bookings')}}">Advance Bookings</a>
                            <a class="collapse-item {!! Request::is('bookings-history') ? 'active':'' !!}" href="{{url('/bookings-history')}}">Booking History</a>
                        </div>
                    </div>
                </li>
                <li class="nav-item {!! Request::is('book-room') ? 'active':'' !!}">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities3" aria-expanded="true" aria-controls="collapseUtilities2">
                        <i class="fas fa-fw fa-wrench"></i>
                        <span>Transaction</span>
                    </a>
                    <div id="collapseUtilities3" class="collapse {!! Request::is('daily-transaction') ? 'show':'' !!}" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Transaction Management:</h6>
                            <a class="collapse-item {!! Request::is('daily-transaction') ? 'active':'' !!}" href="{{url('daily-transaction')}}">Daily</a>
                        </div>
                    </div>
                </li>
                <li class="nav-item {!! Request::is('House-Keeping') ? 'active':'' !!}">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities4" aria-expanded="true" aria-controls="collapseUtilities2">
                        <i class="fas fa-fw fa-wrench"></i>
                        <span>House Keeping</span>
                    </a>
                    <div id="collapseUtilities4" class="collapse {!! Request::is('house-keeping') ? 'show':'' !!}" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">House Keeping Management</h6>
                            <a class="collapse-item {!! Request::is('house-keeping') ? 'active':'' !!}" href="{{url('house-keeping')}}">DashBoard</a>
                            <a class="collapse-item {!! Request::is('Room-Status') ? 'active':'' !!}" href="{{url('Room-Status')}}">Post Booking Service</a>
                            <a class="collapse-item {!! Request::is('Regular-room-service') ? 'active':'' !!}" href="{{url('Regular-room-service')}}">Regular Service</a>
                            <a class="collapse-item {!! Request::is('active-Services') ? 'active':'' !!}" href="{{url('active-Services')}}">Active Services</a>
                            <a class="collapse-item {!! Request::is('daily-history') ? 'active':'' !!}" href="{{url('daily-history')}}">Daily History</a>
                        </div>
                    </div>
                </li>

         @endcan

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Addons
    </div>


    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->
