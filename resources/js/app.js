import { createApp } from "vue";
import App from "./App.vue";
import user from "./components/Posts/user.vue";

import GuestView from "./GuestView.vue";
import guest from "./components/Posts/guest.vue";

const app = createApp(App);
app.component("user", user);
app.mount("#app");

const guestView = createApp(GuestView);
guestView.component("guest", guest);
guestView.mount("#guestView");
