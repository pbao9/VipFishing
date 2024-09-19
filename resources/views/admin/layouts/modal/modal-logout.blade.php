<div class="modal modal-blur fade" id="modalLogout" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="modal-title">{{ __('Bạn có chắc?') }}</div>
                <div>{{ __('Nếu bạn tiếp tục, bạn sẽ đăng xuất khỏi hệ thống.') }}</div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link link-secondary me-auto"
                    data-bs-dismiss="modal">{{ __('Hủy') }}</button>
                <x-form :action="route('admin.logout')" type="post">
                    <button type="submit" class="btn btn-danger">{{ __('Đăng xuất') }}</button>
                </x-form>
            </div>
        </div>
    </div>
</div>