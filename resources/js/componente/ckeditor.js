
$(function() {
    /**
     * CKEDITOR
     */
    
     DecoupledEditor
     .create( document.querySelector( '.document-editor__editable' ), {

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
                   'undo', 'redo',  '|'],

         //plugins: [ ExportPdf ],
         
     } )
     .then( editor => {
         const toolbarContainer = document.querySelector( '.document-editor__toolbar' );
 
         toolbarContainer.appendChild( editor.ui.view.toolbar.element );
 
         window.editor = editor;
     } )
     .catch( err => {
         console.error( err );
     } );


})