<?php

use App\Enums\Bookings\BookingsStatus;
use App\Enums\Deposits\DepositsStatus;
use App\Enums\Deposits\DepositType;
use App\Enums\Events\EventsCondition;
use App\Enums\Events\EventStatus;
use App\Enums\Order\OrderStatus;
use App\Enums\PostCategory\PostCategoryStatus;
use App\Enums\Post\PostStatus;
use App\Enums\Module\ModuleStatus;
use App\Enums\Product\{ProductType, ProductVariationAction};
use App\Enums\Setting\SettingGroup;
use App\Enums\Slider\SliderStatus;
use App\Enums\TransactionHistory\TransactionHistoryType;
use App\Enums\User\{UserGender, UserVip, UserRoles};
use App\Enums\FishingRating\FishingRatingType;
use App\Enums\Lakes\{Dinner, Lunch, Toilet, StatusLake};
use App\Enums\Lakechilds\{TypeLakeChild, TypeFishBuy, LakechildsStatus};
use App\Enums\FishingSet\TypeFishingSet;
use App\Enums\Notifications\NotificationStatus;
use App\Enums\Ranks\RanksCommissionStatus;
use App\Enums\Ratings\RateStatus;
use App\Enums\Withdraws\WithdrawsStatus;

return [
    UserGender::class => [
        UserGender::Male => 'Nam',
        UserGender::Female => 'Nữ',
        UserGender::Other => 'Khác',
    ],
    UserVip::class => [
        UserVip::Default => 'Mặc định',
        UserVip::Bronze => 'Đồng',
        UserVip::Silver => 'Bạc',
        UserVip::Gold => 'Vàng',
        UserVip::Diamond => 'Kim cương',
    ],
    UserRoles::class => [
        UserRoles::Member => 'Thành viên',
    ],
    ProductType::class => [
        ProductType::Simple => 'Sản phẩm đơn giản',
        ProductType::Variable => 'Sản phẩm có biến thể'
    ],
    ProductVariationAction::class => [
        ProductVariationAction::AddSimple => 'Thêm biến thể',
        ProductVariationAction::AddFromAllVariations => 'Tạo biến thể từ tất cả thuộc tính'
    ],
    OrderStatus::class => [
        OrderStatus::Processing => 'Đang xử lý',
        OrderStatus::Processed => 'Đã xử lý',
        OrderStatus::Completed => 'Đã hoàn thành',
        OrderStatus::Cancelled => 'Đã hủy'
    ],
    SliderStatus::class => [
        SliderStatus::Active => 'Hoạt động',
        SliderStatus::Inactive => 'Ngưng hoạt động'
    ],
    SettingGroup::class => [
        SettingGroup::General => 'Chung',
        SettingGroup::UserDiscount => 'Chiếc khấu mua hàng theo cấp TV',
        SettingGroup::UserUpgrade => 'SL SP nâng cấp TV',
    ],
    PostCategoryStatus::class => [
        PostCategoryStatus::Published => 'Đã xuất bản',
        PostCategoryStatus::Draft => 'Bản nháp'
    ],
    PostStatus::class => [
        PostStatus::Published => 'Đã xuất bản',
        PostStatus::Draft => 'Bản nháp'
    ],
    ModuleStatus::class => [
        ModuleStatus::ChuaXong => 'Chưa xong',
        ModuleStatus::DaXong => 'Đã xong',
        ModuleStatus::DaDuyet => 'Đã duyệt'
    ],
    FishingRatingType::class => [
        FishingRatingType::Sang => 'Sáng 7-12',
        FishingRatingType::Chieu => 'Chiều 12-17',
        FishingRatingType::CaNgay => 'Cả ngày 7-17',
        FishingRatingType::TuDo => 'Tự do',
    ],

    Dinner::class => [
        Dinner::yes => 'Có',
        Dinner::no => 'Không',
    ],
    Lunch::class => [
        Lunch::yes => 'Có',
        Lunch::no => 'Không',
    ],
    Toilet::class => [
        Toilet::yes => 'Có',
        Toilet::no => 'Không',
    ],
    LakechildsStatus::class => [
        LakechildsStatus::active => 'Hoạt động',
        LakechildsStatus::inactive => 'Nghỉ',
        LakechildsStatus::closed => 'Tạm ngưng',
    ],
    TypeFishBuy::class => [
        TypeFishBuy::Kg => 'Kg',
        TypeFishBuy::Con => 'Con',
    ],
    TypeLakeChild::class => [
        TypeLakeChild::oneLake => 'oneLake',
        TypeLakeChild::twoLake => 'twoLake',
    ],
    TypeFishingSet::class => [
        TypeFishingSet::Sang => 'Sang',
        TypeFishingSet::Chieu => 'Chieu',
        TypeFishingSet::CaNgay => 'CaNgay',
        TypeFishingSet::TuDo => 'TuDo'
    ],
    WithdrawsStatus::class => [
        WithdrawsStatus::Pending => 'Chờ duyệt',
        WithdrawsStatus::Completed => 'Đã hoàn thành',
        WithdrawsStatus::Declined => 'Hủy',
    ],
    DepositsStatus::class => [
        DepositsStatus::Pending => 'Chờ duyệt',
        DepositsStatus::Completed => 'Đã hoàn thành'
    ],
    DepositType::class => [
        DepositType::moneyDeposit => 'Nạp tiền',
        DepositType::moneyFishs => 'Tiền thu cá',
        DepositType::moneyCommission => 'Tiền hoa hồng',
    ],
    TransactionHistoryType::class => [
        TransactionHistoryType::Withdraw => 'Rút',
        TransactionHistoryType::Deposit => 'Nạp',
        TransactionHistoryType::Commission => 'Hoa hồng',
        TransactionHistoryType::Compensation => 'Đền bù',
        TransactionHistoryType::Booking => 'Đặt câu',
        TransactionHistoryType::Refund => 'Hoàn tiền',
    ],
    BookingsStatus::class => [
        BookingsStatus::Unpaid => 'Chưa thanh toán',
        BookingsStatus::Paid => 'Đã thanh toán',
        BookingsStatus::Fishing => 'Đang câu',
        BookingsStatus::Completed => 'Hoàn thành',
        BookingsStatus::Cancelled => 'Đã hủy'
    ],
    RanksCommissionStatus::class => [
        RanksCommissionStatus::on => 'Đang bật',
        RanksCommissionStatus::off => 'Đang tắt',
    ],
    NotificationStatus::class => [
        NotificationStatus::Seen => 'Đã xem',
        NotificationStatus::Not_Seen => 'Chưa xem'
    ],
    EventStatus::class => [
        EventStatus::NotStarted => 'Chưa bắt đầu',
        EventStatus::Ongoing => 'Đang diễn ra',
        EventStatus::Paused => 'Tạm ngưng',
        EventStatus::Cancelled => 'Đã hủy',
        EventStatus::Finished => 'Đã kết thúc',
    ],

    StatusLake::class => [
        StatusLake::active => 'Hoạt động',
        StatusLake::inactive => 'Nghỉ',
        StatusLake::close => 'Đóng cửa'
    ],

    RateStatus::class => [
        RateStatus::satisfied => 'Hài lòng',
        RateStatus::notSatisfied => 'Không hài lòng'
    ],
    EventsCondition::class => [
        EventsCondition::no => 'Không',
        EventsCondition::yes => 'Có'
    ],
];
