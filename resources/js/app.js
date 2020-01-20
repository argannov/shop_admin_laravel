require('./bootstrap');

window.Vue = require('vue');

Vue.component('search-admin', require('./components/SearchAdmin.vue').default);
Vue.component('spinner', require('./components/Spinner.vue').default);
Vue.component('search-box', require('./components/SearchBox.vue').default);

const app = new Vue({
    el: '#app',
});
