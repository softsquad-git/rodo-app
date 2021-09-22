<div id="app">
    <inspector-employees-form-component save_url="{{ $item->id ? route('inspector.employees.update', ['id' => $item->id]) : route('inspector.employees.create') }}"
                                        type="{{ $item->id ? 'edit' : 'create' }}"></inspector-employees-form-component>

</div>
