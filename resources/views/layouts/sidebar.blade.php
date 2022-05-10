   <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- User profile -->
                <div class="user-profile">
                    <!-- User profile image -->
                    <div class="profile-img"> <img src="{{ asset('public/admin/assets/images/users/profile.png') }}" alt="user" />
                        <!-- this is blinking heartbit-->
                        <div class="notify setpos"> <span class="heartbit"></span> <span class="point"></span> </div>
                    </div>
                    <!-- User profile text-->
                    <div class="profile-text">
                        <h5>{{ auth()->user()->name }} </h5>
                        <!--<a href="#" class="dropdown-toggle u-dropdown" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true"><i class="mdi mdi-settings"></i></a>
                        <a href="app-email.html" class="" data-toggle="tooltip" title="Email"><i class="mdi mdi-gmail"></i></a>-->
                        <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><i class="mdi mdi-power"></i></a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                        <div class="dropdown-menu animated flipInY">
                            <!-- text-->
                            <a href="#" class="dropdown-item"><i class="ti-user"></i> My Profile</a>
                            <!-- text-->
                            <a href="#" class="dropdown-item"><i class="ti-wallet"></i> My Balance</a>
                            <!-- text-->
                            <a href="#" class="dropdown-item"><i class="ti-email"></i> Inbox</a>
                            <!-- text-->
                            <div class="dropdown-divider"></div>
                            <!-- text-->
                            <a href="#" class="dropdown-item"><i class="ti-settings"></i> Account Setting</a>
                            <!-- text-->
                            <div class="dropdown-divider"></div>
                            <!-- text-->
                            <a href="login.html" class="dropdown-item"><i class="fa fa-power-off"></i> Logout</a>
                            <!-- text-->
                        </div>
                    </div>
                </div>
                <!-- End User profile text-->
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">

                    @if(auth()->user()->is_admin == 1)

                        <ul id="sidebarnav">
                        <li class="nav-devider"></li>
                        <li class="nav-small-cap">Employee Panel</li>
                        <li> <a  href="{{ url('home') }}" aria-expanded="false"><i class="mdi mdi-gauge"></i>Home </a> <!--<span class="hide-menu">Dashboard <span class="label label-rouded label-themecolor pull-right">4</span></span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="index.html">Minimal </a></li>
                                <li><a href="index2.html">Analytical</a></li>
                                <li><a href="index3.html">Demographical</a></li>
                                <li><a href="index4.html">Modern</a></li>
                            </ul>-->
                        </li>

                         <li> <a  href="{{ url('notes') }}" aria-expanded="false"><i class=" fa fa-file"></i>Notes </a> <!--<span class="hide-menu">Dashboard <span class="label label-rouded label-themecolor pull-right">4</span></span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="index.html">Minimal </a></li>
                                <li><a href="index2.html">Analytical</a></li>
                                <li><a href="index3.html">Demographical</a></li>
                                <li><a href="index4.html">Modern</a></li>
                            </ul>-->
                        </li>

                        <li> <a  href="{{ url('installments') }}" aria-expanded="false"><i class="fa fa-money"></i>Installments</a> <!--<span class="hide-menu">Dashboard <span class="label label-rouded label-themecolor pull-right">4</span></span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="index.html">Minimal </a></li>
                                <li><a href="index2.html">Analytical</a></li>
                                <li><a href="index3.html">Demographical</a></li>
                                <li><a href="index4.html">Modern</a></li>
                            </ul>-->
                        </li>



                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="fa fa-check-square-o"></i><span class="hide-menu">Leads</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="{{ url('leads/closed') }}">Closed Leads</a></li>
                                <li><a href="{{ url('leads/failed') }}">Failed Leads</a></li>
                            </ul>
                        </li>

                    </ul>


                    @elseif(auth()->user()->is_admin == 2)

                     <ul id="sidebarnav">
                        <li class="nav-devider"></li>
                        <li class="nav-small-cap">Manager Panel</li>
                        <li> <a  href="{{ url('home') }}" aria-expanded="false"><i class="mdi mdi-gauge"></i>Home </a> <!--<span class="hide-menu">Dashboard <span class="label label-rouded label-themecolor pull-right">4</span></span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="index.html">Minimal </a></li>
                                <li><a href="index2.html">Analytical</a></li>
                                <li><a href="index3.html">Demographical</a></li>
                                <li><a href="index4.html">Modern</a></li>
                            </ul>-->
                        </li>

                         <li> <a  href="{{ url('analysis') }}" aria-expanded="false"><i class=" fa fa-line-chart"></i>Analysis </a> <!--<span class="hide-menu">Dashboard <span class="label label-rouded label-themecolor pull-right">4</span></span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="index.html">Minimal </a></li>
                                <li><a href="index2.html">Analytical</a></li>
                                <li><a href="index3.html">Demographical</a></li>
                                <li><a href="index4.html">Modern</a></li>
                            </ul>-->
                        </li>

                        <!--<li> <a  href="#" aria-expanded="false"><i class="fa fa-bar-chart"></i>Employees Performance </a> <span class="hide-menu">Dashboard <span class="label label-rouded label-themecolor pull-right">4</span></span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="index.html">Minimal </a></li>
                                <li><a href="index2.html">Analytical</a></li>
                                <li><a href="index3.html">Demographical</a></li>
                                <li><a href="index4.html">Modern</a></li>
                            </ul>
                        </li>-->


                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="fa fa-users"></i><span class="hide-menu">Add/View Employee</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="{{ url('employees') }}">View Employee</a></li>
                                <li><a href="{{ url('employees/create') }}">Add Employee</a></li>
                                
                            </ul>
                        </li>

                        <li> <a  href="{{ url('installment') }}" aria-expanded="false"><i class="fa fa-money"></i>View Installments </a> <!--<span class="hide-menu">Dashboard <span class="label label-rouded label-themecolor pull-right">4</span></span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="index.html">Minimal </a></li>
                                <li><a href="index2.html">Analytical</a></li>
                                <li><a href="index3.html">Demographical</a></li>
                                <li><a href="index4.html">Modern</a></li>
                            </ul>-->
                        </li>

                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="fa fa-address-book"></i><span class="hide-menu">Add/View Campaign</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="{{ url('sources') }}">View Campaign</a></li>
                                <li><a href="{{ url('sources/create') }}">Add Campaign</a></li>
                                
                            </ul>
                        </li>

                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="fa fa-check-square-o"></i><span class="hide-menu">Add/View Leads</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="{{ url('leads/create') }}">Add Leads</a></li>
                                <!-- <li><a href="{{ url('import') }}">Upload Bulk Leads</a></li> -->
                                <li><a href="{{ url('leads') }}">View Leads</a></li>
                                <!-- <li><a href="{{ url('leads/assign') }}">Assign Leads</a></li> -->   <!-- old Assign function   -->
                                <li><a href="{{ url('leads/assign_lead_emp') }}">Assign Leads</a></li>
                                <li><a href="{{ url('leads/view') }}">View Employees Leads</a></li>
                                <li><a href="{{ url('feedbacks') }}">View Feedbacks</a></li>
                                
                            </ul>
                        </li>

                    </ul>


                    @else

                    <ul id="sidebarnav">
                        <li class="nav-devider"></li>
                        <li class="nav-small-cap">Admin Panel</li>
                        <li> <a  href="{{ url('home') }}" aria-expanded="false"><i class="mdi mdi-gauge"></i>Home </a> <!--<span class="hide-menu">Dashboard <span class="label label-rouded label-themecolor pull-right">4</span></span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="index.html">Minimal </a></li>
                                <li><a href="index2.html">Analytical</a></li>
                                <li><a href="index3.html">Demographical</a></li>
                                <li><a href="index4.html">Modern</a></li>
                            </ul>-->
                        </li>

                         <li> <a  href="{{ url('analysis') }}" aria-expanded="false"><i class=" fa fa-line-chart"></i>Analysis </a> <!--<span class="hide-menu">Dashboard <span class="label label-rouded label-themecolor pull-right">4</span></span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="index.html">Minimal </a></li>
                                <li><a href="index2.html">Analytical</a></li>
                                <li><a href="index3.html">Demographical</a></li>
                                <li><a href="index4.html">Modern</a></li>
                            </ul>-->
                        </li>

              

                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="fa fa-users"></i><span class="hide-menu">Add/View Manager</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="{{ url('managers') }}">View Manager</a></li>
                                <li><a href="{{ url('managers/create') }}">Add Manager</a></li>
                                
                            </ul>
                        </li>

                       <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="fa fa-users"></i><span class="hide-menu">Add/View Employee</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="{{ url('employees') }}">View Employee</a></li>
                                <li><a href="{{ url('employees/create') }}">Add Employee</a></li>
                                
                            </ul>
                        </li>

                        <li> <a  href="{{ url('installment') }}" aria-expanded="false"><i class="fa fa-money"></i>View Installments </a>

                
                        </li>

                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="fa fa-address-book"></i><span class="hide-menu">Add/View Campaign</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="{{ url('sources') }}">View Campaign</a></li>
                                <li><a href="{{ url('sources/create') }}">Add Campaign</a></li>
                                
                            </ul>
                        </li>

                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="fa fa-check-square-o"></i><span class="hide-menu">Add/View Leads</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a class="sub-menu-link"  href="{{ url('leads/create') }}">Add Leads</a></li>
                                <!-- <lclass="sub-menu-link"i><a href="{{ url('import') }}">Upload Bulk Leads</a></li> -->
                                <li><a href="{{ url('leads') }}">View Leads</a></li>
                                <li><a href="{{ url('leads/assign') }}">Assign Leads</a></li>
                                <li><a href="{{ url('leads/view') }}">View Employees Leads</a></li>
                                <li><a href="{{ url('feedbacks') }}">View Feedbacks</a></li>
                                
                            </ul>
                        </li>

                    </ul>

                    @endif
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>



<script>
