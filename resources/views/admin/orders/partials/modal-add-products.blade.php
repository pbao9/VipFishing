<div class="modal modal-blur fade" id="modalAddProduct" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('Thêm sản phẩm') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <x-input id="inputSearchProduct" name="search_product" :placeholder="__('Nhập từ khóa sản phẩm...')" />
                <div id="showSearchResultProduct" class="list-group list-group-flush mt-2 overflow-auto" style="max-height: 25rem">
                </div>
            </div>
            <div class="modal-footer text-end">
                <button type="button" class="btn" data-bs-dismiss="modal">{{ __('Đóng') }}</button>
            </div>
        </div>
    </div>
</div>
