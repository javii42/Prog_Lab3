//import $ from "jquery";
/// <reference path="../libs/jquery/index.d.ts" />
$(document).ready(function () {
	
	
    $("#formularioLogin").bootstrapValidator({
        message:"Default",
        feedbackIcons:{
            valid:"glyphicon glyphicon-ok",
            invalid:"glyphicon glyphicon-remove",
            validating:"glyphicon glyphicon-refresh"
        },
        fields:{
            apellido:{
                validators:{
                    notEmpty:{
                        message: "Complete el campo Apellido"
                    },
					stringLength:{
						min: 1,
						max: 15,
						message: "El apellido debe tener como maximo 15 caracteres"
					},
					regexp:{
						regexp: /^[a-zA-Z]+$/,
						message: "Caracter invalido"
					}
                }
            },
            nombre:{
                validators:{
                    notEmpty:{
                        message:"Complete el campo Nombre"
                    },
					stringLength:{
						min: 1,
						max: 10,
						message: "El nombre debe tener como maximo 10 caracteres"
					},
					regexp:{
						regexp: /^[a-zA-Z]+$/,
						message: "Caracter invalido"
					}
                }
            },
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
            legajo:{
                validators:{
                    notEmpty:{
                        message:"Complete el campo Legajo"
                    },
					stringLength:{
						min: 3,
						max: 6,
						message: "El legajo debe ser entre 3 y 6 digitos"
					},
					regexp:{
						regexp: /^[0-9]+$/,
						message: "Caracter invalido"
					}
                }
            },
		/*	foto:{
				validators:{
					file:{
						type: 'image/jpg,image/png',
						message: "Extensión invalida (Solo jpg y png)"
					},
                    notEmpty:{
                        message:"No se cargo una imagen"
                    }
				}
			},*/
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
					},
					identical:{
						field: 'passwordRepit',
						message: "No coincide la contraseña"
					}
                }
            },
            passwordRepit:{
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
					},
					identical:{
						field: 'password',
						message: "No coincide la contraseña"
					}
                }
            }
        }
    })
});
