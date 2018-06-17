<template>
    <div class="auth-wrapper" :style="{height: windowHeight}">
        <vs-row vs-align="center" vs-type="flex">
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
        data: () => ({
            windowHeight: 0
        }),
        components: {
            rightBlock
        },
        created() {
            this.windowHeight = `${window.innerHeight}px`
        }
    })
</script>
<style lang="scss">
    $primaryColor: #1EC787;
    .auth-wrapper {
        display: flex;
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