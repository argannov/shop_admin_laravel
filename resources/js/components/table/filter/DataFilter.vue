<template>
    <div class="box box-default">
        <div class="box-header" v-if="settings">
            <h3 class="box-title">{{ title }}</h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="box-body">
            <form role="form" v-on:submit.prevent="submit($event)">
                <div class="box-body">

                    <component
                        v-for="column in settings.columns"
                        v-if="column.field"
                        v-bind:is="column.field.component"
                        v-bind:title="column.title"
                        v-bind:name="column.field.name"
                        v-bind:type="column.field.type"
                        v-bind:elements="column.field.elements"
                    />

                </div>

                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">{{ applyText }}</button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    export default {
        name: "DataFilter",
        props: {
            title: {
                type: String,
                default: function () {
                    return 'Фильтр';
                }
            },
            applyText: {
                type: String,
                default: function () {
                    return 'Применить';
                }
            },
            cancelText: {
                type: String,
                default: function () {
                    return 'Сбросить';
                }
            },
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
