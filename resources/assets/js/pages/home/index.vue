<template>
    <div>
        <h1> Welcome </h1>
        <li v-if="$auth.check()" class="pull-right">
            <a href="#" @click.prevent="$auth.logout()">Logout</a>
        </li>
    </div>

</template>
<script type="text/babel">
    export default ({

    })
</script>