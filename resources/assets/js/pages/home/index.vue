<template>
    <div class="home-wrapper">
        <navBar/>
        <vs-row class="full-height" v-if="showForm">
            <userForm/>
        </vs-row>

        <countdown v-if="!showForm" date="2018-06-18 08:15:00"></countdown>

    </div>

</template>
<script type="text/babel">

    import Countdown from './components/countdown'
    import userForm from './components/form'
    import navBar from './../../components/navbar'
    export default ({
        data: () => ({
            showForm: true,
        }),
        components: {
            navBar,
            userForm,
            Countdown
        }
    })
</script>
<style>
    .full-height {
        height: 100%;
    }

    .home-wrapper {
        background: #232323;
        height: 100%;
    }

    .vs-card {
        background: #ffffff;
    }

    .form-wrapper {
        width: 100%;
    }
</style>