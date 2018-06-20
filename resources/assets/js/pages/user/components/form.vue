<template>
    <vs-col :style="{height: windowHeight}" vs-offset="4" vs-type="flex" vs-justify="center"
            vs-align="center" vs-w="4">
        <div class="form-wrapper">

            <vs-card vs-color="rgb(30, 199, 135)">
                <vs-card-header vs-background-color="rgb(30, 199, 135)" vs-title="Send message"
                                vs-icon="mail_outline"></vs-card-header>
                <vs-card-body>
                    <vs-row>
                        <vs-input
                                  :vs-valid.sync="validos.title"
                                  vs-success-text="Correo Valido"
                                  vs-danger-text="The title does not meet the requirements"
                                  :vs-validation-function="(value) => value.length > 3"
                                  vs-type="text" vs-label-placeholder="Title" v-model="title"/>
                        <vs-alert vs-active="true" class="form-alert" vs-color="danger" v-if="errors.title">
                            <span v-for="error in errors.title[0]"> {{ error }}</span>
                        </vs-alert>
                    </vs-row>
                    <vs-row>
                        <quill-editor v-model="body"
                                      ref="myQuillEditor"
                                      :options="editorOption"
                        >
                        </quill-editor>
                        <vs-alert vs-active="true" class="form-alert" vs-color="danger" v-if="errors.body">
                            <span v-for="error in errors.body[0]"> {{ error }}</span>
                        </vs-alert>
                    </vs-row>
                    <vs-row>
                        <div class="centerx">
                            <vue-base64-file-upload
                                    class="upload_file_wrapper"
                                    placeholder="Click here to upload file"
                                    accept=".xlsx,.xls,image/*,.doc,.docx,.ppt,.pptx,.txt,.pdf"
                                    image-class="v1-image"
                                    :disable-preview="true"
                                    input-class="upload_file_input"
                                    :max-size="customImageMaxSize"
                                    @size-exceeded="onSizeExceeded"
                                    @load="onLoad"/>
                            <vs-alert vs-active="true" class="form-alert" vs-color="danger" v-if="errors.file">
                                <span v-for="error in errors.file[0]"> {{ error }}</span>
                            </vs-alert>
                        </div>
                    </vs-row>

                </vs-card-body>
                <vs-card-actions>
                    <vs-button @click="send" class="send-button" vs-color="rgb(40, 40, 40)">SEND</vs-button>
                </vs-card-actions>
            </vs-card>
        </div>
        <vs-dialog
                vs-color="danger"
                vs-title="Error"
                :vs-active.sync="activeAlert">
                Server error
        </vs-dialog>
    </vs-col>
</template>
<script type="text/babel">
    import 'quill/dist/quill.core.css'
    import 'quill/dist/quill.snow.css'
    import 'quill/dist/quill.bubble.css'

    import {quillEditor} from 'vue-quill-editor'
    import VueBase64FileUpload from 'vue-base64-file-upload';

    import * as moment from 'moment-timezone';

    export default ({
        data: () => ({
            title: "",
            body: "",
            url: null,
            customImageMaxSize: 3,
            validos: {
              title: false
            },
            errors: {},
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
            colorAlert:'primary',
            activeAlert:false,
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
                this.errors = {}
                let data = {
                    title: this.title,
                    body: this.body,
                    timezone: moment.tz.guess()
                }

                if(this.url) data.file = this.url;
                this.$http.post(`/message/send`, data).then(
                        response => {
                            this.$vs.notify({
                                time: 1500,
                                title:'Success',
                                text: response.data.message,
                                color: 'success'
                            });
                            setTimeout(() => {
                                this.$emit('sendMessage', response.data.data)
                            }, 1500);

                        },
                        error => {
                            if (error.response.data.code == 422) {
                                this.errors = error.response.data.errors;
                            } else {
                                this.openAlert()
                            }
                        }
                )
            },
            onLoad(dataUri) {
                this.url = dataUri; // data-uri string
            },

            onSizeExceeded(size) {
                alert(`Image ${size}Mb size exceeds limits of ${this.customImageMaxSize}Mb!`);
            },
            openAlert(){
                this.activeAlert = true;
            }
        },
        computed: {
            editor() {
                return this.$refs.myQuillEditor.quill
            }
        }
    })
</script>
<style>
    .centerx {
        width: 100%;
    }

    .quill-editor {
        margin: 10px;
        background: inherit;
        box-shadow: none;
        border: 1px solid rgba(0, 0, 0, 0.15);
        border-radius: 5px;
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
    .form-alert {
        margin: 10px;
        width: auto!important;
    }
</style>
