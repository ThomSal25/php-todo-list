<template>
    <p>Hier entsteht eine Liste</p>
    <form
        action="./api/list_entries"
        method="POST"
        @submit.prevent="addNewTodo()"
    >
        <InputComponent v-model="text" />
        <ButtonComponent :buttonName="buttonName" :disabled="isDisabled" />
        <!-- @submit.prevent="addNewTodo" -->
    </form>

    <ul v-for="todo in todos" :key="todo.id">
        <li>{{ todo.name }}</li>
    </ul>
</template>

<script>
import ButtonComponent from "./ButtonComponent.vue";
import InputComponent from "./InputComponent.vue";
import axios from "axios";

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
        axios
            .get("todo/list")
            .then((response) => {
                this.todos = response.data;
            })
            .catch((error) => {
                console.log(error);
            });
    },
    computed: {
        isDisabled() {
            return this.text.length === 0;
        },
    },
    methods: {
        async addNewTodo() {
            axios.post("/todo/saveWithVue", this.text).then((response) => {
                console.log(response);
            });
        },
    },
};
</script>

<style></style>
