var Entidades;
(function (Entidades) {
    var Manejadora = /** @class */ (function () {
        function Manejadora() {
        }
        Manejadora.ValidarLogin = function () {
            var email = $('#email').val();
            var clave = $('#password').val();
            var retorno = false;
            var esClave = false;
            var esMail = false;
            $('#mostrarErrorEmail').css("display", "none");
            $('#mostrarErrorClave').css("display", "none");
            $('#mostrarError').css("display", "none");
            var usuariosJson = localStorage.getItem("Usuarios");
            if (usuariosJson) {
                var usuarios = JSON.parse(usuariosJson);
                usuarios.forEach(function (usuario) {
                    console.log(usuario);
                    console.log(clave + "-" + email);
                    console.log(usuario.clave + "-" + usuario.correo);
                    if (usuario.clave == clave && usuario.correo == email) {
                        retorno = true;
                        esMail = true;
                        esClave = true;
                        if (Entidades.Manejadora.GenerarToken(usuario)) {
                        }
                    }
                    else {
                        if (usuario.correo == email) {
                            esMail = true;
                        }
                        if (usuario.clave == clave) {
                            esClave = true;
                        }
                    }
                });
                if (!esMail) {
                    $('#mostrarErrorEmail').css("display", "block");
                }
                if (!esClave) {
                    $('#mostrarErrorClave').css("display", "block");
                }
                if (esClave && esMail && !retorno) {
                    $('#mostrarError').css("display", "block");
                }
            }
            return retorno;
        };
        Manejadora.GenerarToken = function (usuario) {
            var retorno = false;
            var formData = new FormData();
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
                .done(function (objJson) {
                localStorage.setItem("token", objJson);
                console.log(localStorage.getItem("token"));
                retorno = true;
            })
                .fail(function (jqXHR, textStatus, errorThrown) {
                console.log(jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
            });
            return retorno;
        };
        Manejadora.CargarUsuario = function () {
            var apellido = $('#apellido').val();
            var nombre = $('#nombre').val();
            var email = $('#email').val();
            var perfil = $('#perfil').val();
            var legajo = $('#legajo').val();
            var foto = $('#foto')[0].files[0].name;
            var clave = $('#password').val();
            //   alert(foto);
            var retorno = false;
            var esMail = false;
            $('#mostrarErrorEmail').css("display", "none");
            $('#mostrarError').css("display", "none");
            var usuariosJson = localStorage.getItem("Usuarios");
            if (usuariosJson) {
                var usuarios = JSON.parse(usuariosJson);
                usuarios.forEach(function (usuario) {
                    console.log(usuario);
                    if (usuario.correo == email) {
                        //  alert(usuario.correo);
                        esMail = true;
                    }
                });
                if (esMail) {
                    $('#mostrarErrorEmail').css("display", "block");
                }
                else {
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
                    localStorage.setItem('Usuarios', JSON.stringify(usuarios));
                    console.log(localStorage.getItem('Usuarios'));
                    retorno = true;
                }
            }
            return retorno;
        };
        Manejadora.EliminarUsuario = function (correo) {
            var eliminado = false;
            var flag = true;
            var usuariosJson = localStorage.getItem("Usuarios");
            if (usuariosJson) {
                var usuarios = JSON.parse(usuariosJson);
                var usuariosAux = [];
                for (var i = 0; i < usuarios.length; i++) {
                    if (usuarios[i].correo != correo.trim()) {
                        console.log(usuarios[i]);
                        usuariosAux.push(usuarios[i]);
                        console.log("for");
                    }
                }
                console.log(usuariosAux);
                localStorage.setItem("Usuarios", JSON.stringify(usuariosAux));
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
        };
        Manejadora.ModificarUsuario = function (correo, foto) {
            var modificado = false;
            var usuariosJson = localStorage.getItem("Usuarios");
            var apellido = $('#apellido').val();
            var nombre = $('#nombre').val();
            var email = $('#email').val();
            var perfil = $('#perfil').val();
            var legajo = $('#legajo').val();
            var clave = $('#password').val();
            if (usuariosJson) {
                var usuarios = JSON.parse(usuariosJson);
                var usuariosAux = [];
                for (var i = 0; i < usuarios.length; i++) {
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
                localStorage.setItem("Usuarios", JSON.stringify(usuariosAux));
                console.log(localStorage.getItem("Usuarios"));
                modificado = true;
                location.reload();
            }
            return modificado;
        };
        Manejadora.GuardarCambios = function (correo) {
            var colorFondo = $('#colorFondo').val();
            var colorFuente = $('#colorFuente').val();
            var formaFotos = $('#formaFotos').val();
            var usuariosEstilos = localStorage.getItem('UsuariosEstilos');
            usuariosEstilos = JSON.parse(usuariosEstilos);
            var usuariosEstilosAux = [];
            if (usuariosEstilos != null) {
                for (var i = 0; i < usuariosEstilos.length; i++) {
                    if (usuariosEstilos[i].correo != correo.trim()) {
                        console.log(usuariosEstilos[i]);
                        usuariosEstilosAux.push(usuariosEstilos[i]);
                    }
                }
            }
            usuariosEstilosAux.push({
                "correo": correo,
                "colorFondo": colorFondo,
                "colorFuente": colorFuente,
                "formaFotos": formaFotos
            });
            localStorage.setItem("UsuariosEstilos", JSON.stringify(usuariosEstilosAux));
            console.log(localStorage.getItem("UsuariosEstilos"));
            location.reload();
        };
        return Manejadora;
    }());
    Entidades.Manejadora = Manejadora;
})(Entidades || (Entidades = {}));
