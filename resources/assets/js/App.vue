<template>
    <div id="app">
        <main :style="{height: windowHeight}">
            <router-view></router-view>
        </main>
    </div>
</template>
<script type="text/babel">
    export default {
        name: 'app',
        data: () => ({
            windowHeight: 0
        }),
        created() {
            this.windowHeight = `${(window.innerHeight)}px`
        },
        mounted() {
            console.log('asds');
            console.info('App :', this.$route)
        }
    };
</script>
<style>
    #topBar {
        height: 50px;
    }
</style>
