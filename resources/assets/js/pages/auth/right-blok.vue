<template>
    <div class="right-block">
        <transition name="fadeOne">
            <div v-show="show" class="container">
                <p class="One">Test</p>
            </div>
        </transition>
        <transition name="fadeTwo">
            <div v-show="show" class="container">
                <p class="Two">Test web application</p>
            </div>
        </transition>
    </div>
</template>
<script type="text/babel">
    export default ({
        data: () => ({
            show: false
        }),
        created() {
            setTimeout(() => {
                this.show = true
            }, 1500)
        }
    })
</script>
<style>
    .right-block {
        display: block;
    }
    .container {
        clip-path: polygon(0% 0%, 100% 0%, 100% 100%, 0% 100%);
    }

    p {
        display: block;
        text-align: center;
        font-size: 50px;
        font-smoothing: antialiased;
        overflow: hidden;
        color: #4DBA87;
        margin: 1px;
    }

    .Two {
        font-size: 18px;
        font-family: Georgia, serif;
    }

    .fadeOne-enter-active, .fadeOne-leave-active {
        transition: all .5s ease-out;
    }
    .fadeOne-enter, .fadeOne-leave-to {
        clip-path: polygon(0% 0%, 100% 0%, 100% 0%, 0% 0%);
        transform: translate(0%, 100%);
    }

    .fadeTwo-enter-active, .fadeTwo-leave-active {
        transition: all .5s ease-out;
    }
    .fadeTwo-enter, .fadeTwo-leave-to {
        clip-path: polygon(0% 100%, 100% 100%, 0% 100%, 0% 100%);
        transform: translate(0%, -100%);
    }
</style>