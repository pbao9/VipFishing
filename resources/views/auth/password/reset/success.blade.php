@extends('admin.layouts.guest.master')

@section('content')
    <div class="page page-center">
        <div class="container-tight py-4">
            <div class="text-center mb-4">
                <img src="{{ asset(config('custom.images.logo')) }}" width="200" alt="">
            </div>
            <div class="card">
                <div class="empty">
                    <div class="empty-img"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-circle-check-filled text-success" style="width: 100px; height: 100px;" width="100" height="100" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M17 3.34a10 10 0 1 1 -14.995 8.984l-.005 -.324l.005 -.324a10 10 0 0 1 14.995 -8.336zm-1.293 5.953a1 1 0 0 0 -1.32 -.083l-.094 .083l-3.293 3.292l-1.293 -1.292l-.094 -.083a1 1 0 0 0 -1.403 1.403l.083 .094l2 2l.094 .083a1 1 0 0 0 1.226 0l.094 -.083l4 -4l.083 -.094a1 1 0 0 0 -.083 -1.32z" stroke-width="0" fill="currentColor"></path>
                     </svg>
                    </div>
                    <p class="empty-title text-success">{{ __('Thành công') }}</p>
                    <p class="empty-subtitle text-muted">
                        {{ __('Bạn đã lấy lại mật khẩu thành công.') }}
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
