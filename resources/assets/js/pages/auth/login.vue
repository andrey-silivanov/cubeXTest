<template>
    <div class="centerx">
        <h3>Welcome</h3>

        <vs-row>
            <vs-input class="auth-input"
                    @keyup.enter="login"
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
                @keyup.enter="login"
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
                <vs-button vs-color="success" @click="login" vs-type="filled">Login</vs-button>
            </vs-col>
            <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-w="6">
                <router-link :to="{name: 'register'}" class="nav-link" active-class="active"> Create account
                </router-link>
            </vs-col>
        </vs-row>
        <vs-dialog
                vs-color="danger"
                vs-title="Error"
                :vs-active.sync="activeAlert">
            Server error
        </vs-dialog>
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
            errors: {},
            activeAlert: false
        }),
        methods: {
            login() {
                this.errors = {}
                this.$auth.login({
                    params: {
                        email: this.email,
                        password: this.password
                    },
                    success () {
                        this.$vs.notify({
                            time: 1500,
                            title:'Success',
                            text: 'Welcome',
                            color: 'success'
                        });
                        let redirectPath = 'user';
                        if (this.$auth.check('manager')) redirectPath = 'admin';
                        setTimeout(() => this.$router.push(redirectPath), 1500); /// redirect
                    },
                    error(err) {
                        if (err.response.data.code == 422) {
                            this.errors = err.response.data.errors;
                        } else {
                            this.openAlert()
                        }
                    },
                    rememberMe: true,
                    fetchUser: true
                });
            },
            openAlert(){
                this.activeAlert = true;
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