<template>
    <strong>Current route path:</strong> {{ $route.fullPath }}

    <nav class="main-header navbar navbar-expand navbar-dark">


        <ul>
            <li>
                <RouterLink to="/">HOME</RouterLink>
            </li>
            <li><RouterLink to="/deals/create">Dela</RouterLink></li>
            <li>1223</li>
        </ul>
    </nav>



    <div class="p-5">
        hello world
        123
        <div>
            12123
        </div>
    </div>
</template>

<script>

export default {
    name: "App"
}
</script>

<style scoped>

</style>
