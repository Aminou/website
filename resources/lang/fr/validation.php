<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted'             => ':attribute doit etre accepté.',
    'active_url'           => ':attribute n\'est pas une url valide.',
    'after'                => ':attribute doit etre une date après :date.',
    'after_or_equal'       => ':attribute doit etre une date après ou égale à :date.',
    'alpha'                => ':attribute ne doit contenir que des lettres.',
    'alpha_dash'           => ':attribute ne peut contenir que des lettres, chiffres, et tirets.',
    'alpha_num'            => ':attribute ne peut contenir que des lettres et des chiffres.',
    'array'                => ':attribute doit etre un tableau.',
    'before'               => ':attribute doit etre une date avant :date.',
    'before_or_equal'      => ':attribute doit etre une date avant ou égale à :date.',
    'between'              => [
        'numeric' => ':attribute doit etre entre :min et :max.',
        'file'    => ':attribute doit peser entre :min et :max kilobytes.',
        'string'  => ':attribute doit etre entre :min et :max caractères.',
        'array'   => ':attribute must have between :min and :max items.',
    ],
    'boolean'              => 'The :attribute field must be true or false.',
    'confirmed'            => 'The :attribute confirmation does not match.',
    'date'                 => 'The :attribute is not a valid date.',
    'date_format'          => 'The :attribute does not match the format :format.',
    'different'            => 'The :attribute and :other must be different.',
    'digits'               => 'The :attribute must be :digits digits.',
    'digits_between'       => 'The :attribute must be between :min and :max digits.',
    'dimensions'           => 'The :attribute has invalid image dimensions.',
    'distinct'             => 'The :attribute field has a duplicate value.',
    'email'                => 'The :attribute must be a valid email address.',
    'exists'               => 'The selected :attribute is invalid.',
    'file'                 => 'The :attribute must be a file.',
    'filled'               => 'The :attribute field must have a value.',
    'image'                => 'The :attribute must be an image.',
    'in'                   => 'The selected :attribute is invalid.',
    'in_array'             => 'The :attribute field does not exist in :other.',
    'integer'              => 'The :attribute must be an integer.',
    'ip'                   => 'The :attribute must be a valid IP address.',
    'ipv4'                 => 'The :attribute must be a valid IPv4 address.',
    'ipv6'                 => 'The :attribute must be a valid IPv6 address.',
    'json'                 => 'The :attribute must be a valid JSON string.',
    'max'                  => [
        'numeric' => 'Le champ :attribute ne peut être plus grand que :max.',
        'file'    => 'Le champ :attribute ne peut être plus grand que :max kilobytes.',
        'string'  => 'le champ :attribute ne peut être plus grand que :max caractères.',
        'array'   => 'Le tableau :attribute ne peut être plus grand que :max éléments.',
    ],
    'mimes'                => 'Le champ :attribute doit etre un fichier de type: :values.',
    'mimetypes'            => 'Le champ :attribute doit etre un fichier de type: :values.',
    'min'                  => [
        'numeric' => 'Le champ :attribute doit etre au moins égale à :min.',
        'file'    => 'Le champ :attribute doit être au moins égale à :min kilobytes.',
        'string'  => 'Le champ :attribute doit au moins contenir :min caractères.',
        'array'   => 'Le tableau :attribute doit au moins contenir :min éléments.',
    ],
    'not_in'               => 'Le champ séléctioné :attribute n\'est pas valide.',
    'numeric'              => 'Le champ :attribute doit etre un chiffre.',
    'present'              => 'Le champ :attribute doit etre renseigné.',
    'regex'                => 'Le format de :attribute n\'est pas valide.',
    'required'             => 'Le champ :attribute est requis.',
    'required_if'          => 'Le champ :attribute est requis quand :other est :value.',
    'required_unless'      => 'Le champ :attribute est requis sauf si :other est a égale à :values.',
    'required_with'        => 'Le champ :attribute est requis lorsque :values est présent.',
    'required_with_all'    => 'Le champ :attribute est requis lorsque :values est présent.',
    'required_without'     => 'Le champ :attribute est requis lorsque :values n\'est pas présent.',
    'required_without_all' => 'Le champ :attribute est requis lorsque aucune valeur de :values est présente.',
    'same'                 => 'Le champ :attribute et :other doivent etre égaux.',
    'size'                 => [
        'numeric' => ':attribute doit être :size.',
        'file'    => ':attribute doit être :size kilobytes.',
        'string'  => ':attribute doit être be :size characters.',
        'array'   => ':attribute doit contenir :size éléments.',
    ],
    'string'               => ':attribute doit etre une chaine de caractères.',
    'timezone'             => ':attribute doit etre un fuseau horaire valide.',
    'unique'               => ':attribute existe déja.',
    'uploaded'             => ':attribute l\'upload a échoué.',
    'url'                  => ':attribute n\'est pas une url valide.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [],

];
