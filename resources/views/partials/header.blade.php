<header id="page-header">
    <div class="content-header">
        <div class="d-flex align-items-center">
            <button type="button" class="btn btn-sm btn-alt-secondary me-2 d-lg-none" data-toggle="layout" data-action="sidebar_toggle">
                <i class="fa fa-fw fa-bars"></i>
            </button>
            <button type="button" class="btn btn-sm btn-alt-secondary me-2 d-none d-lg-inline-block" data-toggle="layout" data-action="sidebar_mini_toggle">
                <i class="fa fa-fw fa-ellipsis-v"></i>
            </button>
        </div>
        <div class="d-flex align-items-center">
            <div class="dropdown d-inline-block ms-2">
                <button type="button" class="btn btn-sm btn-alt-secondary d-flex align-items-center" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="rounded-circle" src="{{ \Illuminate\Support\Facades\Auth::user()->avatar }}" alt="Header Avatar" style="width: 21px;">
                    <span class="d-none d-sm-inline-block ms-2">{{ \Illuminate\Support\Facades\Auth::user()->first_name }}</span>
                    <i class="fa fa-fw fa-angle-down d-none d-sm-inline-block ms-1 mt-1"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-md dropdown-menu-end p-0 border-0" aria-labelledby="page-header-user-dropdown">
                    <div class="p-3 text-center bg-body-light border-bottom rounded-top">
                        <img class="img-avatar img-avatar48 img-avatar-thumb" src="{{ \Illuminate\Support\Facades\Auth::user()->avatar }}" alt="">
                        <p class="mt-2 mb-0 fw-medium">{{ \Illuminate\Support\Facades\Auth::user()->name }}</p>
                    </div>
                    <div class="p-1">
                        <a class="dropdown-item d-flex align-items-center justify-content-between" href="{{ route(__('navbar.admin.profile.route')) }}">
                            <span class="fs-sm fw-medium"><i class="fa fa-user-tie"></i> {{ __('navbar.admin.profile.title') }}</span>
                        </a>
                    </div>
                    <div role="separator" class="dropdown-divider m-0"></div>
                    <div class="p-1">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a class="dropdown-item d-flex align-items-center justify-content-between" href="#" onclick="$(this).closest('form').submit()">
                                <span class="fs-sm fw-medium"><i class="fa fa-sign-out-alt"></i> {{ __('trans.logout') }}</span>
                            </a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="page-header-search" class="overlay-header bg-body-extra-light">
        <div class="content-header">
            <form class="w-100" action="be_pages_generic_search.html" method="POST">
                <div class="input-group">
                    <button type="button" class="btn btn-alt-danger" data-toggle="layout" data-action="header_search_off">
                        <i class="fa fa-fw fa-times-circle"></i>
                    </button>
                    <input type="text" class="form-control" placeholder="Search or hit ESC.." id="page-header-search-input" name="page-header-search-input">
                </div>
            </form>
        </div>
    </div>
    <div id="page-header-loader" class="overlay-header bg-body-extra-light">
        <div class="content-header">
            <div class="w-100 text-center">
                <i class="fa fa-fw fa-circle-notch fa-spin"></i>
            </div>
        </div>
    </div>
</header>
