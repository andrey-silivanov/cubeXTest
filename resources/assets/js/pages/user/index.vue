<template>
    <div class="page-wrapper">
        <navBar/>

        <userForm
                v-if="showForm"
                @sendMessage="sendMessage"
        />

        <countdown v-if="!showForm" :date="countdown"></countdown>

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
