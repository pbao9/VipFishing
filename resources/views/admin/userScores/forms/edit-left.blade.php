<div class="col-12 col-md-9">
    <div class="card">
        <div class="card-header justify-content-between">
            <h2 class="mb-0">{{ __('Thông tin UserScores') }}</h2>
           
        </div>
        <div class="row card-body">
            <!-- user_id -->
            <div class="col-12">
            <div class="mb-3">
                <label class="control-label">{{ __('Mã người dùng') }}:</label>
                <x-select name="user_id" >
    				<x-select-option :option="$userScores->user_id" value="" title="" />

				</x-select>
            </div>
        </div><!-- total_ccv -->
            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Tổng điểm CCV') }} :</label>
                    <x-input type="number" name="total_ccv" :value="$userScores->total_ccv" 
                         placeholder="{{ __('Tổng điểm CCV') }}" />
                </div>
            </div><!-- total_round -->
            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Tổng trận thi đấu') }} :</label>
                    <x-input type="number" name="total_round" :value="$userScores->total_round" 
                         placeholder="{{ __('Tổng trận thi đấu') }}" />
                </div>
            </div><!-- total_hcv -->
            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Tổng điểm HCV') }} :</label>
                    <x-input type="number" name="total_hcv" :value="$userScores->total_hcv" 
                         placeholder="{{ __('Tổng điểm HCV') }}" />
                </div>
            </div><!-- total_awards -->
            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Tổng phần thưởng') }} :</label>
                    <x-input type="number" name="total_awards" :value="$userScores->total_awards" 
                         placeholder="{{ __('Tổng phần thưởng') }}" />
                </div>
            </div><!-- total_lake -->
            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Tổng số hồ câu') }} :</label>
                    <x-input type="number" name="total_lake" :value="$userScores->total_lake" 
                         placeholder="{{ __('Tổng số hồ câu') }}" />
                </div>
            </div><!-- total_province -->
            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Tổng số tỉnh câu') }} :</label>
                    <x-input type="number" name="total_province" :value="$userScores->total_province" 
                         placeholder="{{ __('Tổng số tỉnh câu') }}" />
                </div>
            </div><!-- total_rating -->
            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Tổng số lượt đánh giá') }} :</label>
                    <x-input type="number" name="total_rating" :value="$userScores->total_rating" 
                         placeholder="{{ __('Tổng số lượt đánh giá') }}" />
                </div>
            </div>
          
        </div>
    </div>
</div>