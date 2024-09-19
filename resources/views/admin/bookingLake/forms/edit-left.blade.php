<!-- <div class="col-12 col-md-9">
    <div class="card">
        <div class="card-header justify-content-between">
            <h2 class="mb-0">{{ __('Thông tin BookingLake') }}</h2>

        </div>
        <div class="row card-body">
            <div class="col-12">
            <div class="mb-3">
                <label class="control-label">{{ __('Mã booking') }}:</label>
                <x-select name="booking_id" >
    				@foreach ($joinbooking as $booking)
                        <option value="{{ $booking->id }}" selected>{{ $booking->id }}</option>
                    @endforeach
				</x-select>
            </div>
            <div class="col-12">
            <div class="mb-3">
                <label class="control-label">{{ __('Mã mật độ cá') }}:</label>
                <x-select name="variationFishs_id" >
    				@foreach ($joinvariationFishs as $variationFish)
                        <option value="{{ $variationFish->id }}" selected>{{ $variationFish->id }}</option>
                    @endforeach
				</x-select>
            </div>

        </div>
    </div>
</div> -->