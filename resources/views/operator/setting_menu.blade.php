<div class="row justify-content-center">
    <div class="col-md-12">
        <ul class="nav nav-pills flex-column flex-md-row mb-3">
            <li class="nav-item">
                <a class="nav-link {{ \Route::is('setting.create') ? 'active' : '' }}" href="{{ route('setting.create') }}">
                    <i class="fa fa-house me-1"></i> Lembaga
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ \Route::is('settingpj.create') ? 'active' : '' }}" href="{{ route('settingpj.create') }}">
                    <i class="fa fa-user me-1"></i> Penanggung Jawab
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ \Route::is('settingapp.create') ? 'active' : '' }}" href="{{ route('settingapp.create') }}">
                    <i class="fa fa-gear me-1"></i> Aplikasi
                </a>
            </li>
        </ul>
    </div>
</div>
