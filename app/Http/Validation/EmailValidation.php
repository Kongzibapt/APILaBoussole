<?php

namespace App\Http\Validation;

class EmailValidation {

    public function rules() {
        return [
            'email' => ['required', 'string', 'max:40'],
        ];
    }

    public function messages(){
        return [
            'email.required' => 'Vous devez spécifier un email',
            'email.string' => 'Vous devez entrez une adresse email',
            'email.max' => 'Votre email dépasse la taille autorisée'
        ];
    }

}