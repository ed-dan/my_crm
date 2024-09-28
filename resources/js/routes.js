
import Home from './components/ExampleComponent.vue';
import Hello from './components/HelloComponent.vue';
import NextStepComponent from './components/NextStepComponent.vue';
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

export default routes;
