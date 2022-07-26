



$("#crop").click(function() {
    $modal.modal('hide');
    canvas = cropper.getCroppedCanvas({});
    canvas.toBlob(function(blob) {
        url = URL.createObjectURL(blob);
        var reader = new FileReader();
        reader.readAsDataURL(blob);
        reader.onloadend = function() {
            var base64data = reader.result;
            $('#base64dataPhoto').val(base64data);
        }
    });
});