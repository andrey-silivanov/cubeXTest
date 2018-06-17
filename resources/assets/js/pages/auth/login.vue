<template>
    <div class="centerx">
        <h3>Welcome</h3>

        <vs-row>
            <vs-input class="auth-input"
                    :vs-valid.sync="validos.email"
                    vs-success-text="Correo Valido"
                    vs-danger-text="The email does not meet the requirements"
                    vs-type="email" vs-label-placeholder="Email" v-model="email"/>
            <vs-alert vs-active="true" vs-color="danger" v-if="errors.email">
                <span v-for="error in errors.email[0]"> {{ error }}</span>
            </vs-alert>
        </vs-row>
        </vs-row>
        <vs-row>
        <vs-input class="auth-input"
                :vs-valid.sync="validos.password"
                vs-success-text="Field is valid"
                vs-danger-text="Field must have at least 5 characters"
                :vs-validation-function="(value) => value.length > 5"
                vs-type="password" vs-label-placeholder="Password" v-model="password"/>
        <vs-alert vs-active="true" vs-color="danger" v-if="errors.password">
            <span v-for="error in errors.password[0]"> {{ error }}</span>
        </vs-alert>
        </vs-row>

        <vs-row vs-align="center" vs-type="flex" class="action-block">
            <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-w="6">
                <vs-button vs-color="success" @click="send" vs-type="filled">Login</vs-button>
            </vs-col>
            <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-w="6">
                <router-link :to="{name: 'register'}" class="nav-link" active-class="active"> Create account
                </router-link>
            </vs-col>
        </vs-row>

    </div>
</template>
<script type="text/babel">

    export default ({
        data: () => ({
            email: '',
            password: '',
            validos: {
                email: false,
                password: false
            },
            errors: {}
        }),
        methods: {
            send () {
                this.login()
            },
            login() {
                this.errors = {}
                this.$auth.login({
                    params: {
                        email: this.email,
                        password: this.password
                    },
                    success () {},
                    error(err) {
                        this.errors = err.response.data.errors;
                    },
                    rememberMe: true,
                    redirect: '/home',
                    fetchUser: true,
                });
            }
        }
    })
</script>

<style scoped lang="scss">
    $primaryColor: #1EC787;
    .centerx {
        width: 50%;
    }
    .action-block {
    button {
        background: $primaryColor;
        border-radius: 25px;
        width: 100%;
        height: 40px;
    }
    a {
        color: $primaryColor;
        float: right;
    }
    }
    .auth-input {
        margin: 17px 0;
    }

</style>