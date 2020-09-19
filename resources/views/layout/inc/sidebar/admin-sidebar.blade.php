<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <?php $userImage = Pharma::getinfo('users','id',Sentinel::getUser()->id)?>
        <!-- User profile -->
        <div class="user-profile" style="background: url({{!empty($userImage->profile_banar)?asset(Storage::url($userImage->profile_banar)) : asset('material//assets/images/users/1.jpg')}}) no-repeat; background-position: center; background-size: cover;">
            <!-- User profile image -->
            <div class="profile-img"> <img src="{{!empty($userImage->profile_image)?asset(Storage::url($userImage->profile_image)) : asset('material//assets/images/users/1.jpg')}}" alt="user"></div>
            <!-- User profile text-->
            <div class="profile-text"> <a href="#" class="dropdown-toggle u-dropdown" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">{{Sentinel::getUser()->name}}</a>
                <div class="dropdown-menu animated flipInY">
                    <a href="{{url('myprofile')}}" class="dropdown-item"><i class="ti-user"></i> My Profile</a>
                    <a href="{{url('users/activities')}}" class="dropdown-item"><i class="mdi mdi-run-fast"></i> My Activities</a>
                    <a href="{{url('users/notification')}}" class="dropdown-item"><i class="mdi mdi-alarm-multiple"></i> My Notification</a>
                    <div class="dropdown-divider"></div>
                    <a href="{{url('myprofile')}}" class="dropdown-item"><i class="ti-settings"></i> Account Setting</a>
                    <div class="dropdown-divider"></div>
                    <a href="{{url('logout')}}" class="dropdown-item"><i class="fa fa-power-off"></i> Logout</a>
                </div>
            </div>
        </div>
        <!-- End User profile text-->
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li><a href="{{url('dashboard')}}"><i class="mdi mdi-home"></i><span class="hide-menu">Dashboard</span></a></li>
                
                <li class="{{ request()->is('patient/*') ? 'active' : '' }}">
                    <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="{{ Request::is('vendor*')?'true':'false'}}"><i class="mdi mdi-seat-flat-angled"></i><span class="hide-menu"> Patients</span></a>
                    <ul aria-expanded="{{ Request::is('vendor*')?'true':'false'}}" class="collapse {{ Request::is('vendor*')?'in':''}}">
                        <li><a href="{{url('patient')}}" class="{{ request()->is('patient/*') && !request()->is('patient/create') ? 'active' : '' }}"><i class="mdi mdi-seat-recline-normal" style="font-size:16px"></i> Patients</a></li>
                        {{-- <li><a href="{{url('patient/create')}}" class="{{ request()->is('patient/create') ? 'active' : '' }}"><i class="mdi mdi-table-edit" style="font-size:16px"></i> New Patients</a></li> --}}
                    </ul>
                </li>

         
                <li class="{{ request()->is('diagnostic/*') ? 'active' : '' }}">
                    <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="{{ Request::is('diagnostic*')?'true':'false'}}"><i class="fa fa-medkit" style="font-size:17px"></i><span class="hide-menu"> Diagnostic</span></a>
                     <ul>
                        <li class="{{ request()->is('appointment/') ? 'active' : '' }}">
                            <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="{{ Request::is('appointment/')?'true':'false'}}"><i class="mdi mdi-calendar-blank"></i><span class="hide-menu"> Appointment</span></a>
                            <ul aria-expanded="{{ Request::is('appointment/*')?'true':'false'}}" class="collapse {{ Request::is('appointment/*')?'in':''}}">
                                {{-- <li><a href="{{url('appointment/')}}" class="{{ request()->is('appointment/') ? 'active' : '' }}"><i class="mdi mdi-content-duplicate"></i> Make Appointment </a></li> --}}
                                <li><a href="{{url('appointment-list')}}" class="{{ request()->is('appointment-list') ? 'active' : '' }}"><i class="mdi mdi-content-duplicate"></i> Appointments</a></li>
                            </ul>
                        </li>
                        <li><a href="{{url('prescription/list')}}" class="{{ request()->is('prescription/list') || request()->is('prescription/invoice/*') ? 'active' : '' }}"><i class="mdi mdi-dns"></i> Prescriptions</a></li>
                        <li class="{{ request()->is('schedule/') ? 'active' : '' }}">
                            <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="{{ Request::is('schedule/')?'true':'false'}}"><i class="fa fa-clock-o"></i><span class="hide-menu"> Doctor schedule</span></a>
                            <ul aria-expanded="{{ Request::is('schedule/*')?'true':'false'}}" class="collapse {{ Request::is('schedule/*')?'in':''}}">
                                <li><a href="{{url('schedule')}}" class="{{ request()->is('schedule/') ? 'active' : '' }}"><i class="mdi mdi-view-list"></i> New Schedule</a></li>
                                    <li><a href="{{url('schedule/chart/')}}" class="{{ request()->is('schedule/chart/') ? 'active' : '' }}"><i class="mdi mdi-view-list"></i> Schedule Chart</a></li>
                            </ul>
                        </li>
                         
                        <li class="{{ request()->is('doctor/*') ? 'active' : '' }}">
                            <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="{{ Request::is('doctor/*')?'true':'false'}}"><i class="fa fa-user-md"></i><span class="hide-menu">Doctor</span></a>
                            <ul aria-expanded="{{ Request::is('schedule/*')?'true':'false'}}" class="collapse {{ Request::is('schedule/*')?'in':''}}">
                                <li><a href="{{url('doctor')}}" class="{{ request()->is('doctor/') ? 'active' : '' }}"><i class="fa fa-stethoscope"></i> Doctors</a></li>
                                <li><a href="{{url('doctor/create')}}" class="{{ request()->is('doctor/create/*') ? 'active' : '' }}"><i class="fa fa-user-md"></i> New Doctor</a></li> 
                            </ul>
                        </li>
                        <li>
                            <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="{{ Request::is('diagnostic/testlists/*')?'true':'false'}}"><i class="fa fa-stethoscope"></i><span class="hide-menu"> Manage Tests</span></a>
                            <ul aria-expanded="{{ Request::is('diagnostic/testlists/*')?'true':'false'}}" class="collapse {{ Request::is('diagnostic/testlists/*')?'in':''}}">
                                <li><a href="{{ url('diagnostic/testlists') }}" class="{{ request()->is('diagnostic/testlists') ? 'active' : '' }}"><i class="fa fa-list"></i> Test List</a></li>
                                <li><a href="{{ url('diagnostic/categories') }}" class="{{ request()->is('diagnostic/categories') ? 'active' : '' }}"><i class="fa fa-list-alt"></i> Test Category</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                   
     
                @if(Sentinel::hasAccess('user-management'))
                <hr class="hide-menu hr-borderd">
                    <li class="{{ Request::is('users/*')?'active':''}}">
                        <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="{{ Request::is('users/*')?'true':'false'}}"><i class="mdi mdi-account-settings-variant"></i><span class="hide-menu"> User Management</span></a>
                        <ul aria-expanded="{{ Request::is('users/*')?'true':'false'}}" class="collapse {{ Request::is('users/*')?'in':''}}">
                            @if(Sentinel::hasAccess('user-menu'))
                            <li class="{{ Request::is('users/*/edit') && !Request::is('users/role/*')?'active':''}}">
                                <a class="has-arrow" href="#" aria-expanded="{{ Request::is('users/*/edit') && !Request::is('users/role/*')?'true':'false'}}"><i class="mdi mdi-account-multiple"></i> Manage User</a>
                                <ul aria-expanded="{{ Request::is('users/*/edit') && !Request::is('users/role/*')?'true':'false'}}" class="collapse {{ Request::is('users/*/edit') && !Request::is('users/role/*')?'in':''}}">
                                    @if(Sentinel::hasAccess('user-index'))
                                    <li><a href="{{url('users')}}" class="{{ (Request::is('users/*/edit') && !Request::is('users/create')) && !Request::is('users/role/*')?'active':''}}"><i class="mdi mdi-library-books"></i> User List</a></li>
                                    @endif
                                    @if(Sentinel::hasAccess('user-add'))
                                    <li><a href="{{url('users/create')}}"><i class="mdi mdi-open-in-new"> </i> New User</a></li>
                                    @endif
                                    @if(Sentinel::hasAccess('activities'))
                                    <li><a href="{{url('users/activities')}}"><i class="mdi mdi-run-fast"></i> Users Activities</a></li>
                                    @endif
                                </ul>
                            </li>
                            @endif

                            @if(Sentinel::hasAccess('role-menu'))
                            <li class="{{ Request::is('users/role/*')?'active':''}}">
                                <a class="has-arrow" href="#" aria-expanded="{{ Request::is('users/role/*')?'true':'false'}}"><i class="mdi mdi-human-greeting"></i> Manage Roles</a>
                                <ul aria-expanded="false" class="collapse {{ Request::is('users/role/*')?'in':''}}">
                                    @if(Sentinel::hasAccess('role-index'))
                                    <li><a href="{{url('users/roles')}}" class="{{ (Request::is('users/role/*') && !Request::is('users/role/create'))?'active':''}}"><i class="mdi mdi-library-books"></i> Roles List</a></li>
                                    @endif
                                    @if(Sentinel::hasAccess('role-add'))
                                    <li>
                                        <a href="{{route('createRole')}}" class="{{ Request::is('createRole')?'active':''}}"> <i class="mdi mdi-open-in-new"> </i> Add New</a>
                                    </li>
                                    @endif

                                </ul>
                            </li>
                            @endif

                            @if(Sentinel::hasAccess('permission-menu'))
                            <li class="{{ Request::is('users/permission/*')?'active':''}}">
                                <a class="has-arrow" href="#" aria-expanded="{{Request::is('users/permission/*')?'true':'false'}}}}"><i class="mdi mdi-key"></i> Permissions</a>
                                <ul aria-expanded="false" class="collapse {{Request::is('users/permission/*')?'in':''}}}}">
                                    @if(Sentinel::hasAccess('permission-index'))
                                    <li><a href="{{url('users/permissions')}}" class="{{ (Request::is('users/permission/*') && !Request::is('users/permission/create') ) ?'active':''}}"><i class="mdi mdi-library-books"></i> Permission List</a></li>
                                    @endif
                                    @if(Sentinel::hasAccess('permission-add'))
                                    <li>
                                        <a href="{{url('users/permission/create')}}" class="{{ Request::is('users/permission/create')?'active':''}}"> <i class="mdi mdi-open-in-new"> </i> Add New</a>
                                    </li>
                                    @endif
                                </ul>
                            </li>
                            @endif
                            @if(Sentinel::hasAccess('notifacation'))
                            <li>
                                <a href="{{url('users/notification')}}"><i class="mdi mdi-alarm-multiple"></i> Notifications</a>
                            </li>
                            @endif
                        </ul>
                    </li>
                @endif
                @if(Pharma::isAdmin())
                    <li class="{{ Request::is('settings/*')?'active':''}}">
                        <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="{{ Request::is('settings/*')?'true':'false'}}"><i class="fa fa-cogs" style="font-size:17px"></i><span class="hide-menu">Settings</span></a>
                        <ul aria-expanded="{{ (Request::is('settings/siteSetting/*') || Request::is('settings/siteSetting/*'))?'true':'false'}}" class="collapse {{ (Request::is('settings/siteSetting/*') || Request::is('settings/siteSetting/*'))?'in':''}}">
                            <li><a href="{{url('settings/system-setting/general')}}" class="{{ request()->is('settings/system-setting/general') ? 'active' : '' }}"><i class="mdi mdi-settings-box"></i> General Setting</a></li>
                            <li><a href="{{url('settings/system-setting/site')}}" class="{{ request()->is('settings/system-setting/site') ? 'active' : '' }}"><i class="mdi mdi-wrench"></i> System Setting</a></li>
                        </ul>
                    </li>

                    <li class="{{ Request::is('emailtemplate/*')?'active':''}}">
                       <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="{{ (Request::is('emailtemplate/*') || Request::is('mailbox/*'))?'true':'false'}}"><i class="mdi mdi-email-variant"></i><span class="hide-menu"> Emails </span></a>
                        <ul aria-expanded="{{ (Request::is('emailtemplate/*') || Request::is('mailbox/*'))?'true':'false'}}" class="collapse {{ (Request::is('emailtemplate/*') || Request::is('mailbox/*'))?'in':''}}">
                            <li><a href="{{url('emailtemplate')}}" class="{{ request()->is('emailtemplate/*') ? 'active' : '' }}"><i class="mdi mdi-library-books"></i> Email Templates</a></li>
                            <li><a href="{{url('mailbox')}}" class="{{ request()->is('mailbox/*') ? 'active' : '' }}"><i class="mdi mdi-email-open-outline"></i> Mailbox</a></li>
                        </ul>
                    </li>
                @endif
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
    <!-- Bottom points-->
    <div class="sidebar-footer">
        <a href="{{url('myprofile')}}" class="link" data-toggle="tooltip" title="Settings"><i class="ti-settings"></i></a>
        <a href="{{url('users/activities')}}" class="link" data-toggle="tooltip" title="Email"><i class="mdi mdi-run-fast"></i></a>
        <a href="{{url('logout')}}" class="link" data-toggle="tooltip" title="Logout"><i class="mdi mdi-power"></i></a>
    </div>
    <!-- End Bottom points-->
</aside>