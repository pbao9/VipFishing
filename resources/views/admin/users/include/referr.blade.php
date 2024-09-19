@if ($user->refer->isNotEmpty())
    <div class="card-body">
        <div class="accordion" id="accordion-example">
            @foreach ($user->refer as $item)
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading-{{ $item->id }}">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapse-{{ $item->id }}" aria-expanded="false">
                            <div class="d-flex justify-content-between align-items-center w-100">
                                <span class="px-3 d-flex align-items-center gap-1">
                                    {{ $item->fullname }}
                                    <span class="badge bg-red-lt">
                                        Reference Fixed
                                    </span>
                                </span>
                                <span
                                    class="px-3">{{ __('Ngày tham gia : ') }}{{ $item->created_at->format('d/m/Y') }}</span>
                            </div>
                        </button>
                    </h2>
                    <div id="collapse-{{ $item->id }}" class="accordion-collapse collapse">
                        <div class="accordion-body pt-0">
                            <div class="card p-2">
                                <div class="card-header d-flex justify-content-between algin-items-center">
                                    <div class="card-title align-items-center justify-content-between">
                                        <div class="group d-flex align-items-center gap-2">
                                            <span class="avatar"
                                                style="background-image: url({{ asset($item->avatar) }})"></span>
                                            <span>{{ $item->fullname }}</span>
                                        </div>

                                    </div>
                                    <span>{{ __('Xếp loại:') . ' ' . $item->rank->title }}</span>
                                </div>
                                <div class="card-body">
                                    <p>{{ __('Số điện thoại: ') . '' . $item->phone }}</p>

                                    <p>{{ __('Email: ') . ' ' . $item->email }}</p>
                                    <p>{{ __('Biệt danh: ') . '' . $item->nickname }}</p>
                                    <p>{{ __('Địa chỉ: ') . '' . $item->address }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            @foreach ($user->refer_1 as $item)
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading-{{ $item->id }}">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapse-{{ $item->id }}" aria-expanded="false">
                            <div class="d-flex justify-content-between align-items-center w-100">
                                <span class="px-3 d-flex align-items-center gap-1">
                                    {{ $item->fullname }}
                                    <span class="badge bg-success-lt">
                                        Reference 1
                                    </span>
                                </span>
                                <span
                                    class="px-3">{{ __('Ngày tham gia : ') }}{{ $item->created_at->format('d/m/Y') }}</span>
                            </div>
                        </button>
                    </h2>
                    <div id="collapse-{{ $item->id }}" class="accordion-collapse collapse">
                        <div class="accordion-body pt-0">
                            <div class="card p-2">
                                <div class="card-header d-flex justify-content-between algin-items-center">
                                    <div class="card-title align-items-center justify-content-between">
                                        <div class="group d-flex align-items-center gap-2">
                                            <span class="avatar"
                                                style="background-image: url({{ asset($item->avatar) }})"></span>
                                            <span>{{ $item->fullname }}</span>
                                        </div>

                                    </div>
                                    <span>{{ __('Xếp loại:') . ' ' . $item->rank->title }}</span>
                                </div>
                                <div class="card-body">
                                    <p>{{ __('Số điện thoại: ') . '' . $item->phone }}</p>

                                    <p>{{ __('Email: ') . ' ' . $item->email }}</p>
                                    <p>{{ __('Biệt danh: ') . '' . $item->nickname }}</p>
                                    <p>{{ __('Địa chỉ: ') . '' . $item->address }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            @foreach ($user->refer_2 as $item)
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading-{{ $item->id }}">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapse-{{ $item->id }}" aria-expanded="false">
                            <div class="d-flex justify-content-between align-items-center w-100">
                                <span class="px-3 d-flex align-items-center gap-1">
                                    {{ $item->fullname }}
                                    <span class="badge bg-cyan-lt">
                                        Reference 2
                                    </span>
                                </span>
                                <span
                                    class="px-3">{{ __('Ngày tham gia : ') }}{{ $item->created_at->format('d/m/Y') }}</span>
                            </div>
                        </button>
                    </h2>
                    <div id="collapse-{{ $item->id }}" class="accordion-collapse collapse">
                        <div class="accordion-body pt-0">
                            <div class="card p-2">
                                <div class="card-header d-flex justify-content-between algin-items-center">
                                    <div class="card-title align-items-center justify-content-between">
                                        <div class="group d-flex align-items-center gap-2">
                                            <span class="avatar"
                                                style="background-image: url({{ asset($item->avatar) }})"></span>
                                            <span>{{ $item->fullname }}</span>
                                        </div>

                                    </div>
                                    <span>{{ __('Xếp loại:') . ' ' . $item->rank->title }}</span>
                                </div>
                                <div class="card-body">
                                    <p>{{ __('Số điện thoại: ') . '' . $item->phone }}</p>

                                    <p>{{ __('Email: ') . ' ' . $item->email }}</p>
                                    <p>{{ __('Biệt danh: ') . '' . $item->nickname }}</p>
                                    <p>{{ __('Địa chỉ: ') . '' . $item->address }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            @foreach ($user->refer_3 as $item)
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading-{{ $item->id }}">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapse-{{ $item->id }}" aria-expanded="false">
                            <div class="d-flex justify-content-between align-items-center w-100">
                                <span class="px-3 d-flex align-items-center gap-1">
                                    {{ $item->fullname }}
                                    <span class="badge bg-purple-lt">
                                        Reference 3
                                    </span>
                                </span>
                                <span
                                    class="px-3">{{ __('Ngày tham gia : ') }}{{ $item->created_at->format('d/m/Y') }}</span>
                            </div>
                        </button>
                    </h2>
                    <div id="collapse-{{ $item->id }}" class="accordion-collapse collapse">
                        <div class="accordion-body pt-0">
                            <div class="card p-2">
                                <div class="card-header d-flex justify-content-between algin-items-center">
                                    <div class="card-title align-items-center justify-content-between">
                                        <div class="group d-flex align-items-center gap-2">
                                            <span class="avatar"
                                                style="background-image: url({{ asset($item->avatar) }})"></span>
                                            <span>{{ $item->fullname }}</span>
                                        </div>

                                    </div>
                                    <span>{{ __('Xếp loại:') . ' ' . $item->rank->title }}</span>
                                </div>
                                <div class="card-body">
                                    <p>{{ __('Số điện thoại: ') . '' . $item->phone }}</p>

                                    <p>{{ __('Email: ') . ' ' . $item->email }}</p>
                                    <p>{{ __('Biệt danh: ') . '' . $item->nickname }}</p>
                                    <p>{{ __('Địa chỉ: ') . '' . $item->address }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@elseif ($user->refer_1->isNotEmpty())
    <div class="card-body">
        <div class="accordion" id="accordion-example">
            @foreach ($user->refer as $item)
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading-{{ $item->id }}">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapse-{{ $item->id }}" aria-expanded="false">
                            <div class="d-flex justify-content-between align-items-center w-100">
                                <span class="px-3 d-flex align-items-center gap-1">
                                    {{ $item->fullname }}
                                    <span class="badge bg-red-lt">
                                        Reference Fixed
                                    </span>
                                </span>
                                <span
                                    class="px-3">{{ __('Ngày tham gia : ') }}{{ $item->created_at->format('d/m/Y') }}</span>
                            </div>
                        </button>
                    </h2>
                    <div id="collapse-{{ $item->id }}" class="accordion-collapse collapse">
                        <div class="accordion-body pt-0">
                            <div class="card p-2">
                                <div class="card-header d-flex justify-content-between algin-items-center">
                                    <div class="card-title align-items-center justify-content-between">
                                        <div class="group d-flex align-items-center gap-2">
                                            <span class="avatar"
                                                style="background-image: url({{ asset($item->avatar) }})"></span>
                                            <span>{{ $item->fullname }}</span>
                                        </div>

                                    </div>
                                    <span>{{ __('Xếp loại:') . ' ' . $item->rank->title }}</span>
                                </div>
                                <div class="card-body">
                                    <p>{{ __('Số điện thoại: ') . '' . $item->phone }}</p>

                                    <p>{{ __('Email: ') . ' ' . $item->email }}</p>
                                    <p>{{ __('Biệt danh: ') . '' . $item->nickname }}</p>
                                    <p>{{ __('Địa chỉ: ') . '' . $item->address }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            @foreach ($user->refer_1 as $item)
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading-{{ $item->id }}">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapse-{{ $item->id }}" aria-expanded="false">
                            <div class="d-flex justify-content-between align-items-center w-100">
                                <span class="px-3 d-flex align-items-center gap-1">
                                    {{ $item->fullname }}
                                    <span class="badge bg-success-lt">
                                        Reference 1
                                    </span>
                                </span>
                                <span
                                    class="px-3">{{ __('Ngày tham gia : ') }}{{ $item->created_at->format('d/m/Y') }}</span>
                            </div>
                        </button>
                    </h2>
                    <div id="collapse-{{ $item->id }}" class="accordion-collapse collapse">
                        <div class="accordion-body pt-0">
                            <div class="card p-2">
                                <div class="card-header d-flex justify-content-between algin-items-center">
                                    <div class="card-title align-items-center justify-content-between">
                                        <div class="group d-flex align-items-center gap-2">
                                            <span class="avatar"
                                                style="background-image: url({{ asset($item->avatar) }})"></span>
                                            <span>{{ $item->fullname }}</span>
                                        </div>

                                    </div>
                                    <span>{{ __('Xếp loại:') . ' ' . $item->rank->title }}</span>
                                </div>
                                <div class="card-body">
                                    <p>{{ __('Số điện thoại: ') . '' . $item->phone }}</p>

                                    <p>{{ __('Email: ') . ' ' . $item->email }}</p>
                                    <p>{{ __('Biệt danh: ') . '' . $item->nickname }}</p>
                                    <p>{{ __('Địa chỉ: ') . '' . $item->address }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            @foreach ($user->refer_2 as $item)
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading-{{ $item->id }}">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapse-{{ $item->id }}" aria-expanded="false">
                            <div class="d-flex justify-content-between align-items-center w-100">
                                <span class="px-3 d-flex align-items-center gap-1">
                                    {{ $item->fullname }}
                                    <span class="badge bg-cyan-lt">
                                        Reference 2
                                    </span>
                                </span>
                                <span
                                    class="px-3">{{ __('Ngày tham gia : ') }}{{ $item->created_at->format('d/m/Y') }}</span>
                            </div>
                        </button>
                    </h2>
                    <div id="collapse-{{ $item->id }}" class="accordion-collapse collapse">
                        <div class="accordion-body pt-0">
                            <div class="card p-2">
                                <div class="card-header d-flex justify-content-between algin-items-center">
                                    <div class="card-title align-items-center justify-content-between">
                                        <div class="group d-flex align-items-center gap-2">
                                            <span class="avatar"
                                                style="background-image: url({{ asset($item->avatar) }})"></span>
                                            <span>{{ $item->fullname }}</span>
                                        </div>

                                    </div>
                                    <span>{{ __('Xếp loại:') . ' ' . $item->rank->title }}</span>
                                </div>
                                <div class="card-body">
                                    <p>{{ __('Số điện thoại: ') . '' . $item->phone }}</p>

                                    <p>{{ __('Email: ') . ' ' . $item->email }}</p>
                                    <p>{{ __('Biệt danh: ') . '' . $item->nickname }}</p>
                                    <p>{{ __('Địa chỉ: ') . '' . $item->address }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            @foreach ($user->refer_3 as $item)
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading-{{ $item->id }}">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapse-{{ $item->id }}" aria-expanded="false">
                            <div class="d-flex justify-content-between align-items-center w-100">
                                <span class="px-3 d-flex align-items-center gap-1">
                                    {{ $item->fullname }}
                                    <span class="badge bg-purple-lt">
                                        Reference 3
                                    </span>
                                </span>
                                <span
                                    class="px-3">{{ __('Ngày tham gia : ') }}{{ $item->created_at->format('d/m/Y') }}</span>
                            </div>
                        </button>
                    </h2>
                    <div id="collapse-{{ $item->id }}" class="accordion-collapse collapse">
                        <div class="accordion-body pt-0">
                            <div class="card p-2">
                                <div class="card-header d-flex justify-content-between algin-items-center">
                                    <div class="card-title align-items-center justify-content-between">
                                        <div class="group d-flex align-items-center gap-2">
                                            <span class="avatar"
                                                style="background-image: url({{ asset($item->avatar) }})"></span>
                                            <span>{{ $item->fullname }}</span>
                                        </div>

                                    </div>
                                    <span>{{ __('Xếp loại:') . ' ' . $item->rank->title }}</span>
                                </div>
                                <div class="card-body">
                                    <p>{{ __('Số điện thoại: ') . '' . $item->phone }}</p>

                                    <p>{{ __('Email: ') . ' ' . $item->email }}</p>
                                    <p>{{ __('Biệt danh: ') . '' . $item->nickname }}</p>
                                    <p>{{ __('Địa chỉ: ') . '' . $item->address }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@elseif ($user->refer_2->isNotEmpty())
    <div class="card-body">
        <div class="accordion" id="accordion-example">
            @foreach ($user->refer as $item)
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading-{{ $item->id }}">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapse-{{ $item->id }}" aria-expanded="false">
                            <div class="d-flex justify-content-between align-items-center w-100">
                                <span class="px-3 d-flex align-items-center gap-1">
                                    {{ $item->fullname }}
                                    <span class="badge bg-red-lt">
                                        Reference Fixed
                                    </span>
                                </span>
                                <span
                                    class="px-3">{{ __('Ngày tham gia : ') }}{{ $item->created_at->format('d/m/Y') }}</span>
                            </div>
                        </button>
                    </h2>
                    <div id="collapse-{{ $item->id }}" class="accordion-collapse collapse">
                        <div class="accordion-body pt-0">
                            <div class="card p-2">
                                <div class="card-header d-flex justify-content-between algin-items-center">
                                    <div class="card-title align-items-center justify-content-between">
                                        <div class="group d-flex align-items-center gap-2">
                                            <span class="avatar"
                                                style="background-image: url({{ asset($item->avatar) }})"></span>
                                            <span>{{ $item->fullname }}</span>
                                        </div>

                                    </div>
                                    <span>{{ __('Xếp loại:') . ' ' . $item->rank->title }}</span>
                                </div>
                                <div class="card-body">
                                    <p>{{ __('Số điện thoại: ') . '' . $item->phone }}</p>

                                    <p>{{ __('Email: ') . ' ' . $item->email }}</p>
                                    <p>{{ __('Biệt danh: ') . '' . $item->nickname }}</p>
                                    <p>{{ __('Địa chỉ: ') . '' . $item->address }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            @foreach ($user->refer_1 as $item)
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading-{{ $item->id }}">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapse-{{ $item->id }}" aria-expanded="false">
                            <div class="d-flex justify-content-between align-items-center w-100">
                                <span class="px-3 d-flex align-items-center gap-1">
                                    {{ $item->fullname }}
                                    <span class="badge bg-success-lt">
                                        Reference 1
                                    </span>
                                </span>
                                <span
                                    class="px-3">{{ __('Ngày tham gia : ') }}{{ $item->created_at->format('d/m/Y') }}</span>
                            </div>
                        </button>
                    </h2>
                    <div id="collapse-{{ $item->id }}" class="accordion-collapse collapse">
                        <div class="accordion-body pt-0">
                            <div class="card p-2">
                                <div class="card-header d-flex justify-content-between algin-items-center">
                                    <div class="card-title align-items-center justify-content-between">
                                        <div class="group d-flex align-items-center gap-2">
                                            <span class="avatar"
                                                style="background-image: url({{ asset($item->avatar) }})"></span>
                                            <span>{{ $item->fullname }}</span>
                                        </div>

                                    </div>
                                    <span>{{ __('Xếp loại:') . ' ' . $item->rank->title }}</span>
                                </div>
                                <div class="card-body">
                                    <p>{{ __('Số điện thoại: ') . '' . $item->phone }}</p>

                                    <p>{{ __('Email: ') . ' ' . $item->email }}</p>
                                    <p>{{ __('Biệt danh: ') . '' . $item->nickname }}</p>
                                    <p>{{ __('Địa chỉ: ') . '' . $item->address }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            @foreach ($user->refer_2 as $item)
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading-{{ $item->id }}">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapse-{{ $item->id }}" aria-expanded="false">
                            <div class="d-flex justify-content-between align-items-center w-100">
                                <span class="px-3 d-flex align-items-center gap-1">
                                    {{ $item->fullname }}
                                    <span class="badge bg-cyan-lt">
                                        Reference 2
                                    </span>
                                </span>
                                <span
                                    class="px-3">{{ __('Ngày tham gia : ') }}{{ $item->created_at->format('d/m/Y') }}</span>
                            </div>
                        </button>
                    </h2>
                    <div id="collapse-{{ $item->id }}" class="accordion-collapse collapse">
                        <div class="accordion-body pt-0">
                            <div class="card p-2">
                                <div class="card-header d-flex justify-content-between algin-items-center">
                                    <div class="card-title align-items-center justify-content-between">
                                        <div class="group d-flex align-items-center gap-2">
                                            <span class="avatar"
                                                style="background-image: url({{ asset($item->avatar) }})"></span>
                                            <span>{{ $item->fullname }}</span>
                                        </div>

                                    </div>
                                    <span>{{ __('Xếp loại:') . ' ' . $item->rank->title }}</span>
                                </div>
                                <div class="card-body">
                                    <p>{{ __('Số điện thoại: ') . '' . $item->phone }}</p>

                                    <p>{{ __('Email: ') . ' ' . $item->email }}</p>
                                    <p>{{ __('Biệt danh: ') . '' . $item->nickname }}</p>
                                    <p>{{ __('Địa chỉ: ') . '' . $item->address }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            @foreach ($user->refer_3 as $item)
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading-{{ $item->id }}">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapse-{{ $item->id }}" aria-expanded="false">
                            <div class="d-flex justify-content-between align-items-center w-100">
                                <span class="px-3 d-flex align-items-center gap-1">
                                    {{ $item->fullname }}
                                    <span class="badge bg-purple-lt">
                                        Reference 3
                                    </span>
                                </span>
                                <span
                                    class="px-3">{{ __('Ngày tham gia : ') }}{{ $item->created_at->format('d/m/Y') }}</span>
                            </div>
                        </button>
                    </h2>
                    <div id="collapse-{{ $item->id }}" class="accordion-collapse collapse">
                        <div class="accordion-body pt-0">
                            <div class="card p-2">
                                <div class="card-header d-flex justify-content-between algin-items-center">
                                    <div class="card-title align-items-center justify-content-between">
                                        <div class="group d-flex align-items-center gap-2">
                                            <span class="avatar"
                                                style="background-image: url({{ asset($item->avatar) }})"></span>
                                            <span>{{ $item->fullname }}</span>
                                        </div>

                                    </div>
                                    <span>{{ __('Xếp loại:') . ' ' . $item->rank->title }}</span>
                                </div>
                                <div class="card-body">
                                    <p>{{ __('Số điện thoại: ') . '' . $item->phone }}</p>

                                    <p>{{ __('Email: ') . ' ' . $item->email }}</p>
                                    <p>{{ __('Biệt danh: ') . '' . $item->nickname }}</p>
                                    <p>{{ __('Địa chỉ: ') . '' . $item->address }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@elseif ($user->refer_3->isNotEmpty())
    <div class="card-body">
        <div class="accordion" id="accordion-example">
            @foreach ($user->refer as $item)
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading-{{ $item->id }}">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapse-{{ $item->id }}" aria-expanded="false">
                            <div class="d-flex justify-content-between align-items-center w-100">
                                <span class="px-3 d-flex align-items-center gap-1">
                                    {{ $item->fullname }}
                                    <span class="badge bg-red-lt">
                                        Reference Fixed
                                    </span>
                                </span>
                                <span
                                    class="px-3">{{ __('Ngày tham gia : ') }}{{ $item->created_at->format('d/m/Y') }}</span>
                            </div>
                        </button>
                    </h2>
                    <div id="collapse-{{ $item->id }}" class="accordion-collapse collapse">
                        <div class="accordion-body pt-0">
                            <div class="card p-2">
                                <div class="card-header d-flex justify-content-between algin-items-center">
                                    <div class="card-title align-items-center justify-content-between">
                                        <div class="group d-flex align-items-center gap-2">
                                            <span class="avatar"
                                                style="background-image: url({{ asset($item->avatar) }})"></span>
                                            <span>{{ $item->fullname }}</span>
                                        </div>

                                    </div>
                                    <span>{{ __('Xếp loại:') . ' ' . $item->rank->title }}</span>
                                </div>
                                <div class="card-body">
                                    <p>{{ __('Số điện thoại: ') . '' . $item->phone }}</p>

                                    <p>{{ __('Email: ') . ' ' . $item->email }}</p>
                                    <p>{{ __('Biệt danh: ') . '' . $item->nickname }}</p>
                                    <p>{{ __('Địa chỉ: ') . '' . $item->address }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            @foreach ($user->refer_1 as $item)
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading-{{ $item->id }}">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapse-{{ $item->id }}" aria-expanded="false">
                            <div class="d-flex justify-content-between align-items-center w-100">
                                <span class="px-3 d-flex align-items-center gap-1">
                                    {{ $item->fullname }}
                                    <span class="badge bg-success-lt">
                                        Reference 1
                                    </span>
                                </span>
                                <span
                                    class="px-3">{{ __('Ngày tham gia : ') }}{{ $item->created_at->format('d/m/Y') }}</span>
                            </div>
                        </button>
                    </h2>
                    <div id="collapse-{{ $item->id }}" class="accordion-collapse collapse">
                        <div class="accordion-body pt-0">
                            <div class="card p-2">
                                <div class="card-header d-flex justify-content-between algin-items-center">
                                    <div class="card-title align-items-center justify-content-between">
                                        <div class="group d-flex align-items-center gap-2">
                                            <span class="avatar"
                                                style="background-image: url({{ asset($item->avatar) }})"></span>
                                            <span>{{ $item->fullname }}</span>
                                        </div>

                                    </div>
                                    <span>{{ __('Xếp loại:') . ' ' . $item->rank->title }}</span>
                                </div>
                                <div class="card-body">
                                    <p>{{ __('Số điện thoại: ') . '' . $item->phone }}</p>

                                    <p>{{ __('Email: ') . ' ' . $item->email }}</p>
                                    <p>{{ __('Biệt danh: ') . '' . $item->nickname }}</p>
                                    <p>{{ __('Địa chỉ: ') . '' . $item->address }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            @foreach ($user->refer_2 as $item)
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading-{{ $item->id }}">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapse-{{ $item->id }}" aria-expanded="false">
                            <div class="d-flex justify-content-between align-items-center w-100">
                                <span class="px-3 d-flex align-items-center gap-1">
                                    {{ $item->fullname }}
                                    <span class="badge bg-cyan-lt">
                                        Reference 2
                                    </span>
                                </span>
                                <span
                                    class="px-3">{{ __('Ngày tham gia : ') }}{{ $item->created_at->format('d/m/Y') }}</span>
                            </div>
                        </button>
                    </h2>
                    <div id="collapse-{{ $item->id }}" class="accordion-collapse collapse">
                        <div class="accordion-body pt-0">
                            <div class="card p-2">
                                <div class="card-header d-flex justify-content-between algin-items-center">
                                    <div class="card-title align-items-center justify-content-between">
                                        <div class="group d-flex align-items-center gap-2">
                                            <span class="avatar"
                                                style="background-image: url({{ asset($item->avatar) }})"></span>
                                            <span>{{ $item->fullname }}</span>
                                        </div>

                                    </div>
                                    <span>{{ __('Xếp loại:') . ' ' . $item->rank->title }}</span>
                                </div>
                                <div class="card-body">
                                    <p>{{ __('Số điện thoại: ') . '' . $item->phone }}</p>

                                    <p>{{ __('Email: ') . ' ' . $item->email }}</p>
                                    <p>{{ __('Biệt danh: ') . '' . $item->nickname }}</p>
                                    <p>{{ __('Địa chỉ: ') . '' . $item->address }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            @foreach ($user->refer_3 as $item)
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading-{{ $item->id }}">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapse-{{ $item->id }}" aria-expanded="false">
                            <div class="d-flex justify-content-between align-items-center w-100">
                                <span class="px-3 d-flex align-items-center gap-1">
                                    {{ $item->fullname }}
                                    <span class="badge bg-purple-lt">
                                        Reference 3
                                    </span>
                                </span>
                                <span
                                    class="px-3">{{ __('Ngày tham gia : ') }}{{ $item->created_at->format('d/m/Y') }}</span>
                            </div>
                        </button>
                    </h2>
                    <div id="collapse-{{ $item->id }}" class="accordion-collapse collapse">
                        <div class="accordion-body pt-0">
                            <div class="card p-2">
                                <div class="card-header d-flex justify-content-between algin-items-center">
                                    <div class="card-title align-items-center justify-content-between">
                                        <div class="group d-flex align-items-center gap-2">
                                            <span class="avatar"
                                                style="background-image: url({{ asset($item->avatar) }})"></span>
                                            <span>{{ $item->fullname }}</span>
                                        </div>

                                    </div>
                                    <span>{{ __('Xếp loại:') . ' ' . $item->rank->title }}</span>
                                </div>
                                <div class="card-body">
                                    <p>{{ __('Số điện thoại: ') . '' . $item->phone }}</p>

                                    <p>{{ __('Email: ') . ' ' . $item->email }}</p>
                                    <p>{{ __('Biệt danh: ') . '' . $item->nickname }}</p>
                                    <p>{{ __('Địa chỉ: ') . '' . $item->address }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@else
    <div class="card-body">
        <p>{{ __('Không có người giới thiệu.') }}</p>
    </div>
@endif
