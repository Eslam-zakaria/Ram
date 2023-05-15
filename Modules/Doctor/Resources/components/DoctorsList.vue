<template>
    <div class="row">
        <div class="table-filters col-md-12 mb-4">
            <div class="row">
                <div class="col-sm-6 col-md-3 mb-1">
                    <div class="input-group  search-area d-xl-inline-flex  mr-1" >
                        <input type="text" v-on:keyup.enter="fetchDoctors()" class="form-control" placeholder="Search here..." v-model="q">
                        <div class="input-group-append">
                            <span class="input-group-text">
                                <a href="javascript:void(0)" v-on:click="fetchDoctors()"><i class="flaticon-381-search-2"></i></a>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="col-md-1 col-sm-3 mb-1">
                    <div class="input-group  d-xl-inline-flex">
                        <a class="btn btn-success" :href="route('admin.doctors.create', {page: page})" title="New"><i class="la la-plus"></i></a>
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
                                <a v-for="doctorSort in sorts" v-on:click="changeSort(doctorSort)" class="dropdown-item" href="javascript:void(0);"><span :class="'text-'+doctorSort.class">{{ doctorSort.label }}</span></a>
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
                                    <th>Specialization</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="doctor in doctors.data">
                                    <td><strong>{{ doctor.id }}</strong></td>
                                    <td>{{ doctor.name }}</td>
                                    <td>{{ doctor.service.name}}</td>
                                    <td>
                                        <span v-bind:class="{ 'badge-success' : (doctor.status === 2) , 'badge-light' : (doctor.status === 1) }" class="badge">{{ doctor.statusLabel }}</span>
                                    </td>
                                    <td>{{ moment(doctor.created_at).format('DD MMM YYYY, hh:mm A') }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn btn-success light sharp" data-toggle="dropdown">
                                                <svg width="20px" height="20px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><circle fill="#000000" cx="5" cy="12" r="2"/><circle fill="#000000" cx="12" cy="12" r="2"/><circle fill="#000000" cx="19" cy="12" r="2"/></g></svg>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" :href="route('admin.doctors.edit', {doctor: doctor.id, page: page})">Edit</a>
                                                <a class="dropdown-item" :href="route('admin.doctors.enable', {doctor: doctor.id, page: page})">Enable</a>
                                                <a class="dropdown-item" :href="route('admin.doctors.disable', {doctor: doctor.id, page: page})">Disable</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                        <pagination :limit="8" :data="doctors" :show-disabled="true" @pagination-change-page="fetchDoctors">
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
    name: 'doctors-list',
    data: function () {
        return {
            'q' : '',
            'sort': { 'id' : 'doctors.created_at', 'direction': 'DESC', 'label' : 'Sort', 'class' : ''},
            'doctors' : {},
            'page' : 1,
            'sorts' : []
        }
    },
    created() {
        this.fetchDoctors();
        this.fetchSorts();
    },
    computed: {
    },
    methods: {
        fetchDoctors(page = 1) {
            this.page = page;
            axios
                .get(route('api.doctors.index', {
                    page: page,
                    q : this.q,
                    sort : this.sort.id,
                    direction : this.sort.direction,
                }))
                .then(response => {
                    this.doctors = response.data;
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
            this.fetchDoctors();
        },
    }
}
</script>
