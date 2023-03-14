<template>
    <p>Hier entsteht eine Liste</p>
    <form
        action="./api/list_entries"
        method="POST"
        @submit.prevent="addNewTodo()"
    >
        <InputComponent v-model="newTodo.name" />
        <ButtonComponent :buttonName="buttonName" :disabled="isDisabled" />
        <!-- @submit.prevent="addNewTodo" -->
    </form>

    <div :class="[{ 'edit-field': editField }]">
        <!-- <input
            type="checkbox"
            name=""
            :id="todo.id"
            @click="changeDone(todo.id)"
            v-model="todo.done"
        /> -->
        <InputComponent v-model="editTodo.name" />
        <ButtonComponent :buttonName="SaveChange" />
        <ButtonComponent :buttonName="Cancel" @click="cancel()" />
    </div>

    <ul>
        <li
            v-for="todo in todos"
            :key="todo.id"
            :class="[{ 'is-done': todo.done }]"
        >
            <input
                type="checkbox"
                name=""
                :id="todo.id"
                @click="changeDone(todo.id)"
                v-model="todo.done"
            />
            {{ todo.name }}
            <ButtonComponent
                :buttonName="Edit"
                :id="todo.id"
                @click="edit(todo.id)"
            />
            <ButtonComponent :buttonName="Delete" />
        </li>
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
            newTodo: {
                name: "",
                is_complete: "",
                isDone: "",
            },
            Edit: "Edit",
            Delete: "Delete",
            editField: true,
            SaveChange: "Save Change",
            Cancel: "Cancel",
            editTodo: {
                name: "",
                is_complete: "",
                isDone: "",
            },
            updatedTodo: {},
        };
    },
    async mounted() {
        axios
            .get("todo/list")
            .then((response) => {
                this.todos = response.data;
                for (let item of this.todos) {
                    if (item.is_complete === 1) {
                        item.done = true;
                    } else {
                        item.done = false;
                    }
                }
            })
            .catch((error) => {
                console.log(error);
            });
    },
    computed: {
        isDisabled() {
            return this.newTodo.name.length === 0;
        },
    },
    methods: {
        async addNewTodo() {
            this.newTodo.is_complete = 0;
            this.newTodo.isDone = 0;
            axios
                .post("/todo/saveWithVue", this.newTodo)
                .then((response) => {
                    console.log(response);
                })
                .catch((error) => {
                    console.log(error);
                });
            axios
                .get("todo/list")
                .then((response) => {
                    this.todos = response.data;
                })
                .catch((error) => {
                    console.log(error);
                });
            this.newTodo.name = "";
        },
        edit(id) {
            this.editField = false;
            for (let item of this.todos) {
                if (id === item.id) {
                    this.editTodo.name = item.name;
                    this.editTodo.is_complete = item.is_complete;
                    this.editTodo.isDone = item.isDone;
                }
            }
        },
        cancel() {
            this.editField = true;
            this.editTodo.name = "";
            this.editTodo.is_complete = "";
            this.editTodo.isDone = "";
        },
        changeDone(id) {
            for (let item of this.todos) {
                if (id === item.id) {
                    if (item.done === false) {
                        item.done === true;
                        this.updatedTodo = {
                            name: item.name,
                            is_complete: 1,
                            isDone: 1,
                        };
                    } else {
                        item.done === false;
                        this.updatedTodo = {
                            name: item.name,
                            is_complete: 0,
                            isDone: 0,
                        };
                    }
                    axios
                        .patch("todo/updateTodo/" + id, {
                            data: this.updatedTodo,
                        })
                        .then((response) => {
                            console.log(response);
                        })
                        .catch((error) => {
                            console.log(error);
                        });
                }
            }
        },
    },
};
</script>

<style>
.edit-field {
    display: none;
}

ul {
    list-style: none;
}

.is-done {
    text-decoration: line-through;
}
</style>
