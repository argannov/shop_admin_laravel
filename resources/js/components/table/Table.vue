<template>
    <div class="box-body table-responsive no-padding">
        <table class="table table-hover">
            <tr>
                <th v-for="column in settings.columns">{{ column.title }}</th>
            </tr>

            <tr v-for="good in result.goods">
                <td>{{ good.id }}</td>
                <td><a v-bind:href="good.id">{{ good.title }}</a></td>
                <td>{{ good.updated_at }}</td>
                <td>
                    <span
                        v-bind:class="{'label-success': this.isPublished(good), 'label-warning': !this.isPublished(good)}">
                        {{ this.getMessage(good) }}
                    </span>
                </td>
                <td>{{ good.price }} ₽</td>
                <td>
                    <form v-bind:action="good.id" method="post">
                        <button type="submit" class="btn-danger"><span class="glyphicon glyphicon-trash"></span>
                        </button>
                        <!--csrf field-->
                    </form>
                </td>
            </tr>

        </table>
    </div>
</template>

<script>
    export default {
        name: "Table",
        data: function () {
            return {
                loading: true,
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
            route: String
        },
        created: function () {
            this.fetchResult();
        },
        methods: function () {
            return {
                fetchResult: function () {
                    this.loading = true;

                    let vm = this;
                    axios.get(this.route, {
                        params: settings.params
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
                }
            }
        }
    }
</script>

<style scoped>

</style>
