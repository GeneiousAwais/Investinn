<!-- JAVASCRIPT -->
<script src="{{ asset('theme/dist/default/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('theme/dist/default/assets/libs/simplebar/simplebar.min.js') }}"></script>
<script src="{{ asset('theme/dist/default/assets/libs/node-waves/waves.min.js') }}"></script>
<script src="{{ asset('theme/dist/default/assets/libs/feather-icons/feather.min.js') }}"></script>
<script src="{{ asset('theme/dist/default/assets/js/pages/plugins/lord-icon-2.1.0.js') }}"></script>
<script src="{{ asset('theme/dist/default/assets/js/plugins.js') }}"></script>

 <script src="{{ asset('theme/dist/default/assets/libs/prismjs/prism.js') }}"></script>
<script src="{{ asset('theme/dist/default/assets/js/pages/form-validation.init.js') }}"></script>



{{-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> --}}
<script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>

<script type="text/javascript" src="https://cdn.datatables.net/fixedcolumns/3.3.0/js/dataTables.fixedColumns.js"></script>

<script src="{{ asset('theme/dist/default/assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>


<script src="{{ asset('theme/dist/default/assets/libs/fullcalendar/main.min.js') }}"></script>

<link href="{{ asset('theme/dist/default/assets/libs/flatpickr/flatpickr.min.js') }}" rel="stylesheet" type="text/css" />




<script src="{{ asset('theme/dist/default/assets/libs/cleave.js/cleave.min.js') }}"></script>
<script src="{{ asset('theme/dist/default/assets/js/blockui.js') }}"></script>

 <!-- filepond js -->

 <script src="{{ asset('theme/dist/default/assets/libs/dropzone/dropzone-min.js')}}"></script>

 <!-- <script src="https://unpkg.com/filepond-plugin-image-edit/dist/filepond-plugin-image-edit.js"></script> -->
 <script src="{{ asset('theme/dist/default/assets/libs/filepond/filepond.min.js')}}"></script>

 <script src="{{ asset('theme/dist/default/assets/libs/filepond-plugin-image-preview/filepond-plugin-image-preview.min.js')}}"></script>
 <script src="https://unpkg.com/filepond-plugin-image-edit/dist/filepond-plugin-image-edit.js"></script>
 <script src="{{ asset('theme/dist/default/assets/libs/filepond-plugin-file-validate-size/filepond-plugin-file-validate-size.min.js')}}"></script>
 <script src="{{ asset('theme/dist/default/assets/libs/filepond-plugin-image-exif-orientation/filepond-plugin-image-exif-orientation.min.js')}}"></script> 
 <script src="{{ asset('theme/dist/default/assets/libs/filepond-plugin-file-encode/filepond-plugin-file-encode.min.js')}}"></script>




 <script src="{{ asset('theme/dist/default/assets/js/app.js') }}"></script>
<!-- App js -->

<script src="{{ asset('js/bootstrap-tagsinput.js') }}"></script>

<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.js"></script>

<!-- form masks init -->

<!-- <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script> -->
<script src="{{ asset('theme/dist/default/assets/libs/@ckeditor/ckeditor5-build-classic/build/ckeditor.js') }}"></script>



<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script type="text/javascript">
    
var ckClassicEditor = document.querySelectorAll(".ckeditor-description");

var $modal = $('#investorModal');
var image = document.getElementById('image');
var cropper;

$("body").on("change", ".image", function(e) {
    var files = e.target.files;
    var done = function(url) {
        image.src = url;
        $modal.modal('show');
    };
    var reader;
    var file;
    var url;
    if (files && files.length > 0) {
        file = files[0];
        if (URL) {
            done(URL.createObjectURL(file));
        } else if (FileReader) {
            reader = new FileReader();
            reader.onload = function(e) {
                done(reader.result);
            };
            reader.readAsDataURL(file);
        }
    }
});

$modal.on('shown.bs.modal', function() {
    cropper = new Cropper(image, {
        aspectRatio: 100/50,
        viewMode: 1,
        dragMode:crop,
        preview: '.preview',
        cropBoxResizable: true,
        cropBoxMovable: true,
        cropstart:function(e){
            console.log(e.type, e.detail);
        }
    });
}).on('hidden.bs.modal', function() {
    cropper.destroy();
    cropper = null;
});


$(document).on('click','.preview-img', function(e){
    e.preventDefault();
    let path = $(this).data('url');
    $(".img_path").attr("src", path);
    $('#domicile-modal').modal('show');
});

    $(document).ready(function() {ckClassicEditor.forEach(function() {
        ClassicEditor.create(document.querySelector(".ckeditor-description")).then(function(e) {
            e.ui.view.editable.element.style.height = "200px"
        }).catch(function(e) {
            console.error(e)
        })
    });


    $('.select2').select2({
        maximumSelectionLength: 10,
        dropdownAutoWidth : true,
        width: '100%',
        placeholder: "Select please",
        allowClear: false
    });


});

