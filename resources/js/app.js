/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

var moment = require('moment');

require('moment/locale/en-gb'); // locales all in lower-case

exports.install = function (Vue, options) {
    Vue.prototype.moment = function (...args) {
        return moment(...args);
    };

    Vue.prototype.route = function (...args) {
        return route(...args);
    };
}


window.Vue = require('vue');
window.NProgress = require('nprogress');

axios.interceptors.request.use(request => {
    NProgress.start()
    return request
})

axios.interceptors.response.use(response => {
    NProgress.done(true)
    return response
})

Vue.use(exports);

Vue.component('users-list', require('./components/UsersList.vue').default);
Vue.component('settings-list', require('../../Modules/Setting/Resources/components/SettingsList.vue').default);
Vue.component('doctors-list', require('../../Modules/Doctor/Resources/components/DoctorsList.vue').default);
Vue.component('services-list', require('../../Modules/Service/Resources/components/ServicesList.vue').default);
Vue.component('pages-list', require('../../Modules/Page/Resources/components/PagesList.vue').default);
Vue.component('branches-list', require('../../Modules/Branche/Resources/components/BranchesList.vue').default);
Vue.component('offers-list', require('../../Modules/Offer/Resources/components/OffersList.vue').default);
Vue.component('offer-branches-list', require('../../Modules/Offer/Resources/components/OfferBranchesList.vue').default);
Vue.component('offer-bookings-list', require('../../Modules/Offer/Resources/components/OfferBookingsList.vue').default);
Vue.component('leads-list', require('../../Modules/Lead/Resources/components/LeadsList.vue').default);
Vue.component('bookings-list', require('../../Modules/Booking/Resources/components/BookingsList.vue').default);
Vue.component('countries-list', require('../../Modules/Country/Resources/components/CountriesList.vue').default);
Vue.component('specificities-list', require('../../Modules/Specificity/Resources/components/SpecificitiesList.vue').default);
Vue.component('categories-list', require('../../Modules/Specificity/Resources/components/CategoriesList.vue').default);
Vue.component('blog-categories-list', require('../../Modules/Blog/Resources/components/BlogCategoriesList.vue').default);
Vue.component('blogs-list', require('../../Modules/Blog/Resources/components/BlogsList.vue').default);
Vue.component('comments-list', require('../../Modules/Comment/Resources/components/CommentsList.vue').default);
Vue.component('tickets-list', require('../../Modules/Ticket/Resources/components/TicketsList.vue').default);
Vue.component('partners-list', require('../../Modules/Partner/Resources/components/PartnersList.vue').default);
Vue.component('sliders-list', require('../../Modules/Slider/Resources/components/SlidersList.vue').default);
Vue.component('departments-list', require('../../Modules/Department/Resources/components/DepartmentsList.vue').default);
Vue.component('jobs-list', require('../../Modules/Job/Resources/components/JobsList.vue').default);
Vue.component('testimonials-list', require('../../Modules/Testimonial/Resources/components/TestimonialsList.vue').default);
Vue.component('job-requests-list', require('../../Modules/Job/Resources/components/JobRequestsList.vue').default);
Vue.component('videos-list', require('../../Modules/Video/Resources/components/VideosList.vue').default);
Vue.component('discounts-list', require('../../Modules/Discount/Resources/components/DiscountsList.vue').default);
Vue.component('discount-categories-list', require('../../Modules/Discount/Resources/components/DiscountCategoriesList.vue').default);
Vue.component('discount-bookings-list', require('../../Modules/Discount/Resources/components/DiscountBookingsList.vue').default);
Vue.component('cards-list', require('../../Modules/Discount/Resources/components/CardsList.vue').default);
Vue.component('casing-list', require('../../Modules/Casing/Resources/components/CasingList.vue').default);
Vue.component('casing-categories-list', require('../../Modules/Casing/Resources/components/CasingCategoriesList.vue').default);
Vue.component('pagination', require('laravel-vue-pagination'));


Vue.use(exports);

const app = new Vue({
    delimiters: ['{(', ')}'],
    el: '#app'
});
