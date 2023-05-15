<template>
    <div class="row">
        <div class="table-filters col-md-12 mb-4">
            <div class="row">
                <div class="col-sm-6 col-md-3 mb-1">
                    <div class="input-group  search-area d-xl-inline-flex  mr-1" >
                        <input type="text" v-on:keyup.enter="fetchTickets()" class="form-control" placeholder="Search here..." v-model="q">
                        <div class="input-group-append">
                            <span class="input-group-text">
                                <a href="javascript:void(0)" v-on:click="fetchTickets()"><i class="flaticon-381-search-2"></i></a>
                            </span>
                        </div>
                    </div>
                </div>
                <!-- <div class="col-md-2 col-sm-6 mb-1">
                    <div class="input-group search-area d-xl-inline-flex ">
                        <div class="dropdown " style="width: 100%">
                            <a href="javascript:void(0)" :class="'btn-'+reason.class" class="btn btn-rounded " style="width: 100%" data-toggle="dropdown" aria-expanded="false">
                                <i class="las la-bolt scale5"></i>
                                {{  reason.label }}
                                <i class="las la-angle-down "></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-center">
                                <a v-for="selectedReason in reasons" v-on:click="changeReason(selectedReason)" class="dropdown-item" href="javascript:void(0);"><span :class="'text-'+selectedReason.class">{{ selectedReason.label }}</span></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-1 col-sm-3 mb-1">
                    <div class="input-group  d-xl-inline-flex">
                        <a class="btn btn-success" :href="route('admin.tickets.export', {page: page, reason:reason})" title="New">Export</i></a>
                    </div>
                </div> -->

                <div class="col-md-2 col-sm-6 mb-1 ml-auto">
                    <div class="input-group search-area d-xl-inline-flex">
                        <div class="dropdown " style="width: 100%">
                            <a href="javascript:void(0)" :class="'btn-'+sort.class" class="btn btn-rounded " style="width: 100%" data-toggle="dropdown" aria-expanded="false">
                                <i class="las la-sort-amount-down-alt scale5"></i>

                                {{  sort.label }}
                                <i class="las la-angle-down "></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-center">
                                <a v-for="ticketSort in sorts" v-on:click="changeSort(ticketSort)" class="dropdown-item" href="javascript:void(0);"><span :class="'text-'+ticketSort.class">{{ ticketSort.label }}</span></a>
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
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Purpose</th>
                                    <th>Topic</th>
                                    <th>Content</th>
                                    <th>Created At</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="ticket in tickets.data">
                                    <td><strong>{{ ticket.id }}</strong></td>
                                    <td>{{ ticket.name }}</td>
                                    <td>{{ ticket.email }}</td>
                                    <td>{{ ticket.phone }}</td>
                                    <td>{{ ticket.purposeLabel }}</td>
                                    <td>{{ ticket.topic }}</td>
                                    <td>{{ ticket.content }}</td>
                                    <td>{{ moment(ticket.created_at).format('DD MMM YYYY, hh:mm A') }}</td>
                                    <td>
                                        <div class="dropdown" v-if="ticket.purpose === 6">
                                            <button type="button" class="btn btn-success light sharp" data-toggle="dropdown">
                                                <svg width="20px" height="20px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><circle fill="#000000" cx="5" cy="12" r="2"/><circle fill="#000000" cx="12" cy="12" r="2"/><circle fill="#000000" cx="19" cy="12" r="2"/></g></svg>
                                            </button>
                                           <div class="dropdown-menu">
                                               <a class="dropdown-item" :href="route('admin.tickets.edit', {ticket: ticket.id, page: page})">Show</a>
                                           </div>
                                        </div>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                        <pagination :limit="8" :data="tickets" :show-disabled="true" @pagination-change-page="fetchTickets">
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
    name: 'tickets-list',
    data: function () {
        return {
            'q' : '',
            'sort': { 'id' : 'tickets.created_at', 'direction': 'DESC', 'label' : 'Sort', 'class' : ''},
            'reason': { 'id' : 0, 'label' : 'All Reasons', 'class' : ''},
            'tickets' : {},
            'page' : 1,
            'reasons' : [],
            'sorts' : []
        }
    },
    created() {
        this.fetchTickets();
        this.fetchSorts();
        this.fetchReasons();
    },
    computed: {
    },
    methods: {
        fetchTickets(page = 1) {
            this.page = page;
            axios
                .get(route('api.tickets.index', {
                    page: page,
                    q : this.q,
                    sort : this.sort.id,
                    reason: this.reason,
                    direction : this.sort.direction,
                }))
                .then(response => {
                    this.tickets = response.data;
                });
        },
        fetchSorts() {
            this.sorts = {
                1: { 'id' : 'tickets.created_at', 'direction': 'DESC', 'label' : 'Created DESC', 'class' : 'dark'},
                2: { 'id' : 'tickets.created_at', 'direction': 'ASC', 'label' : 'Created ASC', 'class' : 'dark'},
            };
        },
        fetchReasons() {
            this.reasons = {
                0: { 'id' : 0, 'label' : 'All Reasons', 'class' : ''},
                1: { 'id' : 1, 'label' : 'Booking Issue', 'class' : ''},
                2: { 'id' : 2, 'label' : 'Doctor Issue', 'class' : 'primary'},
                3: { 'id' : 3, 'label' : 'Date Issue', 'class' : 'secondary'},
                4: { 'id' : 4, 'label' : 'Others', 'class' : 'secondary'},
            };
        },
        changeReason(reason) {
            this.reason = (reason !== undefined) ? this.reason = reason : '';
            this.fetchTickets();
        },
        changeSort(sort) {
            this.sort = (sort !== undefined) ? this.sort = sort : '';
            this.fetchTickets();
        },
    }
}
</script>
