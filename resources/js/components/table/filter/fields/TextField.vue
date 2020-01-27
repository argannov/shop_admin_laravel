<template>
    <div class="form-group">
        <label v-bind:for="title">{{ title }}</label>
        <input v-bind:name="name"
               v-bind:type="type"
               class="form-control"
               v-bind:id="name"
               v-bind:placeholder="title"
               v-bind:value="defaultValue"
        >
    </div>
</template>

<script>
    export default {
        name: "TextField",
        props: {
            title: {
                type: String,
                default: function () {
                    return '';
                }
            },
            name: {
                type: String,
                default: function () {
                    return '';
                }
            },
            type: {
                type: String,
                default: function () {
                    return '';
                }
            },
            value: {
                type: String,
                default: function () {
                    return '';
                }
            }
        },
        computed: {
            defaultValue: function () {
                return this.value ? this.value : '';
            }
        }
    }
</script>
