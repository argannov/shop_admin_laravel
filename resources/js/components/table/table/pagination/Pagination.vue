<template>
    <div class="box-footer clearfix" v-if="show">
        <ul class="pagination pagination-sm no-margin pull-right">
            <li>
                <a href="" v-on:click.prevent="leaf(1)">«</a>
            </li>
            <li v-for="(page, key) in paginationSettings.pages" v-if="page">
                <a href="#" v-on:click.prevent="leaf(page)" v-bind:class="{'label label-primary': key === 'current'}">
                    {{ page }}
                </a>
            </li>
            <li>
                <a href="#" v-on:click.prevent="leaf(paginationSettings.lastPage)">»</a>
            </li>
        </ul>
    </div>
</template>

<script>
    export default {
        name: "Pagination",
        props: {
            paginationSettings: {
                type: Object,
                default: function () {
                    return {};
                }
            }
        },
        computed: {
            show: function () {
                return this.paginationSettings.pages.previous || this.paginationSettings.pages.next;
            }
        },
        methods: {
            leaf: function (page) {
                this.$emit('pagination-leaf', page);
            }
        }
    }
</script>
