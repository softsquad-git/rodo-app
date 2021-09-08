@extends('layouts.admin')
@section('title', $title)
@section('content')
    @include('partials.hero', ['title' => $title, 'breadcrumb' => ['admin.index' => __('admin.title')]])
    <div class="content">
        <div class="block block-rounded">
            <div class="block-content block-content-full">
                <form method="post" action="{{ $item->id ? route('admin.clients.update', ['id' => $item->id]) : route('admin.clients.create') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-3 col-12">
                            <label class="col-form-label" for="name">{{ __('admin.clients.form.name') }}</label>
                            <input type="text" class="form-control" id="name" value="{{ $item->name ? $item->name : old('data.name') }}" name="data[name]" placeholder="{{ __('admin.clients.form.name') }}">
                            @error('data.name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-3 col-12">
                            <label class="col-form-label" for="nip">{{ __('admin.clients.form.nip') }}</label>
                            <input type="text" class="form-control" value="{{ $item->gus ? $item->gus?->nip : old('data.nip') }}" id="nip" name="data[nip]" placeholder="{{ __('admin.clients.form.nip') }}">
                            <button id="downloadDataGus" type="button" class="download-data-gus">Pobierz dane z GUS</button>
                            @error('data.nip')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-3 col-12">
                            <label class="col-form-label" for="krs">{{ __('admin.clients.form.krs') }}</label>
                            <input type="text" class="form-control" value="{{ $item->gus ? $item->gus?->krs : old('data.krs') }}" id="krs" name="data[krs]" placeholder="{{ __('admin.clients.form.krs') }}">
                            @error('data.krs')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-3 col-12">
                            <label class="col-form-label" for="regon">{{ __('admin.clients.form.regon') }}</label>
                            <input type="text" class="form-control" id="regon" value="{{ $item->gus ? $item->gus?->regon : old('data.regon') }}" name="data[regon]" placeholder="{{ __('admin.clients.form.regon') }}">
                            @error('data.regon')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <label class="col-form-label" for="address">{{ __('admin.clients.form.address') }}</label>
                            <input type="text" class="form-control" value="{{ $item->address ? $item->address : old('data.address') }}" id="address" name="data[address]" placeholder="{{ __('admin.clients.form.address') }}">
                            @error('data.address')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-2 col-12">
                            <label class="col-form-label" for="short">{{ __('admin.clients.form.short') }}</label>
                            <input type="text" class="form-control" value="{{ $item->short ? $item->short : old('data.short') }}" id="name" name="data[short]" placeholder="{{ __('admin.clients.form.short') }}">
                            @error('data.short')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-2 col-12">
                            <label class="col-form-label" for="type">{{ __('admin.clients.form.type') }}</label>
                            <select class="form-control" id="type" name="data[type_id]">
                                @foreach($types as $type)
                                    <option value="{{ $type->id }}"{{ $item->type_id ? ($item->type_id == $type->id ? 'selected' : '') : (old('data.type_id') == $type->id ? 'selected' : '')  }}>{{ $type->name }}</option>
                                @endforeach
                            </select>
                            @error('data.type_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-2 col-12">
                            <label class="col-form-label" for="status_id">{{ __('admin.clients.form.status') }}</label>
                            <select class="form-control" id="status_id" name="data[status_id]">
                                @foreach($statuses as $status)
                                    <option value="{{ $status->id }}"{{ $item->status_id ? ($item->status_id == $status->id ? 'selected' : '') : (old('data.status_id') == $status->id ? 'selected' : '')  }}>{{ $status->name }}</option>
                                @endforeach
                            </select>
                            @error('data.status_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-7">
                            <div class="form-admin-title mt-2">{{ __('admin.clients.form.data_smtp') }}</div>
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="col-form-label" for="smtp_host">{{ __('admin.clients.form.smtp.host') }}</label>
                                    <input type="text" class="form-control" id="smtp_host" name="smtp[host]" value="{{ $item->smtp ? $item->smtp?->host : old('smtp.host') }}" placeholder="{{ __('admin.clients.form.smtp.host') }}">
                                    @error('smtp.host')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label class="col-form-label" for="smtp_port">{{ __('admin.clients.form.smtp.port') }}</label>
                                    <input type="text" class="form-control" id="smtp_port" name="smtp[port]" value="{{ $item->smtp ? $item->smtp?->port : old('smtp.port') }}" placeholder="{{ __('admin.clients.form.smtp.port') }}">
                                    @error('smtp.port')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label class="col-form-label" for="smtp_encryption">{{ __('admin.clients.form.smtp.encryption') }}</label>
                                    <select class="form-control" id="smtp_encryption" name="smtp[encryption]">
                                        <option value="tls"{{ $item->smtp ? ($item->smtp?->encryption == 'tls' ? 'selected' : '') : (old('smtp.encryption') == 'tls' ? 'selected' : '') }}>tls</option>
                                        <option value="ssl"{{ $item->smtp ? ($item->smtp?->encryption == 'ssl' ? 'selected' : '') : (old('smtp.encryption') == 'ssl' ? 'selected' : '') }}>ssl</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="col-form-label" for="smtp_username">{{ __('admin.clients.form.smtp.username') }}</label>
                                    <input type="text" class="form-control" value="{{ $item->smtp ? $item->smtp?->username : old('smtp.username') }}" id="smtp_username" name="smtp[username]" placeholder="{{ __('admin.clients.form.smtp.username') }}">
                                    @error('smtp.username')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="col-form-label" for="smtp_password">{{ __('admin.clients.form.smtp.password') }}</label>
                                    <input type="text" class="form-control" id="smtp_password" value="{{ $item->smtp ? $item->smtp?->password : old('smtp.password') }}" name="smtp[password]" placeholder="{{ __('admin.clients.form.smtp.password') }}">
                                    @error('smtp.password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-admin-title mt-2">{{ __('admin.clients.form.data_contact') }}</div>
                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <label class="col-form-label" for="contact_management">{{ __('admin.clients.form.contact.management') }}</label>
                                    <input type="text" class="form-control" id="contact_management" name="contact[management][phone]" placeholder="{{ __('admin.clients.form.phone') }}">
                                    @error('contact.management.phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 col-12">
                                    <input type="email" style="margin-top: 38px" class="form-control" id="contact_management_email" name="contact[management][email]" placeholder="{{ __('admin.clients.form.email') }}">
                                    @error('contact.management.email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <label class="col-form-label" for="contact_secretariat">{{ __('admin.clients.form.contact.secretariat') }}</label>
                                    <input type="text" class="form-control" id="contact_secretariat" name="contact[secretariat][phone]" placeholder="{{ __('admin.clients.form.phone') }}">
                                    @error('contact.secretariat.phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 col-12">
                                    <input type="email" style="margin-top: 38px" class="form-control" id="contact_secretariat_email" name="contact[secretariat][email]" placeholder="{{ __('admin.clients.form.email') }}">
                                    @error('contact.secretariat.email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <label class="col-form-label" for="contact_bookkeeping">{{ __('admin.clients.form.contact.bookkeeping') }}</label>
                                    <input type="text" class="form-control" id="contact_bookkeeping" name="contact[bookkeeping][phone]" placeholder="{{ __('admin.clients.form.phone') }}">
                                    @error('contact.bookkeeping.phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 col-12">
                                    <input type="email" style="margin-top: 38px" class="form-control" id="contact_bookkeeping_email" name="contact[bookkeeping][email]" placeholder="{{ __('admin.clients.form.email') }}">
                                    @error('contact.bookkeeping.email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <button class="btn btn-outline-primary btn-sm" type="submit">{{ __('trans.save') }}</button>
                        <a href="{{ route('admin.clients.index') }}" class="btn btn-outline-danger btn-sm">{{ __('trans.cancel') }}</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('customJs')
    <script>
        $('#downloadDataGus').click(function () {
            $.ajax({
                url: '{{ route('api.get_gus_data') }}',
                data: {
                    nip: $('#nip').val()
                },
                success(data) {

                },
                error() {

                }
            })
        })
    </script>
@endsection
