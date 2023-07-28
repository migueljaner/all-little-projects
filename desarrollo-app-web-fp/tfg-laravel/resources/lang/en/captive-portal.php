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
            'button' => 'Enter by Registration',
            'o' => 'OR',
            'tittle' => 'Register Form'
        ],
        'name' => [
            'tittle' => 'Name',
            'placeholder' => 'Insert your name'
        ],
        'surname' => [
            'tittle' => 'Surname',
            'placeholder' => 'Insert your surnames'
        ],
        'email' => [
            'tittle' => 'Email',
            'placeholder' => 'Insert your email'
        ],
        'gender' => [
            'tittle' => 'Gender',
            'placeholder' => 'Insert your gender',
            'types' => [
                'man' => 'Man',
                'woman' => 'Woman',
            ],
        ],
        'birthdate' => [
            'tittle' => 'Birthdate',
            'placeholder' => 'Insert your birthdate'
        ],
        'back' => 'Back',
        'submit' => 'Submit',
        'clean' => 'Clean',
        'conditions' => 'I accept the <b>terms and <span id="conditions">conditions</span></b>',
        'conditions-minor' => "Do you have parental or legal guardian's permission?",
        'inhotel' => 'Are you in this hotel?',
        'inhotelYes' => 'Yes',
        'inhotelNo' => 'No',
        'numroom' => 'Insert your room number',
        'validations' => "{
            'name': {
                'empty': 'Please, insert your name',
                'minLength': '{value} is too short',
                'maxLength': '{value} is too long',
                'regexAZaz': '{value} is not a name',
            },
            'surname': {
                'empty': 'PLease, insert your surnames',
                'minLength': '{value} are too short',
                'maxLength': '{value} are too long',
                'regexAZaz': '{value} are not apellidos',
            },
            'email': {
                'empty': 'Please, insert your email',
                'email': '{value} is not an email',
            },
            'gender': {
                'empty': 'Please, select your gender',
            },
            'birthdate': {
                'empty': 'Please, select your birthdate',
            },
            'acceptConditions': {
                'checked': 'Please, accept the conditions',
            },
            'acceptConditionsMinor': {
                'checked': 'Please, indicate if you have permission from your legal guardian',
            },
        }",
    ],
    'modals' => [
        'conditions' => [
            'tittle' => 'Conditions',
        ],
        'validation-data' => [
            'text' => 'Validating your data',
        ],
        'success-login' => [
            'tittle' => 'Congratulations!',
            'text' => 'You already got Internet',
        ] 
    ],
    'feedbacks' => "{
        'validationData': {
            'tiitle': 'Registration error',
            'message': 'Please, revise the formulary data',
        },
    }",

];
