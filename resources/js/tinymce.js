// function example_image_upload_handler (blobInfo, success, failure, progress) {
//     let xhr, formData;
//
//     xhr = new XMLHttpRequest();
//     xhr.withCredentials = false;
//     xhr.open('POST', 'image/upload');
//     xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'))
//
//     xhr.upload.onprogress = function (e) {
//         progress(e.loaded / e.total * 100);
//     };
//
//     xhr.onload = function() {
//         let json;
//
//         if (xhr.status === 403) {
//             failure('HTTP Error: ' + xhr.status, { remove: true });
//             return;
//         }
//
//         if (xhr.status < 200 || xhr.status >= 300) {
//             failure('HTTP Error: ' + xhr.status);
//             return;
//         }
//
//         json = JSON.parse(xhr.responseText);
//
//         if (!json || typeof json.location != 'string') {
//             failure('Invalid JSON: ' + xhr.responseText);
//             return;
//         }
//
//         success(json.location);
//     };
//
//     xhr.onerror = function () {
//         failure('Image upload failed due to a XHR Transport error. Code: ' + xhr.status);
//     };
//
//     formData = new FormData();
//     formData.append('file', blobInfo.blob(), blobInfo.filename());
//     formData.append('slug', $('.tinymce').data('sid'));
//
//     console.log(formData);
//     xhr.send(formData);
// }

tinymce.init({
    selector: '.tinymce',
    plugins: 'image code',
    toolbar: 'undo redo | link image | code',
    images_file_types: 'jpg,gif,png',
    block_unsupported_drop: true,
    /* enable title field in the Image dialog*/
    image_title: true,
    /* enable automatic uploads of images represented by blob or data URIs*/
    automatic_uploads: true,
    images_upload_url: 'image/upload',
    /*
      URL of our upload handler (for more details check: https://www.tiny.cloud/docs/configure/file-image-upload/#images_upload_url)
      images_upload_url: 'postAcceptor.php',
      here we add custom filepicker only to Image dialog
    */
    file_picker_types: 'image',
    /* and here's our custom image picker*/
    file_picker_callback: function (cb, value, meta) {
        var input = document.createElement('input');
        input.setAttribute('type', 'file');
        input.setAttribute('accept', 'image/*');

        /*
          Note: In modern browsers input[type="file"] is functional without
          even adding it to the DOM, but that might not be the case in some older
          or quirky browsers like IE, so you might want to add it to the DOM
          just in case, and visually hide it. And do not forget do remove it
          once you do not need it anymore.
        */

        input.onchange = function () {
            var file = this.files[0];

            var reader = new FileReader();
            reader.onload = function () {
                /*
                  Note: Now we need to register the blob in TinyMCEs image blob
                  registry. In the next release this part hopefully won't be
                  necessary, as we are looking to handle it internally.
                */
                var id = 'blobid' + (new Date()).getTime();
                var blobCache =  tinymce.activeEditor.editorUpload.blobCache;
                var base64 = reader.result.split(',')[1];
                var blobInfo = blobCache.create(id, file, base64);
                blobCache.add(blobInfo);

                /* call the callback and populate the Title field with the file name */
                cb(blobInfo.blobUri(), { title: file.name });
            };
            reader.readAsDataURL(file);
        };

        input.click();
    },
    content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }',
    // images_upload_handler: example_image_upload_handler
});
