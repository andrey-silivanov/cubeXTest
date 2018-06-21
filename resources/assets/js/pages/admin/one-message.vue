<template>
    <div class="page-wrapper">
        <navBar/>
        <vs-col :style="{height: windowHeight}" vs-offset="4" vs-type="flex" vs-justify="center"
                vs-align="center" vs-w="4">
            <vs-card vs-color="rgb(30, 199, 135)">
                <vs-card-header vs-background-color="rgb(30, 199, 135)" vs-title="Message"
                                vs-icon="mail_outline"></vs-card-header>
                <vs-card-body>
                    <div class="message-info">
                        <label> From:</label> <span>{{ message.name }}</span>
                    </div>
                    <div class="message-info">
                        <label> Email:</label> <span>{{ message.email }}</span>
                    </div>
                    <div class="message-info">
                        <label> Title:</label> <span>{{ message.title }}</span>
                    </div>
                    <hr/>

                    <p class="body-message" v-html="message.body"></p>
                    <span class="pull-right">{{ message.date }}</span>

                    <div >
                        <a :href="message.link">
                            <vs-button vs-color="warning" vs-type="filled" vs-icon="backup">Download</vs-button>
                        </a>
                    </div>

                </vs-card-body>
                <vs-card-actions>
                    <vs-button @click="answer" v-if="" class="send-button" vs-color="rgb(40, 40, 40)">Answer</vs-button>
                </vs-card-actions>
            </vs-card>
        </vs-col>
    </div>
</template>
<script type="text/babel">

    import navBar from './../../components/navbar'

    export default ({
        data: () => ({
            message: {},
            windowHeight: 0
        }),
        components: {
            navBar
        },
        created() {
            this.windowHeight = `${(window.innerHeight - 50)}px`;
            this.getMessage()
        },
        methods: {
            getMessage() {
                this.$http.get(`/message/${this.$route.params.id}`).then(
                        response => this.message = response.data.data,
                        error => {
                            if(error.response.data.code == 404) this.$router.push('/404')
                        }
                )
            },
            answer() {
                this.$http.put(`/message/answer/${this.$route.params.id}`).then(
                        response => {
                            this.message = response.data.data
                        },
                        error => {

                        }
                )
            }
        }
    })
</script>

<style scoped>
    .body-message {
        margin: 20px 0;
    }

    .message-info {
        padding: 5px;
    }
    .send-button {
        width: 100%;
        margin-top: 30px;
    }
</style>