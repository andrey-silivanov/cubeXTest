<template>
    <div id="app">
        <main :style="{height: windowHeight}">
            <transition name="page" mode="out-in">
            <router-view></router-view>
                </transition>
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
        }
    };
</script>
<style>
    #topBar {
        height: 50px;
    }
    .page-enter-active, .page-leave-active {
        transition: opacity 1s, transform 1s;
    }
    .page-enter, .page-leave-to {
        opacity: 0;
        transform: translate(0%);
        transition: width 0.1s linear 0.1s;
    }
</style>
