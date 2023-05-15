<template>
    <div class="row">
        <div class="table-filters col-md-12 mb-4">
            <div class="row mb-4">
                <div class="form-group col-md-3 col-sm-4 mb-1">
                        <label for="date">Date From</label>
                        <input type="date" class="form-control" v-model="date_from">
                </div>
                <div class="form-group col-md-3 col-sm-4 mb-1">
                        <label for="date">Date To</label>
                        <input type="date" class="form-control" v-model="date_to">
                </div>
                <div class="form-group col-md-3 col-sm-4 mb-1" style="margin-right: 90px;">
                        <label for="status">Status</label>
                        <select class="form-control" v-model="status_filter">
                            <option value="">-- Select --</option>
                            <option value="0">Pending</option>
                            <option value="1">Confirmed</option>
                            <option value="2">Not Confirmed</option>
                        </select>                                            
                </div>
                <div class="form-group col-md-2 col-sm-3 mt-4 mb-1" style="margin-top: 30px !important;">
                    <div class="input-group  d-xl-inline-flex">
                        <a class="btn btn-success" :href="route('admin.offer-bookings.export', {page: page ,date_from: date_from,date_to: date_to,status_filter: status_filter, q: q})" title="New" style="width: 100%;">Export</i></a>
                    </div>
                </div>
            </div>
            <div class="row">

                <div class="col-sm-6 col-md-3 mb-1">
                    <div class="input-group  search-area d-xl-inline-flex  mr-1" >
                        <input type="text" v-on:keyup.enter="fetchBookings()" class="form-control" placeholder="Search here..." v-model="q">
                        <div class="input-group-append">
                            <span class="input-group-text">
                                <a href="javascript:void(0)" v-on:click="fetchBookings()"><i class="flaticon-381-search-2"></i></a>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="col-md-2 col-sm-6 mb-1 ml-auto">
                    <div class="input-group search-area d-xl-inline-flex">
                        <div class="dropdown " style="width: 100%">
                            <a href="javascript:void(0)" :class="'btn-'+sort.class" class="btn btn-rounded " style="width: 100%" data-toggle="dropdown" aria-expanded="false">
                                <i class="las la-sort-amount-down-alt scale5"></i>

                                {{  sort.label }}
                                <i class="las la-angle-down "></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-center">
                                <a v-for="bookingSort in sorts" v-on:click="changeSort(BookingSort)" class="dropdown-item" href="javascript:void(0);"><span :class="'text-'+bookingSort.class">{{ bookingSort.label }}</span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-responsive-md text-small">
                            <thead>
                                <tr>
                                    <th class="width10">#</th>
                                    <th>Merchant Reference</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Offer</th>
                                    <th>Branche</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>Payment</th>
                                    <th>Installment</th>
                                    <th>Notes</th>
                                    <th>Available Time</th>
                                    <th>Attendance Date</th>
                                    <th>Created</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="booking in bookings.data">
                                    <td><strong>{{ booking.id }}</strong></td>
                                    <td>{{ booking.order_reference }}</td>
                                    <td>{{ booking.name }}</td>
                                    <td>{{ booking.phone}}</td>
                                    <td>{{ booking.offer.name }}</td>
                                    <td>
                                        <span class="badge badge-light" v-if="booking.sub_branche_id > '0'"> {{ booking.branche.name }} </span>
                                        
                                        <span class="badge badge-danger" v-else>
                                         غير محدد 
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge badge-success" v-if="booking.offer.discount > '0'"> {{ booking.offer.price_after_discount }} </span>
                                        
                                        <span class="badge badge-success" v-else>
                                         {{ booking.offer.price }}
                                        </span>
                                    </td>
                                    <td>
                                        <span v-bind:class="{ 'badge-success' : (booking.status === 1) , 'badge-light' : (booking.status === 0) , 'badge-danger' : (booking.status === 2)  }" class="badge">{{ booking.statusLabel }}</span>
                                    </td>
                                    <td>{{ booking.type_pay }}</td>
                                    <td>
                                        <span class="badge badge-light" v-if="booking.type_installment > '0'"> {{ booking.type_installment }} </span>
                                        
                                        <span class="badge badge-danger" v-else>
                                         غير محدد 
                                        </span>
                                    </td>
                                    <td>{{ booking.notes }}</td>
                                    <td>{{ booking.available_time }}</td>
                                    <td>{{ moment(booking.attendance_date).format('DD MMM YYYY') }}</td>
                                    <td>{{ moment(booking.created_at).format('DD MMM YYYY, hh:mm A') }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn btn-success light sharp" data-toggle="dropdown">
                                                <svg width="20px" height="20px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><circle fill="#000000" cx="5" cy="12" r="2"/><circle fill="#000000" cx="12" cy="12" r="2"/><circle fill="#000000" cx="19" cy="12" r="2"/></g></svg>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" :href="route('admin.offer-bookings.edit', {offer_booking: booking.id, page: page})">Edit</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                        <pagination :limit="8" :data="bookings" :show-disabled="true" @pagination-change-page="fetchBookings">
                            <span slot="prev-nav">&lt;</span>
                            <span slot="next-nav">&gt;</span>

                        </pagination>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'offer-bookings-list',
    data: function () {
        return {
            'q' : '',
            'date_from':'',
            'date_to':'',
            'status_filter':'',
            'sort': { 'id' : 'created_at', 'direction': 'DESC', 'label' : 'Sort', 'class' : ''},
            'bookings' : {},
            'page' : 1,
            'sorts' : []
        }
    },
    created() {
        this.fetchBookings();
        this.fetchSorts();
    },
    computed: {
    },
    methods: {
        fetchBookings(page = 1) {
            this.page = page;
            axios
                .get(route('api.offer-bookings.index', {
                    page: page,
                    date_from:this.date_from,
                    date_to:this.date_to,
                    status_filter:this.status_filter,
                    q : this.q,
                    sort : this.sort.id,
                    direction : this.sort.direction,
                }))
                .then(response => {
                    this.bookings = response.data;
                });
        },
        fetchSorts() {
            this.sorts = {
                1: { 'id' : 'created_at', 'direction': 'DESC', 'label' : 'Created DESC', 'class' : 'dark'},
                2: { 'id' : 'created_at', 'direction': 'ASC', 'label' : 'Created ASC', 'class' : 'dark'},
            };
        },
        changeSort(sort) {
            this.sort = (sort !== undefined) ? this.sort = sort : '';
            this.fetchBookings();
        },
    }
}
</script>
