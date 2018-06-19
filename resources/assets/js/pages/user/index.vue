<template>
    <div class="page-wrapper">
        <navBar/>

            <userForm/>

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
