@php
    $icons = json_decode(file_get_contents(base_path('packages/codermahidul/iconpicker/icon-list.json')), true);
@endphp

<div class="position-relative d-inline-block" style="width: 100%;">
    <input type="text"
           id="icon-picker-input"
           name="icon"
           class="form-control"
           placeholder="Choose icon..."
           readonly
           style="cursor: pointer;">

    <div id="iconDropdown" class="dropdown-menu show p-3 shadow border position-absolute w-100" style="max-height: 300px; overflow-y: auto; display: none; z-index: 1050;">
        <input type="text" class="form-control mb-2" id="iconSearch" placeholder="Search icons...">

        <div class="row row-cols-6 g-2" id="iconList">
            @foreach($icons as $icon)
                <div class="col icon-option text-center" data-icon="{{ $icon['class'] }}" data-keywords="{{ strtolower($icon['label']) }} {{ implode(' ', $icon['keywords']) }}">
                    <i class="{{ $icon['class'] }}"></i>
                </div>
            @endforeach
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const input = document.getElementById('icon-picker-input');
    const dropdown = document.getElementById('iconDropdown');
    const searchInput = document.getElementById('iconSearch');

    input.addEventListener('focus', function () {
        dropdown.style.display = 'block';
        searchInput.focus();
    });

    document.addEventListener('click', function (e) {
        if (!e.target.closest('.position-relative')) {
            dropdown.style.display = 'none';
        }
    });

    document.querySelectorAll('.icon-option').forEach(option => {
        option.addEventListener('click', function () {
            const selected = this.dataset.icon;
            input.value = selected;
            dropdown.style.display = 'none';
        });
    });

    searchInput.addEventListener('keyup', function () {
        const term = this.value.toLowerCase();
        document.querySelectorAll('.icon-option').forEach(option => {
            const match = option.dataset.keywords.includes(term);
            option.style.display = match ? 'block' : 'none';
        });
    });
});
</script>
@endpush


@push('styles')
<style>
.icon-option {
    cursor: pointer;
    padding: 10px;
    border: 1px solid transparent;
    border-radius: 5px;
}
.icon-option:hover {
    border-color: #0d6efd;
    background-color: #e9f5ff;
}
.icon-option i {
    font-size: 20px;
}
</style>
@endpush

