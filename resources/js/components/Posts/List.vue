<template>
    <article>
        <p>What has to be done?</p>
        <form
            class="add-form"
            action="./api/list_entries"
            method="POST"
            @submit.prevent="addNewTodo()"
        >
            <InputComponent v-model="newTodo.name" />
            <ButtonComponent :buttonName="buttonName" :disabled="isDisabled" />
            <!-- @submit.prevent="addNewTodo" -->
        </form>

        <div :class="[{ 'edit-field': editField }]">
            <span>Is Done?</span
            ><input
                type="checkbox"
                name=""
                :id="editTodo.id"
                @click="changeDone(editTodo.id)"
                v-model="editTodo.done"
            />
            <InputComponent v-model="editTodo.name" />
            <ButtonComponent
                :buttonName="SaveChange"
                @click="changeName(editTodo.id)"
            />
            <ButtonComponent :buttonName="Cancel" @click="cancel()" />
        </div>

        <div class="list-container">
            <ul class="todo-list">
                <li v-for="todo in todos" :key="todo.id">
                    <input
                        type="checkbox"
                        name=""
                        :id="todo.id"
                        @click="changeDone(todo.id)"
                        v-model="todo.done"
                    />
                    <span :class="[{ 'is-done': todo.done }]">{{
                        todo.name
                    }}</span>
                    <ButtonComponent
                        :buttonName="Edit"
                        class="edit-btn"
                        :id="todo.id"
                        @click="edit(todo.id)"
                    />
                    <ButtonComponent
                        :buttonName="Delete"
                        class="delete-btn"
                        :id="todo.id"
                        @click="deleteTodo(todo.id)"
                    />
                </li>
            </ul>
        </div>
    </article>
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
        this.getTodoList();
    },
    computed: {
        isDisabled() {
            return this.newTodo.name.length === 0;
        },
    },
    methods: {
        getTodoList() {
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

        axiosPut(id, updateItem) {
            axios
                .put(`todo/updateTodo/${id}`, updateItem)
                .then((response) => console.log(response.data));
            this.getTodoList();
        },

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
            this.getTodoList();
            this.newTodo.name = "";
        },

        edit(id) {
            this.editField = !this.editField;
            for (let item of this.todos) {
                if (id === item.id) {
                    this.editTodo.id = item.id;
                    this.editTodo.name = item.name;
                    this.editTodo.is_complete = item.is_complete;
                    this.editTodo.isDone = item.isDone;
                    this.editTodo.done = item.done;
                }
            }
        },

        cancel() {
            this.editField = true;
            this.editTodo = {};
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
                    this.axiosPut(id, this.updatedTodo);
                }
            }
        },
        changeName(id) {
            for (let item of this.todos) {
                if (id === item.id) {
                    item.name = this.editTodo.name;
                    this.axiosPut(id, item);
                }
            }
            this.cancel();
        },
        deleteTodo(id) {
            for (let item of this.todos) {
                if (
                    id === item.id &&
                    confirm("Soll dieser Eintrag gelöscht werden?")
                ) {
                    axios.delete(`todo/deleteTodo/${id}`).then((response) => {
                        console.log(response.data);
                    });
                    this.getTodoList();
                }
            }
        },
    },
};
</script>

<style>
:root {
    --background-color: #f3f4f6;
    --border-color: gray;
}

html {
    margin-block: 2rem;
}

article {
    margin-top: 3rem;
}

p,
.add-form {
    text-align: left;
    margin-inline: 3rem;
    padding-bottom: 1rem;
}

.edit-field {
    display: none;
}

.list-container {
    display: inline-block;
    border: solid var(--border-color) 0.5rem;
    border-radius: 0.5rem;
    margin: 3rem;
    padding: 0rem;

    background-color: var(--border-color);
}

.todo-list {
    max-width: 80rem;
    display: inline-block;
    border: solid var(--background-color) 0.5rem;
    background-color: var(--background-color);
    margin: 0rem;
    padding-block: 2rem;
    padding-inline: 1rem;
    border-radius: 0.5rem;
    list-style: none;
}

li {
    margin: 0.5rem;
    padding: 0.5rem;
    display: grid;
    grid-template-columns: 1fr 20fr 2fr 2fr;
    grid-gap: 0.5rem;
    align-items: center;

    border: solid lightgray 0.25rem;
}

span {
    text-align: left;
}

.edit-btn {
    background-color: darkgreen;
}

.delete-btn {
    background-color: darkred;
}

.is-done {
    text-decoration: line-through;
}

li:has(.is-done) {
    background-color: lightgreen;
}
</style>
