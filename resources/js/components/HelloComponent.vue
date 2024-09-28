<script setup>
import { ref, computed } from 'vue'
import Home from './ExampleComponent.vue'
import About from './TestComponent.vue'


const routes = {
    '/': Home,
    '/deals/create': About
}

const currentPath = ref(window.location.hash)

window.addEventListener('hashchange', () => {
    currentPath.value = window.location.hash
})

const currentView = computed(() => {
    return routes[currentPath.value.slice(1) || '/']
})
</script>

<template>
    <div>
        <router-link :to="{name:'example'}">Home</router-link>
        <router-link to="/deals/create">Create</router-link>
    </div>
    <router-view></router-view>
    <a href="#/">Home</a> |
    <a href="#/deals/create">About</a> |
    <component :is="currentView" />
</template>
