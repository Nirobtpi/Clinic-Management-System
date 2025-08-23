<div class="col-md-5 col-lg-4 col-xl-3 theiaStickySidebar">
    @php
        $user = auth()->user();
    @endphp
    <!-- Profile Sidebar -->
    <div class="profile-sidebar">
        <div class="widget-profile pro-widget-content">
            <div class="profile-info-widget">
                <a href="#" class="booking-doc-img">
                    <img src="{{$user->photo == "" ? asset('frontend/assets/img/doctors/doctor-thumb-02.jpg') : asset($user->photo) }}"
                        alt="User Image">
                </a>

                <div class="profile-det-info">
                    <h3>{{ $user->name }}</h3>
                    <div class="patient-details">
                        @if(Auth::guard('web')->user()->role == 'doctor')
                        <h5 class="mb-0">{{ auth()->user()->biography ??'' }}</h5>
                        @else
                        <h5><i class="fas fa-birthday-cake"></i>
                            {{ date('d M Y', strtotime($user->birthday)) }}, {{ Carbon\Carbon::parse($user->birthday)->age }} years</h5>
                        <h5 class="mb-0"><i class="fas fa-map-marker-alt"></i> {{ $user?->city_name ?? $user->address_line_one }}, {{ $user?->country_name ??'' }}</h5>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    <div class="dashboard-widget">
        <nav class="dashboard-menu">
            <ul>
                @if(Auth::guard('web')->user()->role == 'doctor')
                <li class="{{ Route::is('doctor.dashboard') ? 'active' : '' }}">
                    <a href="{{ route('doctor.dashboard') }}">
                        <i class="fas fa-columns"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="appointments.html">
                        <i class="fas fa-calendar-check"></i>
                        <span>Appointments</span>
                    </a>
                </li>
                <li>
                    <a href="my-patients.html">
                        <i class="fas fa-user-injured"></i>
                        <span>My Patients</span>
                    </a>
                </li>
                <li class="{{ Route::is('schedule.index') ? 'active' : '' }}">
                    <a href="{{ route('schedule.index') }}">
                        <i class="fas fa-hourglass-start"></i>
                        <span>Schedule Timings</span>
                    </a>
                </li>
                <li>
                    <a href="invoices.html">
                        <i class="fas fa-file-invoice"></i>
                        <span>Invoices</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('doctor.reviews') }}">
                        <i class="fas fa-star"></i>
                        <span>{{ __('Reviews') }}</span>
                    </a>
                </li>
                <li>
                    <a href="chat-doctor.html">
                        <i class="fas fa-comments"></i>
                        <span>Message</span>
                        <small class="unread-msg">23</small>
                    </a>
                </li>
                <li class="{{ Route::is('doctor.profile') ? 'active' : '' }}">
                    <a href="{{ route('doctor.profile') }}">
                        <i class="fas fa-user-cog"></i>
                        <span>Profile Settings</span>
                    </a>
                </li>

                <li class="{{ Route::is('doctor.socialmedia.index') ? 'active' : '' }}">
                    <a href="{{ route('doctor.socialmedia.index') }}">
                        <i class="fas fa-share-alt"></i>
                        <span>Social Media</span>
                    </a>
                </li>
                @endif
                @if(Auth::guard('web')->user()->role == 'user')
                <li class="{{ Route::is('user.dashboard') ? 'active' : '' }}">
                    <a href="{{ route('user.dashboard') }}">
                        <i class="fas fa-columns"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="favourites.html">
                        <i class="fas fa-bookmark"></i>
                        <span>Favourites</span>
                    </a>
                </li>
                <li class="">
                    <a href="{{ route('user.profile') }}">
                        <i class="fas fa-user-cog"></i>
                        <span>Profile Settings</span>
                    </a>
                </li>
                @endif
                <li>
                    <a href="{{ route('change.password') }}">
                        <i class="fas fa-lock"></i>
                        <span>Change Password</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('user.logout') }}">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Logout</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</div>
<!-- /Profile Sidebar -->

</div>
