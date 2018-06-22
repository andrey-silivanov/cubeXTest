<template>
    <div class="message-table">
    <vs-row class="table-header">
        <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-w="1">
            #ID
        </vs-col>
        <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-w="2">
            Title
        </vs-col>
        <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-w="2">
            Description
        </vs-col>
        <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-w="2">
            Name
        </vs-col>
        <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-w="2">
            Email
        </vs-col>
        <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-w="1">
            File
        </vs-col>
        <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-w="2">
            Time
        </vs-col>
    </vs-row>
        <vs-row :key="index" v-for="(message, index) in messages" class="message" :class="{'new': message.new}">
            <div  @click="oneMessage(message.id)">
            <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-w="1">
                {{ message.id }}
            </vs-col>
            <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-w="2">
                {{ message.title }}
            </vs-col>
            <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-w="2" v-html="message.body">

            </vs-col>
            <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-w="2">
                {{ message.name }}
            </vs-col>
            <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-w="2">
                {{ message.email }}
            </vs-col>
            <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-w="1">
                <div v-if="message.file">
                    <a :href="message.file" download>
                        <vs-button vs-color="warning" vs-type="filled" vs-icon="backup">Download</vs-button>
                    </a>
                </div>
                <div v-else> - </div>
            </vs-col>
            <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-w="2">
                {{ message.date }}
            </vs-col>
            </div>
        </vs-row>
    </div>
</template>
<script type="text/babel">
    export default ({
        data: () => ({
        }),
        props: {
            messages: Array
        },
        methods: {
            oneMessage(id) {
                this.$router.push(`message/${id}`)
            }
        }
    })
</script>

<style scoped>
    .message-table {
        display: block;
    }
    .table-header {
        padding-bottom: 10px;
        font-weight: 500;
        border-bottom: 1px solid #eee8d5;
    }
    .vs-row {
        margin: 15px 0;
    }
    .message {
        padding: 10px;
        cursor: pointer;
    }
    .new {
        background: #e1e1e1;
    }
</style>