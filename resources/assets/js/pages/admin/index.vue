<template>
    <div class="page-wrapper">
        <navBar/>
        <vs-row :style="{height: windowHeight}">
            <vs-col class="full-height" vs-offset="2" vs-type="flex" vs-justify="center"
                    vs-align="center" vs-w="8">
                <div class="form-wrapper">
                    <div class="centerx">
                        <vs-card vs-color="rgb(30, 199, 135)">
                            <vs-card-header vs-background-color="rgb(30, 199, 135)" vs-title="Messages"
                                             vs-icon="mail_outline"></vs-card-header>
                            <vs-card-body>
                                <my-table
                                    :messages="messages"
                                ></my-table>
                                <vs-row>
                                    <vs-col v-if="messages.length > 0" class="full-height" vs-offset="2" vs-type="flex" vs-justify="center"
                                            vs-align="center" vs-w="8">
                                        <vs-pagination v-if="paginate.total > 0"
                                                       :vs-total="paginate.total"
                                                       @page="nextPage"
                                                       :vs-current="paginate.current"
                                                       vs-color="rgb(46, 197, 137)"
                                                       vs-type="filled"></vs-pagination>
                                   </vs-col>
                                    <vs-col v-else class="full-height" vs-offset="2" vs-type="flex" vs-justify="center"
                                            vs-align="center" vs-w="8">
                                        Empty
                                    </vs-col>
                                </vs-row>
                            </vs-card-body>
                        </vs-card>
                    </div>
                </div>
            </vs-col>
        </vs-row>

    </div>
</template>
<script type="text/babel">
    import navBar from './../../components/navbar.vue';
    import myTable from './table'

    export default ({
        data: () => ({
            messages: [],
            windowHeight: 0,
            paginate: {
                total: 0,
                current: 1
            }
        }),
        components: {
            navBar,
            myTable
        },
        created() {
            this.windowHeight = `${(window.innerHeight - 50)}px`;
            this.getMessages()
        },
        methods: {
            getMessages() {
                this.$http.get(`/message/all?page=${this.paginate.current}`).then(
                        response => {
                            this.messages = response.data.data;
                            this.paginate.total = response.data.paginate.meta.last_page;
                            this.paginate.current = response.data.paginate.meta.current_page;
                        },
                        error => console.log('error')
                )
            },
            nextPage(page) {
                this.paginate.current = page;
                this.getMessages();
            }
        }
    })
</script>
<style scoped>
    .centerx {
        width: 100%;
    }
</style>