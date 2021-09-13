<div class="mb-4 row">
    <div class="col-md-4 col-12">
        <label class="form-label" for="first_name">{{ __('admin.users.form.first_name') }}</label>
        <input type="text" class="form-control" id="first_name" name="first_name" placeholder="{{ __('admin.users.form.first_name') }}">
        @error('first_name')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-4 col-12">
        <label class="form-label" for="last_name">{{ __('admin.users.form.last_name') }}</label>
        <input type="text" class="form-control" id="last_name" name="last_name" placeholder="{{ __('admin.users.form.last_name') }}">
        @error('last_name')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-4 col-12">
        <label class="form-label" for="email">{{ __('admin.users.form.email') }}</label>
        <input type="text" class="form-control" id="email" name="email" placeholder="{{ __('admin.users.form.email') }}">
        @error('email')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>
