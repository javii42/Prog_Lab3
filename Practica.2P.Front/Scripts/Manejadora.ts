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
                    if (usuario.clave == clave && usuario.correo == email) {
                        window.location.assign('./principal.html');
                        retorno = true;
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

        
        public static CargarUsuario(): Boolean {

            var apellido:any = $('#apellido').val();
            var nombre:any = $('#nombre').val();
            var email:any = $('#email').val();
            var perfil:any = $('#perfil').val();
            var legajo:any = $('#legajo').val();
            var foto:any = $('#foto').val();
            var clave:any = $('#clave').val();

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

        
    }
}