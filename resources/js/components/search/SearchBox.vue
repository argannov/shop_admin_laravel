<template>
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">{{ title }}</h3>
            <h4 class="box-title" v-if="successful && filled">Всего найдено: {{ total }}</h4>
        </div>
        <div class="box-body" v-if="unfilled">
            <p>Ничего не найдено</p>
        </div>
        <div class="box-body">
            <spinner v-if="loading"/>

            <table class="table table-bordered" v-if="successful">
                <tbody>
                <tr v-for="item in result.data.items">
                    <td>
                        <p class="h4">
                            <a v-bind:href="item.link" v-html="item.title">
                            </a>
                        </p>
                        <p class="font-weight-normal" v-html="item.highlight">
                        </p>
                    </td>
                </tr>
                </tbody>
            </table>

            <div class="alert alert-danger  fade in" v-if="unsuccessful" v-html="errorMessage"></div>
        </div>

        <div class="box-footer clearfix" v-if="successful && filled && pages.length > 1">
            <ul class="pagination pagination-sm no-margin pull-right">
                <li><a href="#" v-on:click.prevent="fetchResult(text, parseInt(offset) - parseInt(take), take)"
                       v-if="offset >= take">«</a>
                </li>
                <li>
                    <a href="#" v-for="page in pages"
                       v-bind:disabled="!page.current"
                       v-bind:class="{'label-primary': page.current}"
                       v-on:click="fetchResult(text, page.offset, take)">
                        {{ page.number }}
                    </a>
                </li>
                <li><a href="#" v-on:click.prevent="fetchResult(text, parseInt(offset) + parseInt(take), take)"
                       v-if="offset < total - take">»</a>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
    export default {
        name: "SearchBox",
        data: function () {
            return {
                loading: true,
                result: [],
                total: 0,
                offset: 0,
                take: 10,
                pages: [],
                error: false,
                errorMessage: ''
            }
        },
        props: {
            title: String,
            route: String,
            text: String
        },
        computed: {
            successful: function () {
                return !this.loading && !this.error;
            },
            unsuccessful: function () {
                return !this.loading && this.error;
            },
            filled: function () {
                return !(this.successful && (this.result.data.items.length < 1));
            },
            unfilled: function () {
                return !this.filled;
            }
        },
        created() {
            this.fetchResult(this.text, this.offset, this.take);
        },
        methods: {
            fetchResult: function (text, offset, take) {
                this.loading = true;

                const vm = this;
                axios.get(this.url(text), {
                    params: {
                        offset: offset,
                        take: take
                    }
                })
                    .then(function (response) {
                        vm.result = response;
                        vm.initPagination(offset, take);
                        vm.loading = false;
                    })
                    .catch(function (error) {
                        vm.error = true;
                        vm.errorMessage = error;
                        vm.loading = false;
                    });
            },
            url: function (text) {
                return this.route + '/' + text;
            },
            initPagination: function (offset, take) {
                this.total = this.result.data.pagination.total;
                this.offset = this.result.data.pagination.offset;

                let currentPage = (this.offset / this.take) + 1;
                let residualPages = ((this.result.data.pagination.total - this.result.data.pagination.offset) / this.take) - 1;

                let maxNumberOfPaginationButtons = 2;
                if (residualPages > maxNumberOfPaginationButtons) {
                    residualPages = maxNumberOfPaginationButtons;
                }

                this.pages = [];
                if (currentPage > 1) {
                    this.pages.push({number: currentPage - 1, offset: offset - take, current: false})
                }
                this.pages.push({number: currentPage, current: true});

                for (let i = 0; i < residualPages; i++) {
                    this.pages.push({number: currentPage + (i + 1), offset: offset + take, current: false});
                    if (currentPage > 1) {
                        break;
                    }
                }
            }

        }
    }
</script>
