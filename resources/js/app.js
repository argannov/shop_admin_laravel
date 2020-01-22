require('./bootstrap');

window.Vue = require('vue');


Vue.component('spinner', require('./components/spinner/Spinner.vue').default);
Vue.component('processing-spinner', require('./components/spinner/ProcessingSpinner.vue').default);
Vue.component('error-alert', require('./components/error/Error.vue').default);

Vue.component('search-admin', require('./components/search/SearchAdmin.vue').default);
Vue.component('search-box', require('./components/search/SearchBox.vue').default);

Vue.component('data-table', require('./components/table/table/DataTable.vue').default);
Vue.component('data-filter', require('./components/table/filter/DataFilter.vue').default);
Vue.component('text-field', require('./components/table/filter/fields/TextField.vue').default);
Vue.component('datetime', require('./components/table/filter/fields/DateTime.vue').default);
Vue.component('data-filter-select', require('./components/table/filter/fields/Select.vue').default);
Vue.component('date-range-picker', require('vue2-daterange-picker').default);
Vue.component('checkbox', require('./components/table/filter/fields/Checkbox.vue').default);
Vue.component('table-with-filter', require('./components/table/TableWithFilter.vue').default);

const app = new Vue({
    el: '#app',
});
