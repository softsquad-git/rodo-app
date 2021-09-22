<form method="POST"
      action="{{ $item->id ? route('admin.users.update', ['id' => $item->id]) : route('admin.users.create') }}">
    @csrf
    <input type="hidden" value="{{ request()->input('role') }}" name="role">
    <div class="mb-4 row">
        <div class="col-md-4 col-12">
            <label class="form-label" for="first_name">{{ __('admin.users.form.first_name') }}</label>
            <input type="text" class="form-control" id="first_name" name="first_name"
                   placeholder="{{ __('admin.users.form.first_name') }}">
            @error('first_name')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-4 col-12">
            <label class="form-label" for="last_name">{{ __('admin.users.form.last_name') }}</label>
            <input type="text" class="form-control" id="last_name" name="last_name"
                   placeholder="{{ __('admin.users.form.last_name') }}">
            @error('last_name')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-4 col-12">
            <label class="form-label" for="email">{{ __('admin.users.form.email') }}</label>
            <input type="text" class="form-control" id="email" name="email"
                   placeholder="{{ __('admin.users.form.email') }}">
            @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="mb-4 row">
        <div class="col-md-4">
            <label class="form-label" for="password">{{ __('admin.users.form.password') }}</label>
            <input type="text" class="form-control" id="password" name="password"
                   placeholder="{{ __('admin.users.form.password') }}">
            @error('password')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-4">
            <label class="form-label" for="password_confirm">{{ __('admin.users.form.password_confirm') }}</label>
            <input type="text" class="form-control" id="password_confirm" name="password_confirmation"
                   placeholder="{{ __('admin.users.form.password_confirm') }}">
        </div>
        <div class="col-md-4">
            <label class="form-label" for="password_confirm">{{ __('admin.users.form.status') }}</label>
            <select class="form-control" id="status_id" name="status_id">
                @foreach($statuses as $status)
                    <option
                        value="{{ $status->id }}"{{ $item->status_id ? ($item->status_id == $status->id ? 'selected' : '') : (old('data.status_id') == $status->id ? 'selected' : '')  }}>{{ $status->name }}</option>
                @endforeach
            </select>
            @error('data.status_id')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <button type="submit" class="btn btn-outline-primary btn-sm">
        {{ __('trans.save') }}
    </button>
    <a href="{{ route('admin.users.index') }}" class="btn btn-outline-danger btn-sm">{{ __('trans.cancel') }}</a>
</form>
