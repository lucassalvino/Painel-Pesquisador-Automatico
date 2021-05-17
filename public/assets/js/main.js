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
        var splited = fileString.split("base64,");
        $(inputphoto).val(splited[1]);
        $(inputmime).val(type_mime);
        if (pathloadimage) {
          $(pathloadimage).attr('src', fileString);
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
    $('form').on('submit', function(e){
        var form = $(this);
        if(form.attr('no-process') !== undefined){
            return true;
        }
        e.preventDefault();
        var data = $(this).serialize();
        var Authorization = "";
        if( form.attr('data-Authorization') !== undefined ){
          Authorization = form.attr('data-Authorization');
        }
        $.ajax({
            url: $(this).attr('action'),
            data: data,
            dataType: 'JSON',
            type: "POST",
            headers:{
              'Authorization':Authorization
            },
            success: function(result){
                console.log(result);
                Swal.fire({
                    title: 'Sucesso:',
                    text: "Operação efetuada com sucesso",
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then( (data)=>{
                  if( form.attr('data-back') !== undefined ){
                    window.location = document.referrer;
                  }else{
                    if( form.attr("data-reload") !== undefined ){
                      window.location.reload();
                    }
                  }
                });
            },
            error: function(err, resp, text) {
              console.log(err)
              let erro = err.responseJSON;
              let message = "";
              let htmlerro = '';
              if(typeof erro != "undefined" && erro !== null) {
                message = erro.mensagem;
                $.each(erro.mensagenserro, function(i, e){
                    htmlerro +=`
                    <div class="alert text-danger" role="alert" style="background-color: rgba(255, 0, 0, 0.3);">
                        ${e}
                    </div>`;
                });
              } else {
                message = 'Ocorreu um problema inesperado.';
              }
              Swal.fire({
                  title: message,
                  html: htmlerro,
                  icon: 'error',
                  confirmButtonText: 'OK'
              });
            }
          });
    });
});