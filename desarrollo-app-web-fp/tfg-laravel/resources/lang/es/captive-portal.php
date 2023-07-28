<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Captive Portal Language Lines
    |--------------------------------------------------------------------------
    |
    | Language library of the captive portal.
    |
    */

    'form' => [
        'register' => [
            'button' => 'Entrar mediante Registro',
            'o' => 'O',
            'tittle' => 'Formulario de Registro'
        ],
        'name' => [
            'tittle' => 'Nombre',
            'placeholder' => 'Introduzca su nombre'
        ],
        'surname' => [
            'tittle' => 'Apellidos',
            'placeholder' => 'Introduzca sus apellidos'
        ],
        'email' => [
            'tittle' => 'Email',
            'placeholder' => 'Introduzca su email'
        ],
        'gender' => [
            'tittle' => 'Genero',
            'placeholder' => 'Introduzca su genero',
            'types' => [
                'man' => 'Hombre',
                'woman' => 'Mujer',
            ],
        ],
        'birthdate' => [
            'tittle' => 'Fecha de nacimiento',
            'placeholder' => 'Introduzca su fecha de nacimiento'
        ],
        'back' => 'Volver',
        'submit' => 'Enviar',
        'clean' => 'Limpiar',
        'conditions' => 'Acepto los <b>terminos y <span id="conditions">condiciones</span></b>',
        'conditions-minor' => '¿Tiene permiso paterno o de su tutor legal?',
        'inhotel' => '¿Esta alojado en el hotel?',
        'inhotelYes' => 'Sí',
        'inhotelNo' => 'No',
        'numroom' => 'Introduzca su numero de habitacion',
        'validations' => "{
            'name': {
                'empty': 'Por favor, inserte su nombre',
                'minLength': '{value} es muy corto',
                'maxLength': '{value} es muy largo',
                'regexAZaz': '{value} no es un nombre',
            },
            'surname': {
                'empty': 'Por favor, inserte sus apellidos',
                'minLength': '{value} son muy cortos',
                'maxLength': '{value} son muy largos',
                'regexAZaz': '{value} no son apellidos',
            },
            'email': {
                'empty': 'Por favor, inserte su email',
                'email': '{value} no es un email',
            },
            'gender': {
                'empty': 'Por favor, seleccione su genero',
            },
            'birthdate': {
                'empty': 'Por favor, seleccione su fecha de nacimiento',
            },
            'acceptConditions': {
                'checked': 'Por favor, acepte las condiciones',
            },
            'acceptConditionsMinor': {
                'checked': 'Por favor, indique si tiene permiso de su tutor legal',
            },
        }",
    ],
    'modals' => [
        'conditions' => [
            'tittle' => 'Condiciones',
        ],
        'validation-data' => [
            'text' => 'Validando sus datos',
        ],
        'success-login' => [
            'tittle' => '¡Enhorabuena!',
            'text' => 'Ya tienes Internet',
        ] 
    ],
    'feedbacks' => "{
        'validationData': {
            'tiitle': 'Error de registro',
            'message': 'Por favor, revise los datos del formulario',
        },
    }",

];
