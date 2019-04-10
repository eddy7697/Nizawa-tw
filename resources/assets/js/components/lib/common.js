export default {
    conf() {
        return {
            ckConfig: {
                height: 300,
                allowedContent: true,
                filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
                filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=' + $('meta[name="csrf-token"]').attr('content'),
                filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
                filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token=' + $('meta[name="csrf-token"]').attr('content')
            },
            token: $('meta[name="csrf-token"]').attr('content'),
        }
    }
}