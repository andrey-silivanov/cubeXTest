<template>
    <div class="centerx">
        <h3>Create account</h3>
        <vs-row>
            <vs-input class="auth-input"
                    :vs-valid.sync="validos.name"
                    vs-success-text="Field is valid"
                    vs-danger-text="Field must have at least 2 characters"
                    :vs-validation-function="(value) => value.length > 2"
                    vs-type="custom" vs-label-placeholder="Name" v-model="name"/>
            <vs-alert vs-active="true" vs-color="danger" v-if="errors.name">
                <span v-for="error in errors.name[0]"> {{ error }}</span>
            </vs-alert>
            </vs-row>
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
        <vs-row>
            <vs-input class="auth-input"
                    :vs-valid.sync="validos.password_confirmation"
                    vs-success-text="Field is valid"
                    vs-danger-text="The Confirm Password confirmation does not match"
                    :vs-validation-function="(value) => value == password"
                    vs-type="password" vs-label-placeholder="Confirm Password"
                    v-model="password_confirmation"/>
            </vs-row>

            <vs-row vs-align="center" vs-type="flex" class="action-block">
                <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-w="6">
                    <vs-button @click="register" vs-color="success">Create account</vs-button>
                </vs-col>
                <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-w="6">
                    <router-link :to="{name: 'login'}" class="nav-link" active-class="active">Login</router-link>
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
            name: '',
            password: '',
            password_confirmation: '',
            validos: {
                email: false,
                name: false,
                password: false,
                password_confirmation: false
            },
            errors: {},
            activeAlert: false
        }),
        methods: {
            register() {
                 this.$auth.register({
                    params: {
                        name: this.name,
                        email: this.email,
                        password: this.password,
                        password_confirmation: this.password_confirmation
                    },
                     success () {
                         this.$vs.notify({
                             time: 1500,
                             title:'Success',
                             text: 'Account created',
                             color: 'success'
                         });
                     },
                     error(err) {
                         if (err.response.data.code == 422) {
                             this.errors = err.response.data.errors;
                         } else {
                             this.openAlert()
                         }
                     },
                     autoLogin: true,
                     rememberMe: true,
                     fetchUser: true,
                     redirect: 'user'
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