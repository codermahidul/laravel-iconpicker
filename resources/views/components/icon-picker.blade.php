@php
    $icons = json_decode(file_get_contents(base_path('packages/codermahidul/iconpicker/icon-list.json')), true);
@endphp

<div>
    <div class="input-group mb-2">
        <input type="text" class="form-control" id="{{ $name }}" name="{{ $name }}" value="{{ $value }}" readonly>
        <button class="btn btn-outline-secondary" type="button" data-bs-toggle="modal" data-bs-target="#iconPickerModal">
            <i id="selectedIconPreview" class="{{ $value ?? 'fas fa-icons' }}"></i>
        </button>
    </div>

    <div class="modal fade" id="iconPickerModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Choose Icon</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input class="form-control mb-3" type="text" id="iconSearchInput" placeholder="Search icons...">
                    <div class="row row-cols-8 g-3" id="iconGrid">
                        @foreach($icons as $icon)
                            <div class="icon-wrapper" data-keywords="{{ strtolower(implode(' ', $icon['keywords'])) }} {{ strtolower($icon['label']) }}">
                                <button class="btn btn-outline-dark w-100 icon-btn" data-icon="{{ $icon['class'] }}">
                                    <i class="{{ $icon['class'] }}"></i>
                                </button>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    const modal = document.getElementById('iconPickerModal');
    modal.addEventListener('shown.bs.modal', () => {
        document.getElementById('iconSearchInput').focus();
    });

    document.querySelectorAll('.icon-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            const icon = this.dataset.icon;
            document.getElementById('{{ $name }}').value = icon;
            document.getElementById('selectedIconPreview').className = icon;
            bootstrap.Modal.getInstance(modal).hide();
        });
    });

    document.getElementById('iconSearchInput').addEventListener('input', function () {
        const term = this.value.toLowerCase();
        document.querySelectorAll('#iconGrid .icon-wrapper').forEach(wrapper => {
            wrapper.style.display = wrapper.dataset.keywords.includes(term) ? 'block' : 'none';
        });
    });
</script>
@endpush
