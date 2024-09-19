<input type="email" 
{{ $attributes
    ->class(['form-control'])
    ->merge([
        'placeholder' => __('Email'),
        'data-parsley-type-message' => __('Trường này phải là email.')
    ])->merge($isRequired())
}}>