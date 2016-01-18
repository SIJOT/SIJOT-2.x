<?php 

  return [
    
    /*
     | -----------------------------------------------------------------------------
     | Validation Language Lines
     | -----------------------------------------------------------------------------
     | 
     | The following language lines contain the default error messages used by
     | the validator class. Some of these rules have multiple versions such 
     | as the size rules. Feel free to tweak each of thse messages here.
     |
     */
     
     'accepted'             => '', 
     'active_url'           => '',
     'after'                => '', 
     'alpha'                => '', 
     'alpha_dash'           => '', 
     'alpha_num'            => '', 
     'array'                => '', 
     'before'               => '',
     'between'              => [
        'numeric' => '', 
        'file'    => '', 
        'string'  => '', 
        'array'   => '', 
     ], 
     'boolean'              => '', 
     'confirmed'            => '', 
     'date'                 => '', 
     'date_format'          => '',
     'different'            => '', 
     'digits'               => '', 
     'digits_between'       => '',
     'email'                => '', 
     'exists'               => '', 
     'filled'               => '', 
     'image'                => '', 
     'in'                   => '', 
     'integer'              => '', 
     'ip'                   => '', 
     'json'                 => '', 
     'max'                  => [
        'numeric' => '', 
        'file'    => '', 
        'string'  => '', 
        'array'   => '',
     ],
     'mimes'                => '', 
     'min'                  => [
        'numeric' => '', 
        'file'    => '', 
        'string'  => '', 
        'array'   => '',
     ],
     'not_in'               => '', 
     'numeric'              => '', 
     'regex'                => '', 
     'required'             => '', 
     'required_if'          => '', 
     'required_with'        => '', 
     'required_with_all'    => '', 
     'required_without'     => '', 
     'required_without_all' => '',
     'same'                 => '', 
     'size'                 => [
        'numeric' => '', 
        'file'    => '',
        'string'  => '', 
        'array'   => '',
     ],
     'string' => '', 
     'timezone' => '', 
     'unique' => '', 
     'url' => '', 
     
     /*
     | -----------------------------------------------------------------------------
     | Costum Validation Language Lines
     | -----------------------------------------------------------------------------
     |
     | Here you may specify costum validation messages for attributes using the 
     | convention "attribute.rule" to name the lines. This makes it quick to 
     | specify a specific custom language line for a givin attribute rule.
     |
     */
     
    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',    
        ],     
    ],
    
    /*
     | -----------------------------------------------------------------------------
     | Costum Validation attributes
     | -----------------------------------------------------------------------------
     |
     | The following language lines are used to swap attribute place-holders 
     | with something more reader friendly such as E-Mail Address instead
     | of "email". This simply helps us make messages a little cleaner.
     |
     */
     
    'attributes' => [],
    
  ]; 
