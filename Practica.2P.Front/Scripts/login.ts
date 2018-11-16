//import $ from "jquery";
/// <reference path="../libs/jquery/index.d.ts" />
$(document).ready(function(){
    
    if (localStorage.getItem('Usuarios')) {
        console.log("Ya existen elementos en el local storage: " + localStorage.getItem('Usuarios'));
    }
    else {
        var usuarios = [{
            "correo": "javier@gmail.com",
            "clave": "1234",
            "nombre": "Javier",
            "apellido": "Mollar",
            "legajo": 12345,
            "perfil": "Socio",
            "foto": "foto1.jpg"
        },
        {
            "correo": "Carlos@hotmail.com",
            "clave": "1234",
            "nombre": "Carlos",
            "apellido": "Pena",
            "legajo": 675,
            "perfil": "Empleado",
            "foto": "foto2.jpg"
        },
        {
            "correo": "Ale@gmail.com",
            "clave": "12345",
            "nombre": "Ale",
            "apellido": "Chena",
            "legajo": 123456,
            "perfil": "Socio",
            "foto": "foto3.jpg"
        },
        {
            "correo": "stan@yahoo.com",
            "clave": "1234",
            "nombre": "Stan",
            "apellido": "Lee",
            "legajo": 6546456,
            "perfil": "Socio",
            "foto": "foto4.png"
        },
        {
            "correo": "Roberto@alkeada.com",
            "clave": "1234",
            "nombre": "Roberto",
            "apellido": "Melo",
            "legajo": 600600,
            "perfil": "Empleado",
            "foto": "foto5.jpeg"
        },]

        localStorage.setItem('Usuarios', JSON.stringify(usuarios));
        console.log(localStorage.getItem('Usuarios'));
    }

    $("#formularioLogin").bootstrapValidator({
        message:"Default",
        feedbackIcons:{
            valid:"glyphicon glyphicon-ok",
            invalid:"glyphicon glyphicon-remove",
            validating:"glyphicon glyphicon-refresh"
        },
        fields:{
            email:{
                validators:{
                    notEmpty:{
                        message:"Complete el campo E-Mail"
                    },
					emailAddress:{
						message:"Formato de mail invalido"
					}
                }
            },
            password:{
                validators:{
                    notEmpty:{
                        message:"Complete el campo Password"
                    },
					stringLength:{
						min: 4,
						max: 8,
						message: "La contraseña debe tener entre 4 y 8 caracteres"
					},
					regexp:{
						regexp: /^[a-zA-Z1-9_]+$/,
						message: "Caracter invalido"
					}
                }
            }
        }
    })


});

