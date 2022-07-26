<div>
    <h1>Laravel 9 Livewire Select2 Example - Laratutorials.com</h1>
    <div wire:ignore>
        <select class="form-control" id="select2" >
            <option value="">-- Select City --</option>
            @foreach($cities as $city)
                <option value="{{ $city }}">{{ $city }}</option>
            @endforeach
        </select>
    </div>
</div>
  
@push('scripts')
<script>
    $(document).ready(function() {
        $('#select2').select2();
        $('#select2').on('change', function (e) {
            var data = $('#select2').select2("val");
            @this.set('selCity', data);
        });
    });
</script>
@endpush