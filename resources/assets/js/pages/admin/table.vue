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
            Name
        </vs-col>
        <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-w="2">
            Email
        </vs-col>
        <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-w="1">
            File
        </vs-col>
        <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-w="3">
            Time
        </vs-col>
        <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-w="1">
            Completed
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
            <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-w="2">
                {{ message.name }}
            </vs-col>
            <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-w="2">
                {{ message.email }}
            </vs-col>
            <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-w="1">
                <div v-if="message.file">
                        <vs-button vs-color="warning" vs-type="filled" vs-icon="backup">Download</vs-button>
                </div>
                <div v-else> - </div>
            </vs-col>
            <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-w="3">
                {{ message.date }}
            </vs-col>
                <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-w="1">
                    <i v-if="message.answered" class="material-icons done-icon">done</i>
                    <i v-else class="material-icons danger-icon">clear</i>
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
    .done-icon {
        color: #2ec589;
    }
    .danger-icon {
        color: #e20909;
    }
</style>