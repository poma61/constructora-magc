class ImageVisualize {

    static imgView(input, tag_img) {
        const input_file = $(input);
        const tag_img_view = $(tag_img);
        
        input_file.on('change', function () {
            let archivo = input_file[0].files;
            if (!archivo || !archivo.length) {
                tag_img_view.attr('src', '');
                return;
            }

            let primer_archivo = archivo[0];
            let object_url = URL.createObjectURL(primer_archivo);
            tag_img_view.attr('src',object_url);
        });

    }
}

export default ImageVisualize;

