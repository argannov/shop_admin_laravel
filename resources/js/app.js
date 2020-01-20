require('./bootstrap');

window.Vue = require('vue');

Vue.component('search-admin', require('./components/search/SearchAdmin.vue').default);
Vue.component('spinner', require('./components/search/Spinner.vue').default);
Vue.component('search-box', require('./components/search/SearchBox.vue').default);

const app = new Vue({
    el: '#app',
});
