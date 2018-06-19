<template>
    <vs-col :style="{height: windowHeight}" vs-offset="4" vs-type="flex" vs-justify="center"
            vs-align="center" vs-w="4">
        <div class="form-wrapper">

            <vs-card vs-color="rgb(30, 199, 135)">
                <vs-card-header vs-background-color="rgb(30, 199, 135)" vs-title="Send message"
                                vs-icon="mail_outline"></vs-card-header>
                <vs-card-body>
                    <vs-row>
                        <vs-input vs-color="success" vs-label-placeholder="Title" v-model="title"/>
                    </vs-row>
                    <vs-row>
                        <quill-editor v-model="body"
                                      ref="myQuillEditor"
                                      :options="editorOption"
                        >
                        </quill-editor>
                    </vs-row>
                    <vs-row>
                        <div class="centerx">
                            <vue-base64-file-upload
                                    class="upload_file_wrapper"
                                    accept=".xlsx,.xls,image/*,.doc,.docx,.ppt,.pptx,.txt,.pdf"
                                    image-class="v1-image"
                                    input-class="upload_file_input"
                                    :max-size="customImageMaxSize"
                                    @size-exceeded="onSizeExceeded"
                                    @load="onLoad"/>
                        </div>
                    </vs-row>

                </vs-card-body>
                <vs-card-actions>
                    <vs-button @click="send" class="send-button" vs-color="rgb(40, 40, 40)">SEND</vs-button>
                </vs-card-actions>
            </vs-card>
        </div>

    </vs-col>
</template>
<script type="text/babel">
    import 'quill/dist/quill.core.css'
    import 'quill/dist/quill.snow.css'
    import 'quill/dist/quill.bubble.css'

    import {quillEditor} from 'vue-quill-editor'
    import VueBase64FileUpload from 'vue-base64-file-upload';

    export default ({
        data: () => ({
            title: "",
            body: "",
            url: "",
            customImageMaxSize: 3,
            editorOption: {
                modules: {
                    toolbar: [
                        [{'size': ['small', false, 'large']}],
                        ['bold', 'italic'],
                        [{'list': 'ordered'}, {'list': 'bullet'}],
                    ],
                    history: {
                        delay: 1000,
                        maxStack: 50,
                        userOnly: false
                    }
                }
            },
            windowHeight: 0
        }),
        components: {
            quillEditor,
            VueBase64FileUpload
        },
        created() {
            this.windowHeight = `${(window.innerHeight - 100)}px`
        },
        methods: {
            send() {
                let data = {
                    title: this.title,
                    body: this.body,
                    file: this.url
                }
                this.$http.post(`/message/send`, data).then(
                        response => this.$emit('sendMessage', response.data.data),
                        error => console.log('error')
                )
            },
            onLoad(dataUri) {
                this.url = dataUri; // data-uri string
            },

            onSizeExceeded(size) {
                alert(`Image ${size}Mb size exceeds limits of ${this.customImageMaxSize}Mb!`);
            }
        },
        computed: {
            editor() {
                return this.$refs.myQuillEditor.quill
            }
        },
    })
</script>
<style>
    .centerx {
        width: 100%;
    }

    .quill-editor {
        margin: 10px;
    }

    .ql-container {
        min-height: 100px !important;
    }

    .upload_file_wrapper {
        margin: 10px;
    }

    .upload_file_input {
        background: inherit;
        box-shadow: none;
        border: 1px solid rgba(0, 0, 0, 0.15);
        height: 37px;
        padding: 10px;
        border-radius: 5px;
    }

    .send-button {
        width: 100%;
        margin: 10px 20px;
    }
</style>
