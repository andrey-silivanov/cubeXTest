<template>
    <div class="page-wrapper" v-if="ready">
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
            ready: false,
            showForm: true,
            countdown: 0,
            colorLoading: '#2EC589',
            backgroundLoading: '#424242'
        }),
        components: {
            navBar,
            userForm,
            Countdown
        },
        created() {
            this.$vs.loading({
                background:this.backgroundLoading,
                color: this.colorLoading
            });
            this.checkMessage()
        },
        methods: {
            sendMessage(value) {
                this.countdown = value.time
                this.showForm = false
            },
            checkMessage() {
                this.$http.get('/message/check').then(
                        response => {
                            this.countdown = response.data.data.time;
                            if (this.countdown) this.showForm = false;
                            setTimeout( ()=> {
                                this.$vs.loading.close()
                                this.ready = true
                            }, 1000);
                        },
                        error => {
                        }
                )
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
