<template>
    <div class="box">
        <data-filter
            v-bind:settings="settings"
            v-bind:route="route"
            v-bind:active="filterActive"
            v-on:data-filter-submit="applyFiltering($event)"
            v-on:data-filter-reset="resetFiltering($event)"
        />
        <data-table
            v-bind:settings="settings"
            v-bind:params="dataParams"
            v-bind:route="route"
            v-bind:edit-route="editRoute"
            v-bind:delete-route="deleteRoute"
            v-bind:csrf-token="csrfToken"
        />
    </div>
</template>

<script>
    export default {
        name: "TableWithFilter",
        data: function () {
            return {
                dataParams: Object
            }
        },
        props: {
            settings: Object,
            params: {
                type: Object,
                default: function () {
                    return {};
                }
            },
            route: String,
            editRoute: String,
            deleteRoute: String,
            csrfToken: String
        },
        computed: {
            filterActive: function () {
                return Object.keys(this.dataParams).length > 0;
            }
        },
        created: function () {
            this.dataParams = (this.settings.filter && this.settings.filter.params && Object.keys(this.settings.filter.params).length > 0) ?
                this.settings.filter.params : this.params;
        },
        methods: {
            applyFiltering: function () {
                let elements = event.target.elements;
                let params = {};
                for (let i = 0; i < elements.length; i++) {
                    if (!elements[i].value) {
                        continue;
                    }
                    params[elements[i].name] = elements[i].value;
                }
                this.dataParams = params;
            },
            resetFiltering: function ($event) {
                this.dataParams = {};
            },
            onSuccess: function ($event) {
                if (!Object.keys(this.dataParams).length) {
                    this.filterActive = false;
                    return;
                }

                this.filterActive = true;
            }
        }
    }
</script>
