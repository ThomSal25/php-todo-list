<template>
    <p>Hier entsteht eine Liste</p>
    <form action="submit">
        <InputComponent v-model="text" />
        <ButtonComponent
            :buttonName="buttonName"
            @clicked="addNewTodo"
            :disabled="isDisabled"
        />
    </form>
</template>

<script>
import ButtonComponent from "./ButtonComponent.vue";
import InputComponent from "./InputComponent.vue";

export default {
    name: "List",
    components: {
        ButtonComponent,
        InputComponent,
    },
    data() {
        return {
            buttonName: "Add new todo",
            text: "",
            todos: [],
        };
    },
    async mounted() {
        const res = await fetch("http://127.0.0.1:8000");
        const jsonData = await res.json();
        return (this.todos = jsonData);
        // this.todos = await loadTodo();
    },
    computed: {
        isDisabled() {
            return this.text.length === 0;
        },
    },
};
</script>

<style></style>
