<template>
    <vs-topbar vs-color="rgb(30, 199, 135)" id="topBar" ref="topBar">
        <h4>Test</h4>

        <router-link v-if="$auth.user().role == 'manager'" :to="{name: 'admin'}" class="nav-link" active-class="active"> Messages  </router-link>
        <a href="#" @click.prevent="$auth.logout()">
            <vs-button v-if="$auth.check()" vs-color-text="rgb(40, 40, 40)" vs-color="rgba(40, 40, 40)"
                       vs-type="dark-flat">
                Logout
            </vs-button>
        </a>
    </vs-topbar>
</template>
<script type="text/babel">
    export default ({
    })
</script>
<style scoped>
    .vs-button-text{
        color: #232323!important
    }
    a {
        color: #ffffff
    }
</style>