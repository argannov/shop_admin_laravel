<template>
    <div class="box box-default" v-bind:class="{'active': filterActive}">
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

                <div class="box-footer" v-bind:class="{'active_footer__transparent': filterActive, 'no-border': filterActive}">
                    <button type="submit" class="btn btn-primary">{{ applyText }}</button>
                    <button v-if="filterActive" type="reset" class="btn btn-default" v-on:click="reset($event)">{{ cancelText }}</button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    export default {
        name: "DataFilter",
        data: function () {
            return {
                filterActive: Boolean
            }
        },
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
            active: {
                type: Boolean,
                default: function () {
                    return false;
                }
            },
            settings: Object,
            route: String
        },
        created: function () {
            this.filterActive = this.settings.filter ? this.settings.filter.active : this.active;
        },
        methods: {
            submit: function (event) {
                this.$emit('data-filter-submit', event);
            },
            reset: function (event) {
                this.$emit('data-filter-reset', event);
            }
        }
    }
</script>

<style scoped>
    .active {
        background-color: #00a65a4d;
    }
    .active_footer__transparent {
        background: transparent;
    }
</style>
