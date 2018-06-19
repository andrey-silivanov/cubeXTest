<template>
    <vs-col :style="{height: windowHeight}" vs-offset="4" vs-type="flex" vs-justify="center"
            vs-align="center" vs-w="4">
        <div class="form-wrapper">

                <vs-card vs-color="rgb(30, 199, 135)">
                    <vs-card-header vs-background-color="rgb(30, 199, 135)" vs-title="A nice title"
                                    vs-subtitle="A nice subtitle" vs-icon="account_circle"></vs-card-header>
                    <vs-card-body>
                        <vs-row>
                            <vs-input vs-color="success" vs-label-placeholder="Success" v-model="title"/>
                        </vs-row>
                        <vs-row>
                            <quill-editor v-model="body"
                                          ref="myQuillEditor"
                                          :options="editorOption"
                                          @blur="onEditorBlur($event)"
                                          @focus="onEditorFocus($event)"
                                          @ready="onEditorReady($event)">
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
                                        @load="onLoad" />
                            </div>
                        </vs-row>

                    </vs-card-body>
                    <vs-card-actions>
                        <vs-button @click="base" vs-color="rgb(40, 40, 40)">Send</vs-button>

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
            base() {
                var reader = new FileReader();
                reader.readAsDataURL(this.url);
                reader.onload = function () {
                    console.log(reader.result);
                };
                reader.onerror = function (error) {
                    console.log('Error: ', error);
                };
            },
            onEditorBlur(quill) {
                console.log('editor blur!', quill)
            },
            onEditorFocus(quill) {
                console.log('editor focus!', quill)
            },
            onEditorReady(quill) {
                console.log('editor ready!', quill)
            },
            onEditorChange({quill, html, text}) {
                console.log('editor change!', quill, html, text)
                this.content = html
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
</style>
