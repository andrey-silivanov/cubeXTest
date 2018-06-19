<template>
    <div class="auth-wrapper full-height">
        <vs-row vs-align="center" vs-type="flex" class="full-height">
            <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-w="6">
                <router-view></router-view>
            </vs-col>

            <vs-col vs-type="flex" class="wrapper-right-block" vs-color="dark" vs-justify="center" vs-align="center"
                    vs-w="6">
                <right-block/>
            </vs-col>

        </vs-row>
    </div>
</template>

<script type="text/babel">
    import rightBlock from './right-blok';

    export default ({
        components: {
            rightBlock
        }
    })
</script>
<style lang="scss">
    $primaryColor: #1EC787;
    .auth-wrapper {
        display: flex;
        height: 100%;
    }
    .centerx {
        width: 50%;
    }
    .action-block {
    button {
        background: $primaryColor;
        border-radius: 25px;
        width: 100%;
    }
    a {
        color: $primaryColor;
        float: right;
    }
    }
    .wrapper-right-block {
        background: #232323;
        height: 100%;
    }

    h3 {
        text-align: center;
    }
</style>