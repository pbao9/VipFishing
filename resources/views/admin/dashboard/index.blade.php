@extends('admin.layouts.master')

@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        {{ __('Trang chủ trình quản lý') }}
                    </h2>
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-header">
                            <h2>{{ __('Dashboard') }}</h2>
                        </div>
                        <div class="card-body">


                            <div class="col-12">
                                <div class="row row-cards">

                                    <div class="col-sm-6 col-lg-3">
                                        <div class="card card-sm">
                                            <div class="card-body">
                                                <div class="row align-items-center">
                                                    <div class="col-auto">
                                                        <i class="iconModuleMevivu ti ti-ship"></i>
                                                    </div>
                                                    <div class="col">
                                                        <div class="font-weight-medium">
                                                            <a href="lakes">QL NHÀ HỒ</a>
                                                        </div>
                                                        <div class="text-secondary">
                                                            Số lượng: {{ $rowCountLakes }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-lg-3">
                                        <div class="card card-sm">
                                            <div class="card-body">
                                                <div class="row align-items-center">
                                                    <div class="col-auto">
                                                        <i class="iconModuleMevivu ti ti-accessible"></i>
                                                    </div>
                                                    <div class="col">
                                                        <div class="font-weight-medium">
                                                            <a href="lakechilds">QL HỒ LẺ</a>
                                                        </div>
                                                        <div class="text-secondary">
                                                            Số lượng: {{ $rowCountLakechilds }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- <div class="col-sm-6 col-lg-3">
                                        <div class="card card-sm">
                                            <div class="card-body">
                                                <div class="row align-items-center">
                                                    <div class="col-auto">
                                                        <i class="iconModuleMevivu ti ti-fish"></i>
                                                    </div>
                                                    <div class="col">
                                                        <div class="font-weight-medium">
                                                            <a href="lakeFishs">QL CÁ THẢ</a>
                                                        </div>
                                                        <div class="text-secondary">
                                                            Số lượng: {{ $rowCountLakeFishs }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> --}}
                                    <div class="col-sm-6 col-lg-3">
                                        <div class="card card-sm">
                                            <div class="card-body">
                                                <div class="row align-items-center">
                                                    <div class="col-auto">
                                                        <i class="iconModuleMevivu ti ti-fish"></i>
                                                    </div>
                                                    <div class="col">
                                                        <div class="font-weight-medium">
                                                            <a href="fishs">QL CÁ</a>
                                                        </div>
                                                        <div class="text-secondary">
                                                            Số lượng: {{ $rowCountFishs }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-lg-3">
                                        <div class="card card-sm">
                                            <div class="card-body">
                                                <div class="row align-items-center">
                                                    <div class="col-auto">
                                                        <i class="iconModuleMevivu ti ti-chart-dots-3"></i>
                                                    </div>
                                                    <div class="col">
                                                        <div class="font-weight-medium">
                                                            <a href="variationFishs">QL MẬT ĐỘ CÁ</a>
                                                        </div>
                                                        <div class="text-secondary">
                                                            Số lượng: {{ $rowCountVariationFishs }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-lg-3">
                                        <div class="card card-sm">
                                            <div class="card-body">
                                                <div class="row align-items-center">
                                                    <div class="col-auto">
                                                        <i class="iconModuleMevivu ti ti-stars"></i>
                                                    </div>
                                                    <div class="col">
                                                        <div class="font-weight-medium">
                                                            <a href="ratings">QL ĐÁNH GIÁ</a>
                                                        </div>
                                                        <div class="text-secondary">
                                                            Số lượng: {{ $rowCountRatings }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-lg-3">
                                        <div class="card card-sm">
                                            <div class="card-body">
                                                <div class="row align-items-center">
                                                    <div class="col-auto">
                                                        <i class="iconModuleMevivu ti ti-badges"></i>
                                                    </div>
                                                    <div class="col">
                                                        <div class="font-weight-medium">
                                                            <a href="ranks">QL XẾP LOẠI</a>
                                                        </div>
                                                        <div class="text-secondary">
                                                            Số lượng: {{ $rowCountRanks }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-lg-3">
                                        <div class="card card-sm">
                                            <div class="card-body">
                                                <div class="row align-items-center">
                                                    <div class="col-auto">
                                                        <i class="iconModuleMevivu ti ti-cash"></i>
                                                    </div>
                                                    <div class="col">
                                                        <div class="font-weight-medium">
                                                            <a href="deposits">QL NẠP</a>
                                                        </div>
                                                        <div class="text-secondary">
                                                            Số lượng: {{ $rowCountDeposits }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-lg-3">
                                        <div class="card card-sm">
                                            <div class="card-body">
                                                <div class="row align-items-center">
                                                    <div class="col-auto">
                                                        <i class="iconModuleMevivu ti ti-history"></i>
                                                    </div>
                                                    <div class="col">
                                                        <div class="font-weight-medium">
                                                            <a href="transactionHistory">QL LỊCH SỬ GIAO DỊCH</a>
                                                        </div>
                                                        <div class="text-secondary">
                                                            Số lượng: {{ $rowCountTransactionHistory }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-lg-3">
                                        <div class="card card-sm">
                                            <div class="card-body">
                                                <div class="row align-items-center">
                                                    <div class="col-auto">
                                                        <i class="iconModuleMevivu ti ti-cash"></i>
                                                    </div>
                                                    <div class="col">
                                                        <div class="font-weight-medium">
                                                            <a href="balances">Số dư</a>
                                                        </div>
                                                        <div class="text-secondary">
                                                            Số lượng: {{ $rowCountBalances }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-lg-3">
                                        <div class="card card-sm">
                                            <div class="card-body">
                                                <div class="row align-items-center">
                                                    <div class="col-auto">
                                                        <i class="iconModuleMevivu ti ti-adjustments-alt"></i>
                                                    </div>
                                                    <div class="col">
                                                        <div class="font-weight-medium">
                                                            <a href="compensations">QL BỒI THƯỜNG</a>
                                                        </div>
                                                        <div class="text-secondary">
                                                            Số lượng: {{ $rowCountCompensations }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-lg-3">
                                        <div class="card card-sm">
                                            <div class="card-body">
                                                <div class="row align-items-center">
                                                    <div class="col-auto">
                                                        <i class="iconModuleMevivu ti ti-flower"></i>
                                                    </div>
                                                    <div class="col">
                                                        <div class="font-weight-medium">
                                                            <a href="commissionHistory">QL TIỀN HOA HỒNG</a>
                                                        </div>
                                                        <div class="text-secondary">
                                                            Số lượng: {{ $rowCountCommissionHistory }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-lg-3">
                                        <div class="card card-sm">
                                            <div class="card-body">
                                                <div class="row align-items-center">
                                                    <div class="col-auto">
                                                        <i class="iconModuleMevivu ti ti-wallet"></i>
                                                    </div>
                                                    <div class="col">
                                                        <div class="font-weight-medium">
                                                            <a href="banks">QL NGÂN HÀNG</a>
                                                        </div>
                                                        <div class="text-secondary">
                                                            Số lượng: {{ $rowCountBanks }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-lg-3">
                                        <div class="card card-sm">
                                            <div class="card-body">
                                                <div class="row align-items-center">
                                                    <div class="col-auto">
                                                        <i class="iconModuleMevivu ti ti-brand-booking"></i>
                                                    </div>
                                                    <div class="col">
                                                        <div class="font-weight-medium">
                                                            <a href="bookings">QL BOOKING</a>
                                                        </div>
                                                        <div class="text-secondary">
                                                            Số lượng: {{ $rowCountBookings }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-lg-3">
                                        <div class="card card-sm">
                                            <div class="card-body">
                                                <div class="row align-items-center">
                                                    <div class="col-auto">
                                                        <i class="iconModuleMevivu ti ti-asset"></i>
                                                    </div>
                                                    <div class="col">
                                                        <div class="font-weight-medium">
                                                            <a href="fishingSet">QL SUẤT CÂU</a>
                                                        </div>
                                                        <div class="text-secondary">
                                                            Số lượng: {{ $rowCountFishingSet }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-lg-3">
                                        <div class="card card-sm">
                                            <div class="card-body">
                                                <div class="row align-items-center">
                                                    <div class="col-auto">
                                                        <i class="iconModuleMevivu ti ti-bell"></i>
                                                    </div>
                                                    <div class="col">
                                                        <div class="font-weight-medium">
                                                            <a href="notifications">QL THÔNG BÁO</a>
                                                        </div>
                                                        <div class="text-secondary">
                                                            Số lượng: {{ $rowCountNotifications }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-lg-3">
                                        <div class="card card-sm">
                                            <div class="card-body">
                                                <div class="row align-items-center">
                                                    <div class="col-auto">
                                                        <i class="iconModuleMevivu ti ti-calendar-event"></i>
                                                    </div>
                                                    <div class="col">
                                                        <div class="font-weight-medium">
                                                            <a href="events">QL SỰ KIỆN</a>
                                                        </div>
                                                        <div class="text-secondary">
                                                            Số lượng: {{ $rowCountEvents }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-lg-3">
                                        <div class="card card-sm">
                                            <div class="card-body">
                                                <div class="row align-items-center">
                                                    <div class="col-auto">
                                                        <i class="iconModuleMevivu ti ti-calendar-event"></i>
                                                    </div>
                                                    <div class="col">
                                                        <div class="font-weight-medium">
                                                            <a href="lakeEvents">QL LƯU TRỮ SỰ KIỆN</a>
                                                        </div>
                                                        <div class="text-secondary">
                                                            Số lượng: {{ $rowCountLakeEvents }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-lg-3">
                                        <div class="card card-sm">
                                            <div class="card-body">
                                                <div class="row align-items-center">
                                                    <div class="col-auto">
                                                        <i class="iconModuleMevivu ti ti-package"></i>
                                                    </div>
                                                    <div class="col">
                                                        <div class="font-weight-medium">
                                                            <a href="userEvents">QL NHẬN QUÀ</a>
                                                        </div>
                                                        <div class="text-secondary">
                                                            Số lượng: {{ $rowCountUserEvents }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-lg-3">
                                        <div class="card card-sm">
                                            <div class="card-body">
                                                <div class="row align-items-center">
                                                    <div class="col-auto">
                                                        <i class="iconModuleMevivu ti ti-chart-area"></i>
                                                    </div>
                                                    <div class="col">
                                                        <div class="font-weight-medium">
                                                            <a href="userScores">QL ĐIỂM</a>
                                                        </div>
                                                        <div class="text-secondary">
                                                            Số lượng: {{ $rowCountUserScores }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>




                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
