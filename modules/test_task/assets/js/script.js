$( "a.preview-link" ).imageLightbox({
    quitOnImgClick: true
});

$(document).on('click', '.loadMainContent', function(){
    var v = $(this).attr('value');
    var t = $(this).attr('title');
    $('#modalContent').load(v, function () {
        $('#modalHeaderTitle').html('<h4>' + t + '</h4>');
        $('#modal').modal('show');
    });
});