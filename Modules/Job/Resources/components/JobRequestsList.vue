<template>
    <div class="row">
        <div class="table-filters col-md-12 mb-4">
            <div class="row">
                <div class="col-sm-6 col-md-3 mb-1">
                    <div class="input-group  search-area d-xl-inline-flex  mr-1" >
                        <input type="text" v-on:keyup.enter="fetchLeads()" class="form-control" placeholder="Search here..." v-model="q">
                        <div class="input-group-append">
                            <span class="input-group-text">
                                <a href="javascript:void(0)" v-on:click="fetchLeads()"><i class="flaticon-381-search-2"></i></a>
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
                                <a v-for="jobRequestSort in sorts" v-on:click="changeSort(jobRequestSort)" class="dropdown-item" href="javascript:void(0);"><span :class="'text-'+jobRequestSort.class">{{ jobRequestSort.label }}</span></a>
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
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Job</th>
                                    <th>Notes</th>
                                    <th>Resume</th>
                                    <th>Created</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="jobRequest in jobRequests.data">
                                    <td><strong>{{ jobRequest.id }}</strong></td>
                                    <td>{{ jobRequest.name }}</td>
                                    <td>{{ jobRequest.phone}}</td>
                                    <td>{{ jobRequest.email }}</td>
                                    <td>{{ jobRequest.job.name }}</td>
                                    <td>{{ jobRequest.notes }}</td>
                                    <td>
                                        <a :href="jobRequest.resume" target="_blank">View file</a>
                                     </td>
                                    <td>{{ moment(jobRequest.created_at).format('DD MMM YYYY, hh:mm A') }}</td>
                                    <td>
<!--                                        <div class="dropdown">-->
<!--                                            <button type="button" class="btn btn-success light sharp" data-toggle="dropdown">-->
<!--                                                <svg width="20px" height="20px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><circle fill="#000000" cx="5" cy="12" r="2"/><circle fill="#000000" cx="12" cy="12" r="2"/><circle fill="#000000" cx="19" cy="12" r="2"/></g></svg>-->
<!--                                            </button>-->
<!--                                            <div class="dropdown-menu">-->
<!--&lt;!&ndash;                                                <a class="dropdown-item" :href="route('admin.job-requests.edit', {jobRequest: jobRequest.id, page: page})">Edit</a>&ndash;&gt;-->
<!--                                            </div>-->
<!--                                        </div>-->
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                        <pagination :limit="8" :data="jobRequests" :show-disabled="true" @pagination-change-page="fetchLeads">
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
    name: 'jobRequests-list',
    data: function () {
        return {
            'q' : '',
            'sort': { 'id' : 'created_at', 'direction': 'DESC', 'label' : 'Sort', 'class' : ''},
            'jobRequests' : {},
            'page' : 1,
            'sorts' : []
        }
    },
    created() {
        this.fetchLeads();
        this.fetchSorts();
    },
    computed: {
    },
    methods: {
        fetchLeads(page = 1) {
            this.page = page;
            axios
                .get(route('api.job.requests.index', {
                    page: page,
                    q : this.q,
                    sort : this.sort.id,
                    direction : this.sort.direction,
                }))
                .then(response => {
                    this.jobRequests = response.data;
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
            this.fetchLeads();
        },
    }
}
</script>
