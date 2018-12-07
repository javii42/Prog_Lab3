
namespace Entidades{
    export class Manejadora {    
        public static ValidarLogin(): Boolean {
            var email:any = $('#email').val();
            var clave:any = $('#password').val();
            var retorno:boolean = false;            
            var esClave:boolean = false;
            var esMail:boolean = false;


            $('#mostrarErrorEmail').css("display","none");
            $('#mostrarErrorClave').css("display","none");
            $('#mostrarError').css("display","none");

            let usuariosJson:string|null = localStorage.getItem("Usuarios");
            if (usuariosJson) {
                let usuarios = JSON.parse(usuariosJson);
                usuarios.forEach((usuario: any) => {
                    console.log(usuario);
                    console.log(clave + "-"+ email);
                    console.log(usuario.clave + "-"+ usuario.correo);
                    if (usuario.clave == clave && usuario.correo == email) {
                        retorno = true;
                        esMail = true;
                        esClave = true;
                        if(Entidades.Manejadora.GenerarToken(usuario)){
                        }
                    }else{
                        if(usuario.correo == email){
                            esMail = true;
                        }
                        if(usuario.clave == clave){
                            esClave = true;
                            
                        }
                    }

                });
                if(!esMail){
                    $('#mostrarErrorEmail').css("display","block");
                }
                if(!esClave){
                    $('#mostrarErrorClave').css("display","block");
                }
                if(esClave && esMail && !retorno){
                    $('#mostrarError').css("display","block");

                }
            }
            return retorno;
        }

        public static GenerarToken(usuario: any):Boolean{
            var retorno:Boolean = false;
            let formData : FormData = new FormData();
            formData.append("correo", usuario.correo);
            formData.append("nombre", usuario.nombre);
            formData.append("apellido", usuario.apellido);
            formData.append("perfil", usuario.perfil);
    
            $.ajax({
                type: 'POST',
                url: "http://localhost/JWT/crearToken",
                dataType: "json",
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                async: false
            })
            .done(function (objJson : any) {                
                localStorage.setItem("token",objJson);
                console.log(localStorage.getItem("token"));
                retorno = true;
            })
            .fail(function (jqXHR: any, textStatus: any, errorThrown: any) {
                console.log(jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
            }); 
            return retorno;
        }

        
        public static CargarUsuario(): Boolean {

            var apellido:any = $('#apellido').val();
            var nombre:any = $('#nombre').val();
            var email:any = $('#email').val();
            var perfil:any = $('#perfil').val();
            var legajo:any = $('#legajo').val();
            var foto:any = $('#foto')[0].files[0].name;
            var clave:any = $('#password').val();

         //   alert(foto);
            var retorno:boolean = false;  

            var esMail:boolean = false;


            $('#mostrarErrorEmail').css("display","none");
            $('#mostrarError').css("display","none");

            let usuariosJson:string|null = localStorage.getItem("Usuarios");
            if (usuariosJson) {
                let usuarios = JSON.parse(usuariosJson);
                usuarios.forEach((usuario: any) => {
                    console.log(usuario);
                    if (usuario.correo == email) {
                      //  alert(usuario.correo);
                        esMail = true;
                    }

                });

                if(esMail){
                    $('#mostrarErrorEmail').css("display","block");                    
                }else{                    
                    window.location.assign('./login.html');
                   // console.log(usuarios);
                    usuarios.push({
                        "correo": email,
                        "clave": clave,
                        "nombre": nombre,
                        "apellido": apellido,
                        "legajo": legajo,
                        "perfil": perfil,
                        "foto": foto
                    });
                   // console.log(usuarios);
                    localStorage.setItem('Usuarios',  JSON.stringify(usuarios));
                    console.log(localStorage.getItem('Usuarios'));

                    retorno= true;
                }
            }
            return retorno;

        }

        public static EliminarUsuario(correo:string): Boolean {
            var eliminado:boolean=false;
            var flag:boolean=true;
            let usuariosJson:string|null = localStorage.getItem("Usuarios");
            if (usuariosJson) {
                let usuarios = JSON.parse(usuariosJson);
                var usuariosAux = [];
                for(var i=0;i<usuarios.length;i++){
                    if (usuarios[i].correo != correo.trim()) {
                        console.log(usuarios[i]);
                        usuariosAux.push(usuarios[i]);
                        console.log("for");
                    }
                }
                console.log(usuariosAux);
                localStorage.setItem("Usuarios",JSON.stringify(usuariosAux));
                console.log(localStorage.getItem("Usuarios"));
                eliminado = true;
                location.reload();
               /* usuarios.forEach((usuario: any) => {
                    if (usuario.correo == correo.trim()) {
                        delete usuariosJson.usuario;
                        if(!eliminado) localStorage.setItem("Usuarios",usuarios);
                        eliminado=true;
                    }

                });*/
            }
                return eliminado;
        }

        public static ModificarUsuario(correo:string,foto:string): Boolean {    

            var modificado:boolean=false;
            let usuariosJson:string|null = localStorage.getItem("Usuarios");

            var apellido:any = $('#apellido').val();
            var nombre:any = $('#nombre').val();
            var email:any = $('#email').val();
            var perfil:any = $('#perfil').val();
            var legajo:any = $('#legajo').val();
            var clave:any = $('#password').val();

            if (usuariosJson) {
                let usuarios = JSON.parse(usuariosJson);
                var usuariosAux = [];
                for(var i=0;i<usuarios.length;i++){
                    if (usuarios[i].correo != email.trim()) {
                        console.log(usuarios[i]);
                        usuariosAux.push(usuarios[i]);
                        console.log("for");
                    }
                }
                console.log(usuariosAux);
               /* if($('#foto').val() == undefined){
                  //  foto = usuario.foto;
                }else{
                   foto= $('#foto')[0].files[0].name;
                }*/

                usuariosAux.push({
                    "correo": email,
                    "clave": clave,
                    "nombre": nombre,
                    "apellido": apellido,
                    "legajo": legajo,
                    "perfil": perfil,
                    "foto": foto
                });
                localStorage.setItem("Usuarios",JSON.stringify(usuariosAux));
                console.log(localStorage.getItem("Usuarios"));
                modificado = true;
                location.reload();
            }
                return modificado;
        }

        public static GuardarCambios(correo : any)
        {

            var colorFondo : any = $('#colorFondo').val();
            var colorFuente : any =  $('#colorFuente').val();
            var formaFotos : any =  $('#formaFotos').val();


            var usuariosEstilos : any = localStorage.getItem('UsuariosEstilos');            
            usuariosEstilos = JSON.parse(usuariosEstilos);
            var usuariosEstilosAux = [];
            if(usuariosEstilos != null){
                for(var i=0;i<usuariosEstilos.length;i++){
                    if (usuariosEstilos[i].correo != correo.trim()) {
                        console.log(usuariosEstilos[i]);
                        usuariosEstilosAux.push(usuariosEstilos[i]);
                    }
                }
            }
            usuariosEstilosAux.push({
                "correo": correo,
                "colorFondo": colorFondo,
                "colorFuente":colorFuente,
                "formaFotos":formaFotos
            });
            localStorage.setItem("UsuariosEstilos",JSON.stringify(usuariosEstilosAux));
            console.log(localStorage.getItem("UsuariosEstilos"));
            location.reload();

        }
        
    }
}