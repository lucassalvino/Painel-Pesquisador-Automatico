function getBase64(file, callbacksuccess, callbackerror) {
    var reader = new FileReader();
    reader.readAsDataURL(file);
    reader.onload = callbacksuccess;
    reader.onerror = callbackerror;
}
function uploadPhoto64(e, inputfile, inputphoto, inputmime, pathloadimage) {
    var file = e.target.files[0];
    getBase64(file, loaded, errorfunc);
    function loaded(e) {
        var fileString = e.target.result;
        var part_one = fileString.split("data:")[1];
        var type_mime = part_one.split(";base64")[0];
        if (
            type_mime != 'image/jpeg' && type_mime != 'image/jpg' && type_mime != 'image/png'
            && type_mime != 'image/gif' && type_mime != 'image/bmp' && type_mime != 'image/webp'
        ) {
            alert("Tipo de imagem não suportada.");
            $(inputfile).val("");
        } else {
            var splited = fileString.split("base64,");
            $(inputphoto).val(splited[1]);
            $(inputmime).val(type_mime);
            if (pathloadimage) {
              $(pathloadimage).attr('src', fileString);
            }
        }
    }
    function errorfunc(e) {
        console.log("Error base64 image", e.target.error);
    }
}

$(document).ready(function(){
    $('.btn-photo').on('click', function() {
        $('#file-photo').trigger('click');
    });
    $('#file-photo').on('change', function(event) {
        uploadPhoto64(event, '#file-photo', '#path-photo', '#type-photo', '.box-photo');
    });

    $(".sidebar-dropdown > a").click(function() {
        $(".sidebar-submenu").slideUp(200);
        if (
          $(this)
            .parent()
            .hasClass("active")
        ) {
          $(".sidebar-dropdown").removeClass("active");
          $(this)
            .parent()
            .removeClass("active");
        } else {
          $(".sidebar-dropdown").removeClass("active");
          $(this)
            .next(".sidebar-submenu")
            .slideDown(200);
          $(this)
            .parent()
            .addClass("active");
        }
    });
    $("#close-sidebar").click(function() {
        $(".page-wrapper").removeClass("toggled");
    });
    $("#show-sidebar").click(function() {
        $(".page-wrapper").addClass("toggled");
    });
});