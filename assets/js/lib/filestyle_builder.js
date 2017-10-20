function createFileInput(fileInput) {
    fileInput.filestyle({
        buttonText: "Examinar...",
        placeholder: "Añada un logotipo",
        iconName: "fa fa-picture-o",
        buttonName: "btn-primary"
    });
    
    $('.bootstrap-filestyle input').val(fileInput.attr('url_image'));
    return fileInput;
}