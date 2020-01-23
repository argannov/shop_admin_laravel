<template>
    <div class="form-group" data-select2-id="27" v-if="elements">
        <label>{{ title }}</label>
        <select class="form-control select2 select2-hidden-accessible"
                style="width: 100%;"
                data-select2-id="1"
                tabindex="-1"
                aria-hidden="true"
                v-bind:name="name"
        >
            <option></option>
            <option v-for="(element, key) in elements" v-bind:value="key" v-bind:selected="key === value">{{ element }}</option>
        </select>
    </div>
</template>

<script>
    export default {
        name: "Select",
        props: {
            elements: {
                type: Object,
                default: function () {
                    return {};
                }
            },
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
            value: {
                type: String,
                default: function () {
                    return '';
                }
            }
        }
    }
</script>
