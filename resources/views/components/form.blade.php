<form {{ $attributes->merge(['action' => $action, 'method' => $marcoMethod()]) }} {{ $isValidate() }}>
    
    @unless($type == 'GET')

        @csrf

        @unless($type == 'POST')

            @method($type)
            
        @endunless

    @endunless

    {{ $slot }}

</form>