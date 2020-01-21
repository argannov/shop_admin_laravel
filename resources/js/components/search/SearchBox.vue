<template>
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">{{ title }}</h3>
            <h4 class="box-title" v-if="successful && filled">Всего найдено: {{ total }}</h4>
        </div>
        <div class="box-body" v-if="unfilled">
            <p>Ничего не найдено</p>
        </div>
        <div class="box-body" style="position: relative;">
            <processing-spinner v-if="processing"/>

            <spinner v-if="loading && !processing"/>

            <table class="table table-bordered" v-if="successful || processing">
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

            <error-alert v-if="unsuccessful" v-bind:message="errorMessage"/>
        </div>

        <div class="box-footer clearfix" v-if="(successful && filled && pages.length > 1) || processing">
            <ul class="pagination pagination-sm no-margin pull-right">
                <li><a href="#" v-on:click.prevent="leaf(text, 0, take)"
                       v-if="offset >= take">«</a>
                </li>
                <li>
                    <a href="#" v-for="page in pages"
                       v-bind:disabled="!page.current"
                       v-bind:class="{'label-primary': page.current}"
                       v-on:click="leaf(text, page.offset, take)">
                        {{ Math.round(page.number) }}
                    </a>
                </li>
                <li><a href="#" v-on:click.prevent="leaf(text, Number(total) - Number(take), take)"
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
                processing: false,
                result: [],
                total: 0,
                offset: 0,
                take: 4,
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
                        vm.processing = false;
                    })
                    .catch(function (error) {
                        vm.error = true;
                        vm.errorMessage = error;
                        vm.loading = false;
                        vm.processing = false;
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
                let pages = residualPages;

                let maxNumberOfPaginationButtons = 2;
                if (residualPages > maxNumberOfPaginationButtons) {
                    residualPages = maxNumberOfPaginationButtons;
                }

                this.pages = [];
                if (residualPages === 0) {
                    this.pages.push({number: currentPage - 2, offset: offset - take, current: false})
                }

                if (currentPage > 1) {
                    this.pages.push({number: currentPage - 1, offset: offset - take, current: false})
                }

                this.pages.push({number: currentPage, current: true});

                console.log(residualPages);

                for (let i = 0; i < residualPages; i++) {
                    this.pages.push({number: currentPage + (i + 1), offset: offset + take, current: false});
                    if (currentPage > 1) {
                        break;
                    }
                }
            },
            leaf: function (text, offset, take) {
                this.processing = true;
                this.fetchResult(text, offset, take);
            }
        }
    }
</script>
