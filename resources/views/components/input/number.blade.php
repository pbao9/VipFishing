<input type="text" 
{{ $attributes
    ->class(['form-control'])
    ->merge([
        'data-parsley-type' => 'number',
        'data-parsley-number-message' => __("Trường này phải là số."),
    ])->merge($isRequired())
}}>