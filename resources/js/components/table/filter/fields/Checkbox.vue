<template>
    <div class="checkbox">
        <label>
            <input v-bind:name="name" type="checkbox"> {{ title }}
        </label>
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
            }
        }
    }
</script>
