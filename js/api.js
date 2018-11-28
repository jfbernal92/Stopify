
function sendRequest(params) {

    console.log(params) ;
    $.ajax({
        method  : params.method,
        url     : "api.php",
        dataType: "json",
        data    : params,
        success : function(resultado) {
            console.log(resultado);
            if (!resultado.error) {
                
                switch (resultado.cod) {
                    case "get" : 
                        if($("#contentHeader").is(":visible")){
                            $("#contentHeader").hide();
                        }
                        
                        $("#content").data("pagina", params.p+1) ;
                        appendSongs(resultado.data);
                        break ;
                    case "search" :
                        $("#data-list").empty();
                        resultado.data.forEach(song =>{
                            $("#data-list").append('<option value="'+song.titulo+'">');
                        });
                        break;
                   
                    case "changeNick":
                        $("#modalNick").modal("hide");
                        $("#nickNameTitle").html(resultado.data);
                        changeNick("success", "Nick cambiado con éxito.");
                    break;
                    case "delete":
                    case "saveSong":
                    case "deleteFromList":
                    case "deleteUser":
                        $('#'+resultado.data).remove();
                    break;
                    case "deleteLista":
                    case "createLista":
                        location.reload();
                    break;
                }

            } else{
                switch(resultado.cod){
                    case "changeNick":
                        changeNick("danger", "El nick ya está en uso.");
                    break;
                }
            }
        }

       
    }) ;
}


function play(url){
    if(url !== 'null' && url!==''){
        window.open(url, '_blank');
    }
    
}


function appendSongs(data){
    data.forEach(song => {
        $('#content').append(
            '<div class="col-lg-4 col-md-6 col-12" id="'+song.idSpotify+'"> '+
                '<div class="card card-song">' +
                    '<div class="caratula-container">'+
                        '<img class="card-img-top mb-0 caratula" src="'+song.image_url+'" alt="Card image cap">'+
                        '<span class="playButton">'+
                            '<i class="material-icons play-icon" data-song="'+song.preview_url+'" onclick="play(\''+song.preview_url+'\')">play_circle_outline</i>'+
                            '<i class="far fa-heart" onclick="sendRequest({\'cod\':\'saveSong\',\'method\':\'POST\',\'idSpotify\':\''+song.idSpotify+'\'})"></i>'+
                        '</span>'+
                    '</div>'+
                    '<div class="card-body pt-0">'+
                        '<hr>'+
                        '<h4 class="title mb-0">'+song.titulo.substring(0,64)+'</h4>'+
                        '<p class="card-text">Cantante:'+song.autor+'</p>'+
                        '<p class="card-text">Año:'+song.anio+'</p>'+
                        '<p class="card-text">Duracion:'+song.duracion+'</p>'+
                        '<div>'+
                            '<p class="card-text mr-2" style="display: inline-block">Popularidad: </p>'+
                            '<span class="progress" style="width: 20%;height: 16px !important;display: inline-flex" data-toggle="tooltip" data-placement="bottom" title="'+song.popularity/10+'/ 10">'+
                                '<span class="progress-bar bg-'+getProgressBar(song.popularity)+'" role="progressbar" style="width: '+song.popularity+'%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></span>'+
                            '</span>'+
                        '</div>'+
                    '</div>'+
                '</div>'+
            '</div>'
        );
    });
}

function addSongToList(id){
    $('#inputIdSongLista').remove();
    $('#formInsertLista').append('<input type="hidden" id="inputIdSongLista" name="idSpotify" value="'+id+'">');
}
function changeNick(success,msj){
    $("body").append('<div class="alert alert-'+success+' animated-alert">'+
    '<div class="container-fluid">'+
            '<div class="alert-icon">'+
                '<i class="material-icons">info_outline</i>'+
            '</div>'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
                '<span aria-hidden="true"><i id="alertDismiss" class="material-icons">clear</i></span>'+
        '</button>'+
            '<b>Aviso:'+msj+'</b>'+
        '</div>'+
    '</div>');

    setTimeout(function(){
        $('.animated-alert').css({'left':'-800px','animation':'alert-dismiss 2s'});
    },8000);

    setTimeout(function(){
        $('#alertDismiss').click();
    }, 12000);
}

function getProgressBar(p){
    if(p<40){
        return "warning";
    }else if(p<70){
        return "info";
    }
    return "success";  
}

//Modal nick
$("#changeNick").on("click", function(){
    if ($("#nickInput").val().length >= 6 && $("#nickInput").val().length <50){
        sendRequest({"cod":"changeNick","method":"POST", "nick" : $("#nickInput").val()}) ;
    }
});

$("#nickInput").on("keyup", function(event) {
    if ($("#nickInput").val().length >= 6 && $("#changeNick")[0].disabled){
        $("#changeNick")[0].disabled = false;
    }else if($("#nickInput").val().length <6 && !$("#changeNick")[0].disabled){
        $("#changeNick")[0].disabled = true;
    }
}) ;


//Modal lista
$("#createLista").on("click", function(){
    if ($("#listaInput").val().length >= 6 && $("#listaInput").val().length <50){
        sendRequest({"cod":"createLista","method":"POST", "listaName" : $("#listaInput").val()}) ;
    }
});

$("#listaInput").on("keyup", function(event) {
    if ($("#listaInput").val().length >= 6 && $("#createLista")[0].disabled){
        $("#createLista")[0].disabled = false;
    }else if($("#listaInput").val().length <6 && !$("#createLista")[0].disabled){
        $("#createLista")[0].disabled = true;
    }
}) ;



//Song searches
$("#search").on("click", function(){
    $("#content").empty();
    $("#content").data("pagina",0);
    sendRequest({"cod":"get","method":"GET", "p":$("#content").data("pagina"), "q": $("#q").val()});
});

$("#q").on("keydown", function(event) {
    if (event.which == 13 || event.keyCode == 13) {
        $("#content").empty();
        $("#content").data("pagina",0);
        sendRequest({"cod":"get","method":"GET", "p":$("#content").data("pagina"), "q": $("#q").val()});
        return;
    }
    if ($("#q").val().length >= 3){
        sendRequest({"cod":"search","method":"POST", "txt" : $("#q").val()}) ;
    }
}) ;


$(window).scroll(function() {
    if($(window).scrollTop() + $(window).height() +1 >= $(document).height() && $('#q').val().trim().length !== 0) {
        // Obtenemos el valor del atributo data-pagina
        sendRequest( {'cod' : 'get', 'p' : $('#content').data('pagina'), 'q' :  $('#q').val()} ); 
    }
}) ;
