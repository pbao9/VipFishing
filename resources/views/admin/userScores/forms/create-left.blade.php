<div class="col-12 col-md-9">
    <div class="card">
        <div class="card-header justify-content-center">
            <h2 class="mb-0">{{ __('Thông tin UserScores') }}</h2>
        </div>
        <div class="row card-body">
        <!-- user_id -->
            <div class="col-12">
            <div class="mb-3">
                <label class="control-label">{{ __('Mã người dùng') }}:</label>
                <x-select name="user_id" >
    				<x-select-option value="" title="" />

				</x-select>
            </div>
        </div><!-- total_ccv -->
            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Tổng điểm CCV') }} :</label>
                    <x-input type="number" name="total_ccv" :value="old('total_ccv')" 
                         placeholder="{{ __('Tổng điểm CCV') }}" />
                </div>
            </div><!-- total_round -->
            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Tổng trận thi đấu') }} :</label>
                    <x-input type="number" name="total_round" :value="old('total_round')" 
                         placeholder="{{ __('Tổng trận thi đấu') }}" />
                </div>
            </div><!-- total_hcv -->
            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Tổng điểm HCV') }} :</label>
                    <x-input type="number" name="total_hcv" :value="old('total_hcv')" 
                         placeholder="{{ __('Tổng điểm HCV') }}" />
                </div>
            </div><!-- total_awards -->
            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Tổng phần thưởng') }} :</label>
                    <x-input type="number" name="total_awards" :value="old('total_awards')" 
                         placeholder="{{ __('Tổng phần thưởng') }}" />
                </div>
            </div><!-- total_lake -->
            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Tổng số hồ câu') }} :</label>
                    <x-input type="number" name="total_lake" :value="old('total_lake')" 
                         placeholder="{{ __('Tổng số hồ câu') }}" />
                </div>
            </div><!-- total_province -->
            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Tổng số tỉnh câu') }} :</label>
                    <x-input type="number" name="total_province" :value="old('total_province')" 
                         placeholder="{{ __('Tổng số tỉnh câu') }}" />
                </div>
            </div><!-- total_rating -->
            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Tổng số lượt đánh giá') }} :</label>
                    <x-input type="number" name="total_rating" :value="old('total_rating')" 
                         placeholder="{{ __('Tổng số lượt đánh giá') }}" />
                </div>
            </div>

        </div>
    </div>
</div>