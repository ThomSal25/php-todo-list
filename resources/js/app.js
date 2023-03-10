import { createApp } from "vue";
import App from "./App.vue";
import user from "./components/Posts/user.vue";

const app = createApp(App);
app.component("user", user);
app.mount("#app");
