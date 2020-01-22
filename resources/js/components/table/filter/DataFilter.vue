<template>
    <div class="box-header">
        <h3 class="box-title">Фильтр</h3>
        <form role="form" v-on:submit.prevent="submit($event)">
            <div class="box-body">
                <div class="form-group">
                    <label for="title">Название</label>
                    <input name="title" type="text" class="form-control" id="title" placeholder="Название">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                </div>
                <div class="form-group">
                    <label for="exampleInputFile">File input</label>
                    <input type="file" id="exampleInputFile">

                    <p class="help-block">Example block-level help text here.</p>
                </div>
                <div class="checkbox">
                    <label>
                        <input type="checkbox"> Check me out
                    </label>
                </div>
            </div>

            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
</template>

<script>
    export default {
        name: "DataFilter",
        props: {
            settings: Object,
            route: String
        },
        methods: {
            submit: function (event) {
                this.$emit('data-filter-submit', event);
            }
        }
    }
</script>
