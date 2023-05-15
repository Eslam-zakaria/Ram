<div class="deznav">
    <div class="deznav-scroll">
        <ul class="metismenu" id="menu">
            <li>
                <a href="{{ route('admin.dashboard.index') }}" >
                    <i class="la la-home"></i>
                    <span class="nav-text">Dashboard</span>
                </a>
            </li>

            @if (in_array(Auth::user()->getRole(), [2,3]))
            <li>
                <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="las la-stethoscope"></i>
                    <span class="nav-text">Doctors</span>
                </a>
                <ul aria-expanded="false">
                <li><a href="{{ route('admin.doctors.index') }}">Doctors</a></li>
                    <li><a href="{{ route('admin.videos.index') }}">Videos</a></li>
                </ul>
            </li>
            @endif

            @if (in_array(Auth::user()->getRole(), [2]))
                <li>
                    <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                        <i class="las la-stethoscope"></i>
                        <span class="nav-text">Cases</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="{{ route('admin.Casings.index') }}">Cases</a></li>
                        <li><a href="{{ route('admin.Casing-categories.index') }}">Cases Categories</a></li>
                    </ul>
                </li>
            @endif

            @if (in_array(Auth::user()->getRole(), [2]))

            <li>
                <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="la la-image"></i>
                    <span class="nav-text">Discounts</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('admin.discounts.index') }}">Discount</a></li>
                    <li><a href="{{ route('admin.discount-categories.index') }}">Discountn Categories</a></li>
                    <li><a href="{{ route('admin.cards.index') }}">Discount Cards</a></li>
                    <li><a href="{{ route('admin.discounts-bookings.index') }}">Discount Booking</a></li>
                </ul>
            </li>
            @endif

            @if (in_array(Auth::user()->getRole(), [2]))

            <li>
                <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="la la-box"></i>
                    <span class="nav-text">Jobs</span>
                </a>
                <ul aria-expanded="false">
                <li><a href="{{ route('admin.departments.index') }}">Departments</a></li>
                    <li><a href="{{ route('admin.jobs.index') }}">Jobs</a></li>
                    <li><a href="{{ route('admin.job-requests.index') }}">Job Applications</a></li>
                </ul>
            </li>

            @endif

            @if (in_array(Auth::user()->getRole(), [2,4]))

            <li>
                <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="las la-sticky-note"></i>
                    <span class="nav-text">Offers</span>
                </a>
                <ul aria-expanded="false">
                    @if (in_array(Auth::user()->getRole(), [2]))
                    <li><a href="{{ route('admin.offer-branches.index') }}">Offer City</a></li>
                    <li><a href="{{ route('admin.offers.index') }}">Offers</a></li>
                    @endif
                    @if (in_array(Auth::user()->getRole(), [2,4]))
                    <li><a href="{{ route('admin.offer-bookings.index') }}">Booking</a></li>
                    @endif
                </ul>
            </li>
            @endif
            @if (in_array(Auth::user()->getRole(), [2,3]))

            <li>
                <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="las la-hand-holding-heart"></i>
                    <span class="nav-text">Services</span>
                </a>
                <ul aria-expanded="false">
                <li><a href="{{ route('admin.services.index') }}">Main Services</a></li>
                    <li><a href="{{ route('admin.specificities.index') }}">Specialities</a></li>
                    <li><a href="{{ route('admin.categories.index') }}">Sub Specialities</a></li>
                </ul>
            </li>
            @endif
            @if (in_array(Auth::user()->getRole(), [2,3]))

            <li>
                <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="la la-blog"></i>
                    <span class="nav-text">Blog</span>
                </a>
                <ul aria-expanded="false">
                <li><a href="{{ route('admin.blog-categories.index') }}">Blog Category</a></li>
                    <li><a href="{{ route('admin.blogs.index') }}">Blog</a></li>
                    <li><a href="{{ route('admin.comments.index') }}">Blogs Comments</a></li>
                </ul>
            </li>
            @endif



        <!--            <li>
                <a href="{{ route('admin.pages.index') }}" >
                    <i class="las la-sticky-note"></i>
                    <span class="nav-text">Pages</span>
                </a>
            </li>-->

            @if (in_array(Auth::user()->getRole(), [2,4]))
            <li>
                <a href="{{ route('admin.bookings.index') }}" >
                    <i class="las la-book"></i>
                    <span class="nav-text">Bookings</span>
                </a>
            </li>

            <li>
                <a href="{{ route('admin.leads.index') }}" >
                    <i class="las la-book"></i>
                    <span class="nav-text">Leads</span>
                </a>
            </li>

            @endif

            @if (in_array(Auth::user()->getRole(), [2]))
            <li>
                <a href="{{ route('admin.tickets.index') }}" >
                    <i class="las la-envelope"></i>
                    <span class="nav-text">Support Tickets</span>
                </a>
            </li>
            @endif


                @if (in_array(Auth::user()->getRole(), [2]))
                <li>
                    <a href="{{ route('admin.sliders.index') }}" >
                        <i class="la la-image"></i>
                        <span class="nav-text">Slider Images</span>
                    </a>
                </li>
                @endif

            @if (in_array(Auth::user()->getRole(), [2]))

            <li>
                <a href="{{ route('admin.partners.index') }}" >
                    <i class="las la-users"></i>
                    <span class="nav-text">Success Partners</span>
                </a>
            </li>
            @endif

            <!-- <li>
                <a href="{{ route('admin.services.index') }}" >
                    <i class="las la-hand-holding-heart"></i>
                    <span class="nav-text"></span>
                </a>
            </li> -->

            

        <!--
            <li>
                <a href="{{ route('admin.transactions.index') }}" >
                    <i class="la la-exchange-alt"></i>
                    <span class="nav-text">Transactions</span>
                </a>
            </li>


            <li>
                <a href="{{ route('admin.offers.index') }}" >
                    <i class="las la-percent"></i>
                    <span class="nav-text">Offers</span>
                </a>
            </li>

            <li>
                <a href="{{ route('admin.services.index') }}" >
                    <i class="las la-hand-holding-heart"></i>
                    <span class="nav-text">Services</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.reviews.index') }}" >
                    <i class="la la-recycle"></i>
                    <span class="nav-text">Points</span>
                </a>
            </li>

            <li>
                <a href="{{ route('admin.tickets.index') }}" >
                    <i class="las la-envelope"></i>
                    <span class="nav-text">Tickets</span>
                </a>
            </li>


            <li>
                <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="la la-stopwatch"></i>
                    <span class="nav-text">Pending Actions</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('admin.pending.users') }}">Registrations</a></li>
                    <li><a href="{{ route('admin.pending.tickets') }}">Open Tickets</a></li>
                </ul>
            </li>-->

            @if (in_array(Auth::user()->getRole(), [2]))

            <li>
                <a href="{{ route('admin.testimonials.index') }}" >
                    <i class="la la-comments"></i>
                    <span class="nav-text">Testimonials</span>
                </a>
            </li>
            @endif

            @if (in_array(Auth::user()->getRole(), [2]))

            <li>
                <a href="{{ route('admin.branches.index') }}" >
                    <i class="las la-landmark"></i>
                    <span class="nav-text">Branches</span>
                </a>
            </li>

            <li>
                <a href="{{ route('admin.countries.index') }}" >
                    <i class="las la-landmark"></i>
                    <span class="nav-text">Countries/Cities</span>
                </a>
            </li>

            @endif

            @if (in_array(Auth::user()->getRole(), [2]))
            <li>
                <a href="{{ route('admin.users.index') }}" >
                    <i class="la la-users"></i>
                    <span class="nav-text">Admins</span>
                </a>
            </li>
            @endif

            @if (in_array(Auth::user()->getRole(), [2]))

            <li>
                <a href="{{ route('admin.settings.index') }}" >
                    <i class="la la-cog"></i>
                    <span class="nav-text">Settings</span>
                </a>
            </li>
            @endif
            


        </ul>

        <div class="copyright">
            <p><strong>Jumppeak Admin Dashboard</strong> © 2020 All Rights Reserved</p>
            <p>Made with <span class="heart"></span> by Jumppeak Team</p>
        </div>
    </div>
</div>
