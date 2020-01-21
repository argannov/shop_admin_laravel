<template>
    <div class="alert alert-danger  fade in" v-html="message"></div>
</template>

<script>
    export default {
        name: "Error",
        props: {
            error: {
                type: String,
                default: function () {
                    return '';
                }
            }
        }
    }
</script>
