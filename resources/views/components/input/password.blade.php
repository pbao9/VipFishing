<input type="password" 
{{ $attributes
    ->class(['form-control'])
    ->merge([
        'placeholder' => __('Mật khẩu')
    ])->merge($isRequired())
}}>