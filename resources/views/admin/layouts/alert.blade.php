<script>
    $(document).ready(function(){
        @foreach($type as $value)
            @if($message = Session::get($value))
                $.toast({
                    heading: '{{ $title }}',
                    text: '{{ $message }}',
                    position: '{{ $position }}',
                    icon: '{{ $value }}'
                });
            @endif
        @endforeach
    
        @if (isset($errors) && $errors->any())
            @foreach($errors->all() as $val)
                $.toast({
                    heading: '{{ $title }}',
                    text: '{{ $val }}',
                    position: '{{ $position }}',
                    icon: 'warning',
                    hideAfter: 10000
                });
            @endforeach
        @endif
    
    });
</script>