<template>
    <div class="row">
        <div class="table-filters col-md-12 mb-4">
            <div class="row">
                <div class="col-sm-6 col-md-3 mb-1">
                    <div class="input-group  search-area d-xl-inline-flex  mr-1" >
                        <input type="text" v-on:keyup.enter="fetchServices()" class="form-control" placeholder="Search here..." v-model="q">
                        <div class="input-group-append">
                            <span class="input-group-text">
                                <a href="javascript:void(0)" v-on:click="fetchServices()"><i class="flaticon-381-search-2"></i></a>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="col-md-1 col-sm-3 mb-1">
                    <div class="input-group  d-xl-inline-flex">
                        <a class="btn btn-success" :href="route('admin.services.create', {page: page})" title="New"><i class="la la-plus"></i></a>
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
                                <a v-for="serviceSort in sorts" v-on:click="changeSort(serviceSort)" class="dropdown-item" href="javascript:void(0);"><span :class="'text-'+serviceSort.class">{{ serviceSort.label }}</span></a>
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
                                    <th>image</th>
                                    <th>Name</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="service in services.data">
                                    <td><strong>{{ service.id }}</strong></td>
                                    <td><a :href="service.image" data-toggle="lightbox"><img class="p-4 width200" :src="service.image"/></a></td>
                                    <td>{{ service.name }}</td>
                                    <td>
                                        <span v-bind:class="{ 'badge-success' : (service.status === 2) , 'badge-light' : (service.status === 1) }" class="badge">{{ service.statusLabel }}</span>
                                    </td>
                                    <td>{{ moment(service.created_at).format('DD MMM YYYY, hh:mm A') }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn btn-success light sharp" data-toggle="dropdown">
                                                <svg width="20px" height="20px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><circle fill="#000000" cx="5" cy="12" r="2"/><circle fill="#000000" cx="12" cy="12" r="2"/><circle fill="#000000" cx="19" cy="12" r="2"/></g></svg>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" :href="route('admin.services.edit', {service: service.id, page: page})">Edit</a>
                                                <a class="dropdown-item" :href="route('admin.services.enable', {service: service.id, page: page})">Enable</a>
                                                <a class="dropdown-item" :href="route('admin.services.disable', {service: service.id, page: page})">Disable</a>
                                                <a class="dropdown-item" :href="route('admin.services.delete', {service: service.id, page: page})" onclick="return confirm('Are you sure you want to delete this item?');">Delete</a>

                                            </div>
                                        </div>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                        <pagination :limit="8" :data="services" :show-disabled="true" @pagination-change-page="fetchServices">
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
    name: 'services-list',
    data: function () {
        return {
            'q' : '',
            'sort': { 'id' : 'created_at', 'direction': 'DESC', 'label' : 'Sort', 'class' : ''},
            'services' : {},
            'page' : 1,
            'sorts' : []
        }
    },
    created() {
        this.fetchServices();
        this.fetchSorts();
    },
    computed: {
    },
    methods: {
        fetchServices(page = 1) {
            this.page = page;
            axios
                .get(route('api.services.index', {
                    page: page,
                    q : this.q,
                    sort : this.sort.id,
                    direction : this.sort.direction,
                }))
                .then(response => {
                    this.services = response.data;
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
            this.fetchServices();
        },
    }
}
</script>
