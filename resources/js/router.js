import Vue from 'vue';
import VueRouter, {createRouter, createWebHistory} from "vue-router";
import Home from "./components/ExampleComponent.vue";
import About from "./components/TestComponent.vue";


const routes = [
    {
        path: "/",
        component: Home
    },
    {
        path: "/deals/create",
        component: About
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes
})

Vue.use(VueRouter)

export default router;
