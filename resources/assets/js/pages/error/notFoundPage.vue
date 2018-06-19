<template>
    <div class="auth-wrapper" :style="{height: windowHeight}">
        <vs-row vs-align="center" vs-type="flex" style="height: 100%">
            <vs-col vs-type="flex" vs-justify="center" vs-align="center">
                <div class="not-found-page">
                    <transition name="fadeOne">
                        <div v-show="show" class="container">
                            <p class="One">404</p>
                        </div>
                    </transition>
                    <transition name="fadeTwo">
                        <div v-show="show" class="container">
                            <p class="Two">Page not found</p>
                        </div>
                    </transition>
                </div>
            </vs-col>
        </vs-row>
    </div>

</template>
<script type="text/babel">
    export default ({
        data: () => ({
            show: false,
            windowHeight: 0
        }),
        created() {

            this.windowHeight = `${window.innerHeight}px`;

            setTimeout(() => {
                this.show = true
            }, 1000)
        }
    })
</script>
<style scoped>
    .not-found-page {
        display: block;
    }
    .auth-wrapper {
        display: block;
        background: #232323;;
    }

    .container {
        clip-path: polygon(0% 0%, 100% 0%, 100% 100%, 0% 100%);
    }

    p {
        display: block;
        text-align: center;
        font-size: 150px;
        font-smoothing: antialiased;
        overflow: hidden;
        color: #4DBA87;
        margin: 1px;
    }

    .Two {
        font-size: 30px;
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