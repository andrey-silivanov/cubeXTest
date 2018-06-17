<template>
    <div id="app">
        <!--<navBar />-->
        <main>
            <router-view></router-view>
        </main>
    </div>
</template>
<script>
    import navBar from './components/navbar'
    export default {
        name: 'app',
        components: {
            navBar
        }
    };
</script>
