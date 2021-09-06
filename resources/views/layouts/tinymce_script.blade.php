
    <script type="module">
        
        tinymce.init({
            selector: 'textarea.tinymce',
            height: 500,
            setup: function(editor) {
                editor.on('init change', function() {
                    editor.save();
                });
            },
            plugins: [
                'advlist anchor autolink autoresize autosave charmap code colorpicker',
                'contextmenu directionality emoticons hr image imagetools importcss insertdatetime image legacyoutput link lists',
                'media nonbreaking noneditable pagebreak paste preview save searchreplace stickytoolbar',
                'tabfocus table textcolor textpattern toc visualblocks visualchars wordcount'
            ],
            toolbar: 'formatselect | bold underline | forecolor backcolor | link image | hr',
            block_formats: 'Paragraph=p;見出し1=h2;見出し2=h3;見出し3=h4',
            menubar: true,
            element_format: 'html',
            relative_urls: false,
            branding: false,
            language: 'ja',
            image_title: true,
            automatic_uploads: true,
            images_upload_url: '{{ url('') }}/imageUpload?_token={{ csrf_token() }}@php if(!empty($tinymce_img_urlparam)){ echo $tinymce_img_urlparam; }@endphp',
            file_picker_types: 'image',
            file_picker_callback: function(cb, value, meta) {
                var input = document.createElement('input');
                input.setAttribute('type', 'file');
                input.setAttribute('accept', 'image/*');
                input.onchange = function() {
                    var file = this.files[0];

                    var reader = new FileReader();
                    reader.readAsDataURL(file);
                    reader.onload = function() {
                        var id = 'blobid' + (new Date()).getTime();
                        var blobCache = tinymce.activeEditor.editorUpload.blobCache;
                        var base64 = reader.result.split(',')[1];
                        var blobInfo = blobCache.create(id, file, base64);
                        blobCache.add(blobInfo);
                        cb(blobInfo.blobUri(), {
                            title: file.name
                        });
                    };
                };
                input.click();
            },
        });
        
    </script>