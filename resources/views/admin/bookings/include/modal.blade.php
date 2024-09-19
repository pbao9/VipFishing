<x-form :action="route('admin.deposits.store')" type="post" id="formDepositFishPriceCollect">
    <div class="modal modal-blur fade" id="modal-simple" tabindex="-1" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header w-100">
                    <h5 class="modal-title">
                        <div class="d-flex justify-content-between gap-5">
                            <span>Tính tổng số giá cá thu</span>
                            <span class="d-flex align-items-center badge bg-cyan-lt">
                                <span>
                                    {{ number_format($bookings->lakechild['collect_fish_price'], 0, ',', '.') }} VNĐ /
                                </span>
                                {{ \App\Enums\Lakechilds\TypeFishBuy::getDescription($bookings->lakechild->collect_fish_type) }}
                            </span>
                        </div>
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <label class="mb-3">{{ __('Số tiền thu cá: ') }}<span id="total_price"></span> VNĐ</label>
                    {{-- Hidden field --}}
                    <input type="hidden" id="collect_fish_price"
                        value="{{ $bookings->lakechild->collect_fish_price }}">
                    <input type="hidden" name="user_id" value="{{ $bookings->user->id }}">
                    <input type="hidden" name="type" value="{{ \App\Enums\Deposits\DepositType::moneyFishs }}">
                    <input type="hidden" name="amount">
                    <input type="hidden" name="booking_id" value="{{ $bookings->id }}">
                    <input type="hidden" name="note" value="Tiền thu cá">
                    {{-- End Hidden field --}}
                    <div class="input-group mb-2">
                        <input type="number" id="collect_fish" name="collect_fish" class="form-control"
                            placeholder="Nhập số lượng thu được" autocomplete="off">
                        <span class="input-group-text">
                            {{ \App\Enums\Lakechilds\TypeFishBuy::getDescription($bookings->lakechild->collect_fish_type) }}
                        </span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn me-auto btn-danger" data-bs-dismiss="modal">Hủy</button>
                    <button type="submit" class="btn btn-success" data-bs-dismiss="modal"
                        form="formDepositFishPriceCollect">Thêm</button>
                </div>
            </div>
        </div>
    </div>
</x-form>
<script src="{{ asset('public/libs/jquery/jquery.min.js') }}"></script>
<script>
    $(document).ready(function() {
        function calculateTotal() {
            var collectFish = $('#collect_fish').val();
            var collectFishPrice = $('#collect_fish_price').val();
            var total = collectFish * collectFishPrice;

            $('#total_price').text(total.toLocaleString());
            $('input[name="amount"]').val(total);
        }

        $('#collect_fish').on('keyup', function() {
            calculateTotal();
        });

        calculateTotal();
    });
</script>
