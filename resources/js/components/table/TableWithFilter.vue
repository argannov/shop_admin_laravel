<template>
    <div class="box">
        <data-filter
            v-bind:settings="settings"
            v-bind:route="route"
            v-on:data-filter-submit="applyFiltering($event)"
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
        created: function () {
            this.dataParams = this.params;
        },
        methods: {
            applyFiltering: function (event) {
                let elements = event.target.elements;
                let params = {};
                for (let element in elements) {
                    if (!elements.hasOwnProperty(element)) {
                        continue;
                    }
                    params[element.name] = element.value;
                }
                this.dataParams = params;
            }
        }
    }
</script>
