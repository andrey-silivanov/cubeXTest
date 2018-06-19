<template>
    <vs-topbar vs-color="rgb(30, 199, 135)" id="topBar" ref="topBar">
        <h4>Test</h4>
        <a href="#" @click.prevent="$auth.logout()">
            <vs-button v-if="$auth.check()" vs-color-text="rgb(40, 40, 40)" vs-color="rgba(40, 40, 40)"
                       vs-type="dark-flat">
                Logout
            </vs-button>
        </a>
        <router-link :to="{name: 'admin'}" class="nav-link" active-class="active"> Admin  </router-link>
        <router-link :to="{name: 'home'}" class="nav-link" active-class="active"> Home </router-link>
    </vs-topbar>
</template>
<script type="text/babel">
    export default ({})
</script>
<style scoped>
    .vs-button-text{
        color: #232323!important
    }
</style>