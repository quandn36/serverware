CKEDITOR.replace('{!! $textID !!}', {
    // Define the toolbar groups as it is a more accessible solution.
    toolbar: [{
            name: 'styles',
            items: ['Format']
        },
        {
            name: 'basicstyles',
            items: ['Bold', 'Italic', 'Underline']
        },
        {
            name: 'paragraph',
            items: [ 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock' ]
        },
        {
            name: 'paragraph',
            items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent']
        },
        {
            name: 'colors',
            items: ['TextColor', 'BGColor']
        },
        {
            name: 'links',
            items: ['Link', 'Unlink']
        },
        {
            name: 'document',
            items: ['Source']
        },
    ]
});