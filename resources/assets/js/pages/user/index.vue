<template>
    <div class="page-wrapper">
        <navBar/>
        <transition name="page" mode="out-in">
        <userForm
                v-if="showForm"
                @sendMessage="sendMessage"
        />

        <countdown v-if="!showForm" :date="countdown"></countdown>
        </transition>
    </div>

</template>
<script type="text/babel">

    import Countdown from './components/countdown'
    import userForm from './components/form'
    import navBar from './../../components/navbar'
    export default ({
        data: () => ({
            showForm: true,
            countdown: 0
        }),
        components: {
            navBar,
            userForm,
            Countdown
        },
        methods: {
            sendMessage(value) {
                this.countdown = value.time
                this.showForm = false
            }
        }
    })
</script>
<style scoped>
    .page-enter-active, .page-leave-active {
        transition: opacity 0.5s, transform 0.6s;
    }
    .page-enter, .page-leave-to {
        opacity: 0;
        transform: translate(0%);
        transition: width 0.1s linear 0.09s;
    }
</style>
