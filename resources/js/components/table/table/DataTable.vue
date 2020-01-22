<template>
    <div class="box-body table-responsive no-padding" style="position: relative;">
        <processing-spinner v-if="processing"/>

        <spinner v-if="loading"/>


        <div class="box-body" v-if="successful && unfilled">
            <p>Ничего не найдено</p>
        </div>

        <table class="table table-hover" v-if="successful && filled">
            <tbody>
            <tr>
                <th v-if="settings" v-for="column in settings.columns">{{ column.title }}</th>
            </tr>

            <tr v-for="(good, index) in result.goods">
                <td>{{ good.id }}</td>
                <td><a v-bind:href="edit(good.id)">{{ good.title }}</a></td>
                <td>{{ good.updated_at }}</td>
                <td>
                        <span
                            v-bind:class="[{'label-success': isPublished(good), 'label-warning': !isPublished(good)}, 'label']">
                            {{ getMessage(good) }}
                        </span>
                </td>
                <td>{{ good.price }} ₽</td>
                <td>
                    <form v-on:submit.prevent="remove(good.id, index)">
                        <button type="submit" class="btn btn-danger">
                            <span class="glyphicon glyphicon-trash"></span>
                        </button>
                    </form>
                </td>
            </tr>
            </tbody>
        </table>

        <error-alert v-if="unsuccessful" v-bind:message="errorMessage"/>
    </div>
</template>

<script>
    export default {
        name: "DataTable",
        data: function () {
            return {
                loading: true,
                processing: false,
                result: [],
                total: 0,
                offset: 0,
                take: 10,
                error: false,
                errorMessage: ''
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
            csrfToken: String,
        },
        watch: {
            params: {
                handler: function () {
                    this.applyFiltering();
                }
            }
        },
        computed: {
            successful: function () {
                return !this.loading && !this.error;
            },
            unsuccessful: function () {
                return !this.loading && this.error;
            },
            filled: function () {
                return this.successful && this.result.count > 0;
            },
            unfilled: function () {
                return !this.filled;
            }
        },
        created: function () {
            this.fetchResult();
        },
        methods: {
            fetchResult: function () {
                let vm = this;
                axios.get(this.route, {
                    params: vm.params
                })
                    .then(function (response) {
                        vm.result = response.data;
                        vm.loading = false;
                    })
                    .catch(function (error) {
                        vm.error = true;
                        vm.errorMessage = error;
                        vm.loading = false;
                    });
            },
            isPublished: function (good) {
                return good.status === 'published';
            },
            getMessage: function (good) {
                return this.isPublished(good) ? 'Активен' : 'Черновик';
            },
            edit: function (slug) {
                return this.editRoute + '/' + slug;
            },
            remove: function (slug, index) {
                if (!confirm('Вы уверены, что хотите удалить запись?')) {
                    return;
                }

                this.processing = true;

                let vm = this;
                if (!vm.params) {
                    vm.params = {};
                }
                vm.params._token = vm.csrfToken;
                axios.post(this.deleteRoute + '/' + slug, vm.params)
                    .then(function () {
                        vm.result.goods.splice(index, 1);
                        vm.processing = false;
                    })
                    .catch(function (error) {
                        alert(error);
                        vm.processing = false;
                    });
            },
            applyFiltering: function () {
                this.processing = true;
                this.fetchResult();
            }
        }
    }
</script>
