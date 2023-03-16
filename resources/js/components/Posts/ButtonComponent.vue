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

<style>
button {
    border-radius: 0.5rem;
    padding-block: 0.2rem;
    padding-inline: 0.3rem;
}
</style>
