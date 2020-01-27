<template>
    <div class="alert alert-danger  fade in" v-html="message"></div>
</template>

<script>
    export default {
        name: "Error",
        props: {
            message: {
                default: function () {
                    return '';
                }
            }
        }
    }
</script>
