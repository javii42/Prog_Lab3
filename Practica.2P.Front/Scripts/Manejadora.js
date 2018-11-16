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
                    if (usuario.clave == clave && usuario.correo == email) {
                        window.location.assign('./principal.html');
                        retorno = true;
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
        Manejadora.CargarUsuario = function () {
            var apellido = $('#apellido').val();
            var nombre = $('#nombre').val();
            var email = $('#email').val();
            var perfil = $('#perfil').val();
            var legajo = $('#legajo').val();
            var foto = $('#foto').val();
            var clave = $('#clave').val();
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
        return Manejadora;
    }());
    Entidades.Manejadora = Manejadora;
})(Entidades || (Entidades = {}));
