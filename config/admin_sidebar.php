<?php

return [
    [
        'title' => 'Dashboard',
        'routeName' => 'admin.dashboard',
        'icon' => '<i class="ti ti-home"></i>',
        'roles' => [],
        'permissions' => ['mevivuDev'],
        'sub' => []
    ],
    [
        'title' => 'QL Nhà Hồ & Hồ Lẻ',
        'routeName' => null,
        'icon' => '<i class="ti ti-ship"></i>',
        'roles' => [],
        'permissions' => ['createLakes', 'viewLakes', 'updateLakes', 'deleteLakes'],
        'sub' => [
            [
                'title' => 'Thêm Nhà hồ',
                'routeName' => 'admin.lakes.create',
                'icon' => '<i class="ti ti-plus"></i>',
                'roles' => [],
                'permissions' => ['createLakes'],
            ],
            [
                'title' => 'DS Nhà hồ',
                'routeName' => 'admin.lakes.index',
                'icon' => '<i class="ti ti-list"></i>',
                'roles' => [],
                'permissions' => ['viewLakes'],
            ],
        ]
    ],
    [
        'title' => 'QL Cá',
        'routeName' => null,
        'icon' => '<i class="ti ti-fish"></i>',
        'roles' => [],
        'permissions' => ['createFishs', 'viewFishs', 'updateFishs', 'deleteFishs'],
        'sub' => [
            [
                'title' => 'Thêm Loại Cá',
                'routeName' => 'admin.fishs.create',
                'icon' => '<i class="ti ti-plus"></i>',
                'roles' => [],
                'permissions' => ['createFishs'],
            ],
            [
                'title' => 'DS Loại Cá',
                'routeName' => 'admin.fishs.index',
                'icon' => '<i class="ti ti-list"></i>',
                'roles' => [],
                'permissions' => ['viewFishs'],
            ],
        ],
    ],
    [
        'title' => 'QL Xếp loại',
        'routeName' => null,
        'icon' => '<i class="ti ti-badges"></i>',
        'roles' => [],
        'permissions' => ['createRanks', 'viewRanks', 'updateRanks', 'deleteRanks'],
        'sub' => [
            [
                'title' => 'DS Xếp loại',
                'routeName' => 'admin.ranks.index',
                'icon' => '<i class="ti ti-list"></i>',
                'roles' => [],
                'permissions' => ['viewRanks'],
            ]
        ]
    ],
    [
        'title' => 'QL Nạp & Rút',
        'routeName' => null,
        'icon' => '<i class="ti ti-cash"></i>',
        'roles' => [],
        'permissions' => ['createWithdraws', 'viewWithdraws', 'updateWithdraws', 'deleteWithdraws'],
        'sub' => [
            [
                'title' => 'Thêm lệnh Nạp',
                'routeName' => 'admin.deposits.create',
                'icon' => '<i class="ti ti-plus"></i>',
                'roles' => [],
                'permissions' => ['createDeposits'],
            ],
            [
                'title' => 'Thêm lệnh Rút',
                'routeName' => 'admin.withdraws.create',
                'icon' => '<i class="ti ti-plus"></i>',
                'roles' => [],
                'permissions' => ['createWithdraws'],
            ],
            [
                'title' => 'DS lệnh Nạp',
                'routeName' => 'admin.deposits.index',
                'icon' => '<i class="ti ti-list"></i>',
                'roles' => [],
                'permissions' => ['viewDeposits'],
                'bubble' => [
                    'key' => 'countPendingDeposit'
                ],
            ],
            [
                'title' => 'DS lệnh Rút',
                'routeName' => 'admin.withdraws.index',
                'icon' => '<i class="ti ti-list"></i>',
                'roles' => [],
                'permissions' => ['viewWithdraws'],
                'bubble' => [
                    'key' => 'countPendingWithdraw'
                ],
            ],
            [
                'title' => 'DS Lịch sử giao dịch',
                'routeName' => 'admin.transactionHistory.index',
                'icon' => '<i class="ti ti-list"></i>',
                'roles' => [],
                'permissions' => ['viewTransactionHistory'],
            ]
        ]
    ],
    [
        'title' => 'QL Bồi thường',
        'routeName' => null,
        'icon' => '<i class="ti ti-adjustments-alt"></i>',
        'roles' => [],
        'permissions' => ['createCompensations', 'viewCompensations', 'updateCompensations', 'deleteCompensations'],
        'sub' => [
            [
                'title' => 'DS Bồi thường',
                'routeName' => 'admin.compensations.index',
                'icon' => '<i class="ti ti-list"></i>',
                'roles' => [],
                'permissions' => ['viewCompensations'],
            ]
        ]
    ],
    [
        'title' => 'QL Tiền Hoa hồng',
        'routeName' => null,
        'icon' => '<i class="ti ti-flower"></i>',
        'roles' => [],
        'permissions' => ['createCommissionHistory', 'viewCommissionHistory', 'updateCommissionHistory', 'deleteCommissionHistory'],
        'sub' => [
            [
                'title' => 'DS Tiền Hoa hồng',
                'routeName' => 'admin.commissionHistory.index',
                'icon' => '<i class="ti ti-list"></i>',
                'roles' => [],
                'permissions' => ['viewCommissionHistory'],
            ]
        ]
    ],
    [
        'title' => 'QL Ngân hàng',
        'routeName' => null,
        'icon' => '<i class="ti ti-wallet"></i>',
        'roles' => [],
        'permissions' => ['createBanks', 'viewBanks', 'updateBanks', 'deleteBanks'],
        'sub' => [
            [
                'title' => 'Thêm Ngân hàng',
                'routeName' => 'admin.banks.create',
                'icon' => '<i class="ti ti-plus"></i>',
                'roles' => [],
                'permissions' => ['createBanks'],
            ],
            [
                'title' => 'DS Ngân hàng',
                'routeName' => 'admin.banks.index',
                'icon' => '<i class="ti ti-list"></i>',
                'roles' => [],
                'permissions' => ['viewBanks'],
            ]
        ]
    ],
    [
        'title' => 'QL Đơn đặt câu',
        'routeName' => null,
        'icon' => '<i class="ti ti-brand-booking"></i>',
        'roles' => [],
        'permissions' => ['createBookings', 'viewBookings', 'updateBookings', 'deleteBookings', 'viewBookingLake'],
        'sub' => [
            [
                'title' => 'Thêm Đơn đặt câu',
                'routeName' => 'admin.bookings.create',
                'icon' => '<i class="ti ti-plus"></i>',
                'roles' => [],
                'permissions' => ['createBookings'],
            ],
            [
                'title' => 'DS Đơn đặt câu',
                'routeName' => 'admin.bookings.index',
                'icon' => '<i class="ti ti-list"></i>',
                'roles' => [],
                'permissions' => ['viewBookings'],
            ],
            [
                'title' => 'QL Giá tiền đơn đặt câu',
                'routeName' => 'admin.bookingLake.index',
                'icon' => '<i class="ti ti-list"></i>',
                'roles' => [],
                'permissions' => ['viewBookingLake'],
            ]
        ]
    ],
    [
        'title' => 'QL Hồ đóng cửa',
        'routeName' => null,
        'icon' => '<i class="ti ti-alert-octagon"></i>',
        'roles' => [],
        'permissions' => ['createCloseLake', 'viewCloseLake', 'updateCloseLake', 'deleteCloseLake'],
        'sub' => [
            [
                'title' => 'Thêm Hồ đóng cửa',
                'routeName' => 'admin.closeLakes.create',
                'icon' => '<i class="ti ti-plus"></i>',
                'roles' => [],
                'permissions' => ['createCloseLake'],
            ],
            [
                'title' => 'DS Hồ đóng cửa',
                'routeName' => 'admin.closeLakes.index',
                'icon' => '<i class="ti ti-list"></i>',
                'roles' => [],
                'permissions' => ['viewCloseLake'],
            ]
        ]
    ],
    [
        'title' => 'QL Suất câu',
        'routeName' => null,
        'icon' => '<i class="ti ti-asset"></i>',
        'roles' => [],
        'permissions' => ['createFishingSet', 'viewFishingSet', 'updateFishingSet', 'deleteFishingSet'],
        'sub' => [
            [
                'title' => 'DS Suất câu',
                'routeName' => 'admin.fishingSet.index',
                'icon' => '<i class="ti ti-list"></i>',
                'roles' => [],
                'permissions' => ['viewFishingSet'],
            ]
        ]
    ],
    [
        'title' => 'QL Thông báo',
        'routeName' => null,
        'icon' => '<i class="ti ti-bell"></i>',
        'roles' => [],
        'permissions' => ['createNotifications', 'viewNotifications', 'updateNotifications', 'deleteNotifications'],
        'sub' => [
            [
                'title' => 'Thêm Thông báo',
                'routeName' => 'admin.notifications.create',
                'icon' => '<i class="ti ti-plus"></i>',
                'roles' => [],
                'permissions' => ['createNotifications'],
            ],
            [
                'title' => 'DS Thông báo',
                'routeName' => 'admin.notifications.index',
                'icon' => '<i class="ti ti-list"></i>',
                'roles' => [],
                'permissions' => ['viewNotifications'],
            ]
        ]
    ],
    [
        'title' => 'QL Lưu trữ Sự kiện',
        'routeName' => null,
        'icon' => '<i class="ti ti-calendar-event"></i>',
        'roles' => [],
        'permissions' => ['createEvents', 'viewEvents', 'updateEvents', 'deleteEvents'],
        'sub' => [
            [
                'title' => 'Thêm Sự kiện',
                'routeName' => 'admin.events.create',
                'icon' => '<i class="ti ti-plus"></i>',
                'roles' => [],
                'permissions' => ['createEvents'],
            ],
            [
                'title' => 'DS Sự kiện',
                'routeName' => 'admin.events.index',
                'icon' => '<i class="ti ti-list"></i>',
                'roles' => [],
                'permissions' => ['viewEvents'],
            ]
        ]
    ],
    [
        'title' => 'QL Nhận quà',
        'routeName' => null,
        'icon' => '<i class="ti ti-package"></i>',
        'roles' => [],
        'permissions' => [
            'viewUserEvents',
        ],
        'sub' => [
            [
                'title' => 'DS Nhận quà',
                'routeName' => 'admin.userEvents.index',
                'icon' => '<i class="ti ti-list"></i>',
                'roles' => [],
                'permissions' => ['viewUserEvents'],
            ]
        ]
    ],
    [
        'title' => 'Bài viết',
        'routeName' => null,
        'icon' => '<i class="ti ti-article"></i>',
        'roles' => [],
        'permissions' => ['createPost', 'viewPost', 'updatePost', 'deletePost'],
        'sub' => [
            [
                'title' => 'Thêm Bài viết',
                'routeName' => 'admin.post.create',
                'icon' => '<i class="ti ti-plus"></i>',
                'roles' => [],
                'permissions' => ['createPost'],
            ],
            [
                'title' => 'Thêm Chuyên mục',
                'routeName' => 'admin.post_category.create',
                'icon' => '<i class="ti ti-plus"></i>',
                'roles' => [],
                'permissions' => ['createPostCategory'],
            ],
            [
                'title' => 'DS Bài viết',
                'routeName' => 'admin.post.index',
                'icon' => '<i class="ti ti-list"></i>',
                'roles' => [],
                'permissions' => ['viewPost'],
            ],
            [
                'title' => 'DS Chuyên mục',
                'routeName' => 'admin.post_category.index',
                'icon' => '<i class="ti ti-list"></i>',
                'roles' => [],
                'permissions' => ['viewPostCategory'],
            ]
        ]
    ],
    [
        'title' => 'Cần thủ',
        'routeName' => null,
        'icon' => '<i class="ti ti-users"></i>',
        'roles' => [],
        'permissions' => ['createUser', 'viewUser', 'updateUser', 'deleteUser'],
        'sub' => [
            [
                'title' => 'Thêm Cần thủ',
                'routeName' => 'admin.user.create',
                'icon' => '<i class="ti ti-plus"></i>',
                'roles' => [],
                'permissions' => ['createUser'],
            ],
            [
                'title' => 'DS Cần thủ',
                'routeName' => 'admin.user.index',
                'icon' => '<i class="ti ti-list"></i>',
                'roles' => [],
                'permissions' => ['viewUser'],
            ],
        ]
    ],
    [
        'title' => 'Sliders',
        'routeName' => null,
        'icon' => '<i class="ti ti-slideshow"></i>',
        'roles' => [],
        'permissions' => ['createSlider', 'viewSlider', 'updateSlider', 'deleteSlider'],
        'sub' => [
            [
                'title' => 'Thêm Sliders',
                'routeName' => 'admin.slider.create',
                'icon' => '<i class="ti ti-plus"></i>',
                'roles' => [],
                'permissions' => ['createSlider'],
            ],
            [
                'title' => 'DS Sliders',
                'routeName' => 'admin.slider.index',
                'icon' => '<i class="ti ti-list"></i>',
                'roles' => [],
                'permissions' => ['viewSlider'],
            ],
        ]
    ],
    [
        'title' => 'Vai trò',
        'routeName' => null,
        'icon' => '<i class="ti ti-user-check"></i>',
        'roles' => [],
        'permissions' => ['createRole', 'viewRole', 'updateRole', 'deleteRole'],
        'sub' => [
            [
                'title' => 'Thêm Vai trò',
                'routeName' => 'admin.role.create',
                'icon' => '<i class="ti ti-plus"></i>',
                'roles' => [],
                'permissions' => ['createRole'],
            ],
            [
                'title' => 'DS Vai trò',
                'routeName' => 'admin.role.index',
                'icon' => '<i class="ti ti-list"></i>',
                'roles' => [],
                'permissions' => ['viewRole'],
            ]
        ]
    ],
    [
        'title' => 'Admin',
        'routeName' => null,
        'icon' => '<i class="ti ti-user-shield"></i>',
        'roles' => [],
        'permissions' => ['createAdmin', 'viewAdmin', 'updateAdmin', 'deleteAdmin'],
        'sub' => [
            [
                'title' => 'Thêm admin',
                'routeName' => 'admin.admin.create',
                'icon' => '<i class="ti ti-plus"></i>',
                'roles' => [],
                'permissions' => ['createAdmin'],
            ],
            [
                'title' => 'DS admin',
                'routeName' => 'admin.admin.index',
                'icon' => '<i class="ti ti-list"></i>',
                'roles' => [],
                'permissions' => ['viewAdmin'],
            ],
        ]
    ],
    [
        'title' => 'Cài đặt',
        'routeName' => null,
        'icon' => '<i class="ti ti-settings"></i>',
        'roles' => [],
        'permissions' => ['settingGeneral'],
        'sub' => [
            [
                'title' => 'Chung',
                'routeName' => 'admin.setting.general',
                'icon' => '<i class="ti ti-tool"></i>',
                'roles' => [],
                'permissions' => ['settingGeneral'],
            ],
            [
                'title' => 'Thành viên mua hàng',
                'routeName' => 'admin.setting.user_shopping',
                'icon' => '<i class="ti ti-user-cog"></i>',
                'roles' => [],
                'permissions' => [],
            ],
        ]
    ],
    [
        'title' => 'Dev: Quyền',
        'routeName' => null,
        'icon' => '<i class="ti ti-code"></i>',
        'roles' => [],
        'permissions' => ['mevivuDev'],
        'sub' => [
            [
                'title' => 'Thêm Quyền',
                'routeName' => 'admin.permission.create',
                'icon' => '<i class="ti ti-plus"></i>',
                'roles' => [],
                'permissions' => ['mevivuDev'],
            ],
            [
                'title' => 'DS Quyền',
                'routeName' => 'admin.permission.index',
                'icon' => '<i class="ti ti-list"></i>',
                'roles' => [],
                'permissions' => ['mevivuDev'],
            ]
        ]
    ],
    [
        'title' => 'Dev: Module',
        'routeName' => null,
        'icon' => '<i class="ti ti-code"></i>',
        'roles' => [],
        'permissions' => ['mevivuDev'],
        'sub' => [
            [
                'title' => 'Thêm Module',
                'routeName' => 'admin.module.create',
                'icon' => '<i class="ti ti-plus"></i>',
                'roles' => [],
                'permissions' => ['mevivuDev'],
            ],
            [
                'title' => 'DS Module',
                'routeName' => 'admin.module.index',
                'icon' => '<i class="ti ti-list"></i>',
                'roles' => [],
                'permissions' => ['mevivuDev'],
            ]
        ]
    ],
    [
        'title' => 'Dev: Nghiệm thu',
        'routeName' => 'admin.module.summary',
        'icon' => '<i class="ti ti-code"></i>',
        'roles' => [],
        'permissions' => ['mevivuDev'],
        'sub' => []
    ],
];