$(document).ready(function () {

        

        $('a[data-bs-toggle="tab"]').on('shown.bs.tab', function(e) {
            console.log('on tab change');
            $($.fn.dataTable.tables(true)).DataTable().columns.adjust();
        })

        $('button[data-bs-toggle="pill"]').on('shown.bs.tab', function(e) {;
            $($.fn.dataTable.tables(true)).DataTable().columns.adjust();
        })

        $('button[data-bs-toggle="collapse"]').on('shown.bs.tab', function(e) {
            console.log('ok');
            $($.fn.dataTable.tables(true)).DataTable().columns.adjust();
        })

        $.extend($.fn.dataTableExt.oStdClasses, {
            "sFilterInput": "form-control",
            "sLengthSelect": "form-control"
        });
    });

    $(document).on('click', '.delete-record', function(e) {
        e.preventDefault();

        var url = $(this).attr('href');
        var table = $(this).data('table');

        Swal.fire({
            html: '<div class="mt-3">' +
                '<lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop" colors="primary:#f7b84b,secondary:#f06548" style="width:100px;height:100px"></lord-icon>' +
                '<div class="mt-4 pt-2 fs-15 mx-5">' +
                '<h4>Are you sure?</h4>' +
                '<p class="text-muted mx-4 mb-0">Are you Sure You want to Delete this Record ?</p>' +
                '</div>' +
                '</div>',
            showCancelButton: true,
            confirmButtonClass: 'btn btn-primary w-xs me-2 mb-1',
            confirmButtonText: 'Yes, Delete It!',
            cancelButtonClass: 'btn btn-danger w-xs mb-1',
            buttonsStyling: false,
            showCloseButton: true
        }).then(function(result) {

            if (result.isConfirmed) {

                $.ajax({

                    url: url,
                    type: "DELETE",
                    // data : filters,
                    headers: {
                        'X-CSRF-Token': '{{ csrf_token() }}',
                    },
                    cache: false,
                    success: function(data) {
                        console.log(data);
                        if(data == 'remove sector'){
                            location.reload();
                        }
                        $('#' + table).DataTable().ajax.reload(null, false);
                    },
                    error: function() {

                    },
                    beforeSend: function() {

                    },
                    complete: function() {

                    }
                });
            }
        });
    });


     $(document).on('change', '.load-select', function(e) {

        var target = $(this).data('target');
        var url = $(this).data('url');
        var target_name = target?.split('_')[0];

        $.ajax({

            url: url + '?id=' + $(this).val(),
            type: "GET",
            cache: false,
            success: function(data) {

                var options = `<option value="">Please select a ${target_name}</option>`;

                if (data) {
                    console.log(data)
                    $.each(data, function(index, value) {
                        if (value.id) options += '<option value="' + value.id + '">' + value.sector_name + '</option>';
                        else options += '<option value="' + value.id + '">' + value[`${target_name}_name`] + '</option>';
                    });
                }

                console.log(options);
                var attr = $('select[name="' + target + '[]"]').attr('multiple');

                if (typeof attr !== 'undefined' && attr !== false) {
                    $('select[name="' + target + '[]"]').html(options).attr('disabled', false);
                }
                else{
                    $('select[name="' + target + '"]').html(options).attr('disabled', false);
                } 


               
            },
            error: function() {

            },
            beforeSend: function() {
                //showLoading();
            },
            complete: function() {
                //hideLoading();
            }
        });
    });


// var currencyInput = document.querySelector('input[type="currency"]')
// var currency = 'USD';

//  // format inital value
// onBlur({target:currencyInput})

// // bind event listeners
// currencyInput.addEventListener('focus', onFocus)
// currencyInput.addEventListener('blur', onBlur)


// function localStringToNumber( s ){
//   return Number(String(s).replace(/[^0-9.-]+/g,""))
// }

// function onFocus(e){
//   var value = e.target.value;
//   e.target.value = value ? localStringToNumber(value) : ''
// }

// function onBlur(e){
//   var value = e.target.value

//   var options = {
//       maximumFractionDigits : 2,
//       currency              : currency,
//       style                 : "currency",
//       currencyDisplay       : "symbol"
//   }
  
//   e.target.value = (value || value === 0) 
//     ? localStringToNumber(value).toLocaleString(undefined, options)
//     : ''
// }




</script>
