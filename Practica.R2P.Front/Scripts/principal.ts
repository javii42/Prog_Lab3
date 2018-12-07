//import $ from "jquery";
/// <reference path="../libs/jquery/index.d.ts" />

var perfilUsuario:string = "";
var correo:string = "";

$(document).ready(function(){

    crearTabla(); 
    visual();
    $('#modificar').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var recipient = button.data('whatever') // Extract info from data-* attributes
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
       
        var modal = $(this);
        var foto:string = "";
        console.log(recipient);    
        
        let usuariosJson:string|null = localStorage.getItem("Usuarios");
        let usuarios:any|null = JSON.parse(usuariosJson);
        for(var i=0;i<usuarios.length;i++){
            if (usuarios[i].correo == recipient.trim()) {
                console.log(usuarios[i]);
                modal.find('#perfil').val(usuarios[i].perfil);
                modal.find('#nombre').val(usuarios[i].nombre);
                modal.find('#email').val(usuarios[i].correo);
                modal.find('#apellido').val(usuarios[i].apellido);
                modal.find('#legajo').val(usuarios[i].legajo);
                foto = usuarios[i].foto;
            //    modal.find('#foto').val(usuarios[i].foto);
                modal.find('#password').val(usuarios[i].clave);
                modal.find('#passwordRepit').val(usuarios[i].clave);
            }
        } 
        
        modal.find('#ModificarSiBtn').attr("onclick",'Entidades.Manejadora.ModificarUsuario("'+recipient+'","'+foto+'")');
        
      })

    $('#eliminar').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var recipient = button.data('whatever') // Extract info from data-* attributes
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this)
        console.log(recipient);

        modal.find('#EliminarSibtn').attr("onclick",'Entidades.Manejadora.EliminarUsuario("'+recipient+'")');
       
      })
      
     
});

function visual(){
    var estilos = localStorage.getItem("UsuariosEstilos");
    if(estilos != null){             
        let usuariosEstilos = JSON.parse(estilos);
        for(var i=0;i<usuariosEstilos.length;i++){
            if (usuariosEstilos[i].correo == correo.trim()) {
                $("#tabla").attr("style","background-color:"+ usuariosEstilos[i].colorFondo
                    +";color:"+usuariosEstilos[i].colorFuente);
                $('img').addClass(usuariosEstilos[i].formaFotos);
            }
        }
    }
}
function crearTabla(){
    var html = "";
    //alert(localStorage.getItem("Perfil"));
    if(verificarPerfil()){
        console.log("PERFIL: "+perfilUsuario);
        let usuariosJson:string|null = localStorage.getItem("Usuarios");
        if (usuariosJson) {
            let usuarios = JSON.parse(usuariosJson);
            $("#tabla").append('<tr>');
            $("#tabla").append('<th>Correo</th>');
            $("#tabla").append('<th>Nombre</th>');
            $("#tabla").append('<th>Apellido</th>');
            $("#tabla").append('<th>Perfil</th>');
            $("#tabla").append('<th>Legajo</th>');
            $("#tabla").append('<th>Foto</th>');
            if(perfilUsuario == "admin"){
                $("#tabla").append('<th>Eliminar</th>');
            }
            $("#tabla").append('</tr>');
            for(var i=0; i<usuarios.length;i++){
                if(usuarios[i].correo !=null){
                    $("#tabla").append('<tr>');            
                    $("#tabla").append('<td>'+usuarios[i].correo+'</td>');
                    $("#tabla").append('<td>'+usuarios[i].nombre+'</td>');
                    $("#tabla").append('<td>'+usuarios[i].apellido+'</td>');
                    $("#tabla").append('<td>'+usuarios[i].perfil+'</td>');
                    $("#tabla").append('<td>'+usuarios[i].legajo+'</td>');
                    $("#tabla").append('<td><img src="./fotos/'+usuarios[i].foto+'" width="50px" heigth="50px" id="imagen"/></td>');
                    if(perfilUsuario == "admin" || perfilUsuario == "superAdmin"){
                        $("#tabla").append('<td><button type="button" class="btn btn-danger" data-toggle="modal" data-target="#eliminar" id="btnEliminar" data-whatever="'+usuarios[i].correo+'"> Eliminar</button> </td>');
                   }
                   if(perfilUsuario == "superAdmin"){
                        $("#tabla").append('<td><button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modificar" id="btnModificar" data-whatever="'+usuarios[i].correo+'"> Modificar</button> </td>');

                   }
                    $("#tabla").append('</tr>');
    
                }
            }
            if(perfilUsuario == "invitado"){

                
						
						
                //Cambiar colores fondo.
                html+= '<h4>COLOR FONDO</h4>';
                html+='<tr><select name="colorFondo" id="colorFondo" class="form-control-lg" title="colorFondo">';
                html+='<option value="#0033cc">AZUL</option>';
                html+='<option value="#d6d6c2">GRIS</option>';
                html+='<option value="#00cc33">VERDE</option>';
                html+='</select></tr>';

                html+= '<h4>COLOR FUENTE</h4>';
                html+='<tr><select name="colorFuente" id="colorFuente" class="form-control-lg" title="colorFuente">';
                html+='<option value="black">NEGRO</option>';
                html+='<option value="white">BLANCO</option>';
                html+='<option value="#cc0000">ROJO</option>';
                html+='</select></tr>';

                html+='<h4>FORMA FOTOS</h4>';
                html+='<tr><select name="formaFotos" id="formaFotos" class="form-control-lg" title="formaFotos">';
                html+='<option value="img-rounded">VERT. REDONDEADOS</option>';
                html+='<option value="img-circle">IMG. REDONDA</option>';
                html+='<option value="img-thumbnail">DIAPOSITIVA</option>';
                html+='</select></tr>';
                html+='<br><br>';
                html+='<td><button type="button" class="btn btn-primary btn-block" data-toggle="modal" id="btnGuardarCambios" onclick="Entidades.Manejadora.GuardarCambios(';
                html+= "'" + correo + "'" + ');" style="width: 55%;"> GuardarCambios</button> </td></tr>';  
               
                $("#tablaInvitado").append(html);
                        
            }
        }
    }
}
function verificarPerfil():Boolean{
    var retorno:Boolean= false;
    let formData : FormData = new FormData();
    var token : string | null = localStorage.getItem("token");
    if(token != null){
        formData.append("token", token);    
        $.ajax({
            type: 'POST',
            url: "http://localhost/JWT/verificarToken",
            dataType: "json",
            cache: false,
            contentType: false,
            processData: false,
            data: formData,
            async: false
        })
        .done(function (objJson : any) { 
            console.log(objJson);
            perfilUsuario = objJson.datos.data.perfil;
            correo = objJson.datos.data.correo;
            retorno = true;
        })
        .fail(function (jqXHR: any, textStatus: any, errorThrown: any) {
            console.log(jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
         //   window.location.assign('./login.html');
        }); 
    }else{   
        console.log("token nulo");        
     //   window.location.assign('./login.html');
    }
    return retorno;  
    //return retorno;
}