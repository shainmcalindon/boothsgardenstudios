tinymce.init({
    selector: "textarea.tinymce",
    theme: "modern",
    
    style_formats: [
        {title: 'Header 1', block: 'h1'},
        {title: 'Header 2', block: 'h2'},
        {title: 'Header 3', block: 'h3'},
        {title: 'Lead paragraph', block: 'p', classes: 'lead'},
        {title: 'Paragraph', block: 'p'},
        {title: 'Blockquote', block: 'blockquote'},
        {title: 'Video container', block: 'div', classes: 'video-container'},
        {title: 'Img caption', selector: 'img', classes: 'img-caption'},
    ],
    
    formats : {
      alignleft : {selector : 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', classes : 'align-left'},
      aligncenter : {selector : 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', classes : 'align-center'},
      alignright : {selector : 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', classes : 'align-right'},
    },

    plugins: [
        "advlist autolink lists link image charmap print preview hr anchor pagebreak",
        "searchreplace wordcount visualblocks visualchars code fullscreen",
        "insertdatetime media nonbreaking save table contextmenu directionality",
        "emoticons template paste textcolor moxiemanager"
    ],
    toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
    toolbar2: "print preview media | forecolor backcolor emoticons",
    image_advtab: true,
    templates: [
        {title: 'Test template 1', content: 'Test 1'},
        {title: 'Test template 2', content: 'Test 2'}
    ],
    content_css : "/css/bootstrap.css"
});

