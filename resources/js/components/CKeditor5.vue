<template>
    <div class="card">
        <div class="card-header">
            Teste ckEditor
        </div>
        <div class="document-editor">
            <div class="document-editor__toolbar"></div>
            <div class="document-editor__editable-container">
                <ckeditor :editor="editor" :config="editorConfig" @ready="onReady" ></ckeditor>
            </div>
            
        </div>
        
    </div>
</template>

<script>

    import '../../css/ckeditor/ckeditor.scss';
    import imageIcon from '@ckeditor/ckeditor5-core/theme/icons/image.svg';
import { initCustomFormatter } from 'vue';

    export default {
        data() {
            return {
                editor: DecoupledEditor,
                editorData: 'Teste',
                editorConfig: {
                    language: 'pt-br',

                    toolbar: ['heading', '|', 
                            'fontfamily', 'fontsize', '|',
                            'fontColor', 'fontBackgroundColor', '|',
                            'bold', 'italic', 'underline', 'strikethrough', '|', 
                            'alignment', '|',
                            'outdent', 'indent', '|',
                            'bulletedList', 'numberedList', '|',
                            'blockQuote', '|', 
                            'insertTable', 'uploadImage', 'link', '|',
                            'undo', 'redo',  '|',
                            'testeVariavel'
                            ],

                    pagination: {
                        //A4
                        pageWidth: '21cm',
                        pageHeight: '29.7cm',

                        pageMargins: {
                            top: '20mm',
                            bottom: '20mm',
                            right: '12mm',
                            left: '12mm'
                        }
                    }
                }
            }
        },

        methods: {
            onReady( editor )  {

               // const editorContainer =  document.querySelector('.document-editor');

                const toolbarContainer = document.querySelector(  '.document-editor__toolbar' );
                //editorContainer.appendChild( editor.ui.view.editable.element );
                toolbarContainer.appendChild( editor.ui.view.toolbar.element ); 

                // Insert the toolbar before the editable area.
                /*
                editor.ui.getEditableElement().parentElement.insertBefore(
                    
                    editor.ui.view.toolbar.element,
                    editor.ui.getEditableElement()
                );
                */
            },

        },

        
    }
</script>