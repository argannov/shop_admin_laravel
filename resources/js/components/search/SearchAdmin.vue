<template>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <h3></h3>
            </div>
        </div>
        <search-box title="Товары" v-bind:route="this.generateRoute('goods')" v-bind:text="text"/>
        <search-box title="Заказы" v-bind:route="this.generateRoute('orders')" v-bind:text="text"/>
        <search-box title="Статьи" v-bind:route="this.generateRoute('posts')" v-bind:text="text"/>
        <search-box title="Магазины" v-bind:route="this.generateRoute('store')" v-bind:text="text"/>
    </section>
</template>

<script>
    export default {
        name: "SearchAdmin",
        props: {
            text: String,
            route: String
        },
        methods: {
            generateRoute: function (postfix) {
                return this.route + '/of/' + postfix;
            }
        }
    }
</script>
