<template>
    <button v-bind="$attrs" @click="$emit('clicked')">
        {{ buttonName }}
    </button>
</template>

<script>
export default {
    name: "ButtonComponent",
    inheritAttrs: false,
    props: {
        buttonName: String,
    },
};
</script>

<style></style>
