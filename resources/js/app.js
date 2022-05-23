require('./bootstrap');
window.Vue = require('vue').default;

import Vue from "vue"


window.Vue = require('vue').default;
window.axios = require('axios');



Vue.prototype.$http = window.axios;



Vue.component('user-home', require('./components/user/Home.vue').default);
Vue.component('user-about', require('./components/user/About.vue').default);
Vue.component('user-contact', require('./components/user/Contact.vue').default);
Vue.component('user-category', require('./components/user/category.vue').default);

Vue.component('user-feedback', require('./components/user/temp/Feedback.vue').default);
Vue.component('user-searchpost', require('./components/user/temp/SearchPost.vue').default);

const app = new Vue({
}).$mount('#app')


