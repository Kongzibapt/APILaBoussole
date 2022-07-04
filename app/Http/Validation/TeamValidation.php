<?php

namespace App\Http\Validation;

class TeamValidation {

    public function rules() {
        return [
            'name' => ['required', 'string', 'max:40'],
        ];
    }

    public function messages(){
        return [
            'name.required' => 'Vous devez spécifier un nom d\'équipe',
            'name.string' => 'Vous devez entrez un nom d\'équipe',
            'name.max' => 'Votre nom d\'équipe dépasse la taille autorisée'
        ];
    }

}