@extends('layout.editor')
@section('title')
    Portofolio
@endsection

@section('content')
<div id="content">

    <!-- Topbar -->
        @include('include.editor.topbar')
    <!-- End of Topbar -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Portofolio</h1>
        
        <form action="" id="form_cari" method="post">
            @csrf
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Cari nama" name="cari" id="cari">
                <div class="input-group-append">
                    <button type="button" id="add_new" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">Add</button>
                  <button class="d-none d-sm-inline-block btn btn-sm btn-info shadow-sm" type="button" id="btn-cari">Cari</button>
                </div>
              </div>
        </form>
    </div>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Portofolio</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="Tporto" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nama Project</th>
                            <th>Status Project</th>
                            <th>Lokasi Project</th>
                            <th>Owner Project</th>
                            <th>Alamat</th>
                            <th>Nilai Kontrak</th>
                            <th>Jenis Bangunan</th>
                            <th>Waktu Dimulai</th>
                            <th>Waktu Update</th>
                            <th>Status Update</th>
                            <th>Gambar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>
<form id="addForm" method="post" enctype="multipart/form-data">
    @csrf
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add new Portofolio</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-grop row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Nama Project</label>
                                <input type="text" id="project_name" name="project_name" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Status Project</label>
                                <select id="status_update" name="status" class="form-control">
                                    <option value="">-- Pilih Status --</option>
                                    <option value="selesai">Selesai</option>
                                    <option value="on progress">On Progress</option>
                                    <option value="belum dimulai">Belum Dimulai</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Lokasi Project</label>
                                <input type="text" id="location" name="location" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Owner Project</label>
                                <input type="text" id="owner_project" name="owner_project" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Alamat</label>
                                <input type="text" id="alamat" name="alamat" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Nilai Kontrak</label>
                                <input type="text" id="nilai_kontrak" name="nilai_kontrak" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Jenis Bangunan</label>
                                <input type="text" id="jenis_bangunan" name="jenis_bangunan" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Waktu Mulai</label>
                                <input type="date" id="waktu" name="waktu" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Status Update</label>
                                <input type="text" id="status_update" name="status_update" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Images (Multiple)</label>
                        <button type="button" class="btn btn-sm btn-success mb-2" onclick="addImageField()">
                            <i class="fas fa-plus"></i> Add More Image
                        </button>
                        <div id="image_fields_container">
                            <div class="image-field-group mb-2">
                                <div class="input-group">
                                    <input type="file" name="images[]" class="form-control image-input" accept="image/*" onchange="previewImage(this)" required>
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-danger" onclick="removeImageField(this)" disabled>
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="image-preview mt-2"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button type="button" id="proses_add" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
</form>
<form id="updateForm" method="post" enctype="multipart/form-data">
    @csrf
    <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Portofolio</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-grop row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Nama Project</label>
                                <input type="hidden" id="id_update" name="id" class="form-control">
                                <input type="text" id="project_name_update" name="project_name" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Status Project</label>
                                <select id="status_update" name="status" class="form-control">
                                    <option value="">-- Pilih Status --</option>
                                    <option value="selesai">Selesai</option>
                                    <option value="on progress">On Progress</option>
                                    <option value="belum dimulai">Belum Dimulai</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Lokasi Project</label>
                                <input type="text" id="location_update" name="location" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Owner Project</label>
                                <input type="text" id="owner_project_update" name="owner_project" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Alamat</label>
                                <input type="text" id="alamat_update" name="alamat" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Nilai Kontrak</label>
                                <input type="text" id="nilai_kontrak_update" name="nilai_kontrak" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Jenis Bangunan</label>
                                <input type="text" id="jenis_bangunan_update" name="jenis_bangunan" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Waktu Mulai</label>
                                <input type="text" id="waktu_update" name="waktu" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Status Update</label>
                                <input type="text" id="status_update_text" name="status_update" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Existing Images</label>
                        <div id="existing_images_container" class="row mb-3"></div>
                        
                        <label for="">Add New Images</label>
                        <button type="button" class="btn btn-sm btn-success mb-2" onclick="addUpdateImageField()">
                            <i class="fas fa-plus"></i> Add More Image
                        </button>
                        <div id="update_image_fields_container"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button type="button" id="proses_update" class="btn btn-primary">Update</button>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
@section('script')
<script>
    // Add image field for add form
    function addImageField() {
        const container = document.getElementById('image_fields_container');
        const fieldGroup = document.createElement('div');
        fieldGroup.className = 'image-field-group mb-2';
        fieldGroup.innerHTML = `
            <div class="input-group">
                <input type="file" name="images[]" class="form-control image-input" accept="image/*" onchange="previewImage(this)">
                <div class="input-group-append">
                    <button type="button" class="btn btn-danger" onclick="removeImageField(this)">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="image-preview mt-2"></div>
        `;
        container.appendChild(fieldGroup);
    }

    function removeImageField(button) {
        button.closest('.image-field-group').remove();
    }

    function previewImage(input) {
        const previewContainer = input.closest('.image-field-group').querySelector('.image-preview');
        previewContainer.innerHTML = '';
        
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const img = document.createElement('img');
                img.src = e.target.result;
                img.className = 'img-fluid';
                img.style.maxHeight = '150px';
                previewContainer.appendChild(img);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    // Add image field for update form
    function addUpdateImageField() {
        const container = document.getElementById('update_image_fields_container');
        const fieldGroup = document.createElement('div');
        fieldGroup.className = 'image-field-group mb-2';
        fieldGroup.innerHTML = `
            <div class="input-group">
                <input type="file" name="new_images[]" class="form-control image-input" accept="image/*" onchange="previewImage(this)">
                <div class="input-group-append">
                    <button type="button" class="btn btn-danger" onclick="removeImageField(this)">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="image-preview mt-2"></div>
        `;
        container.appendChild(fieldGroup);
    }

    function deletePortfolioImage(imageId, element) {
        console.log('deletePortfolioImage called with ID:', imageId);
        
        if (!confirm('Are you sure you want to delete this image?')) {
            console.log('User cancelled delete');
            return false;
        }
        
        console.log('Starting delete for image ID:', imageId);
        $('.loading-clock').css('display', 'flex');
        
        $.ajax({
            url: "{{ route('editor.portofolio.image.delete') }}",
            method: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                "_method": "DELETE",
                'image_id': imageId
            },
            dataType: "json",
            timeout: 10000, // 10 second timeout
            success: function(data) {
                console.log('Delete response:', data);
                $('.loading-clock').css('display', 'none');
                if (data.success == 1) {
                    $(element).closest('.col-md-3').fadeOut(300, function() {
                        $(this).remove();
                    });
                    toastr_success(data.messages);
                } else {
                    toastr_error(data.messages || 'Failed to delete image');
                }
            },
            error: function(xhr, status, error) {
                console.error('Delete error - Status:', status);
                console.error('Delete error - Error:', error);
                console.error('Delete error - Response:', xhr.responseText);
                $('.loading-clock').css('display', 'none');
                
                let errorMsg = 'Error deleting image';
                if (xhr.responseJSON && xhr.responseJSON.messages) {
                    errorMsg = xhr.responseJSON.messages;
                } else if (status === 'timeout') {
                    errorMsg = 'Request timeout - server took too long';
                } else if (xhr.status === 0) {
                    errorMsg = 'Network error - check your connection';
                } else if (xhr.status === 419) {
                    errorMsg = 'CSRF token expired - please refresh the page';
                } else if (xhr.status === 404) {
                    errorMsg = 'Delete endpoint not found';
                } else {
                    errorMsg = error || 'Unknown error';
                }
                toastr_error(errorMsg);
            }
        });
        
        return false;
    }
    $('document').ready(function(e){
        // Setup AJAX to always include CSRF token
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
        var Tporto = $('#Tporto').DataTable({
            "responsive": true,
            'searching': false,
            "processing": true,
            "serverSide": true,
            "pagingType": "full_numbers",
            "paging":true,
            "ajax":{
                "url":"{{ route('editor.portofolio.data') }}",
                "data":function(d){
                    d.search = $('#cari').val();
                }
            },
            "columns":[
                {"data": "project_name","orderable":false},
                {"data": "status","orderable":false},
                {"data": "location","orderable":false},
                {"data": "owner_project","orderable":false},
                {"data": "alamat","orderable":false},
                {"data": "nilai_kontrak","orderable":false},
                {"data": "jenis_bangunan","orderable":false},
                {"data": "waktu","orderable":false,render: function(data, type, row){
                        if(!data) return '';
                        // format timestamp to local string (Indonesian locale)
                        try{
                            const d = new Date(data);
                            return d.toLocaleString('id-ID', { year: 'numeric', month: '2-digit', day: '2-digit'});
                        }catch(err){
                            return data;
                        }
                    }},

                {"data": "updated_at","orderable":false,render: function(data, type, row){
                        if(!data) return '';
                        // format timestamp to local string (Indonesian locale)
                        try{
                           const d = new Date(data);
                            return d.toLocaleString('id-ID', { year: 'numeric', month: '2-digit', day: '2-digit'});
                        } catch (err) {
                            return data;
                        }
                    }},
                
                {"data": "status_update","orderable":false},
                {
                    "data": "image","orderable":false,render:function(data,type,row){
                        let img_path = row.image;
                        let img_view = '<img src="{{ asset("storage") }}/'+img_path+'" class="rounded float-left" width="100">';
                        return img_view;
                    }
                },
                {
                    "data": "id","orderable":false,render: function ( data, type, row ){
                        var idData = row.id;
                        let isVerified = row.verified;
                        let btn ='<div class="btn-group" role="group" aria-label="Basic example">';
                        if(isVerified == 0){
                            btn += '<button type="button" class="btn btn-success btnVerified">Verified</button>';
                        }
                        btn += '<button type="button" class="btn btn-warning btnUpdate">Update</button>';
                        btn += '<button type="button" class="btn btn-danger btnDelete">Delete</button>';
                        btn += '</div>';
                        return btn;
                    }
                }
            ]
        });
        function redraw(){
            Tporto.draw();
        }
        $("#add_new").click(function(){
            $("#addModal").modal("show");
        });
        $("#proses_add").click(function(){
            var postData = new FormData($("#addForm")[0]);
            $.ajax({
                url:"{{ URL::route('editor.portofolio.store') }}",
                data:postData,
                type:"POST",
                dataType:"JSON",
                cache:false,
                contentType: false,
                processData: false,
                beforeSend: function(){
                    $('.loading-clock').css('display','flex');
                },
                success:function(data){
                    if(data.success == 1){
                        // Reset form
                        $('#addForm')[0].reset();
                        // Remove all image fields except first one
                        $('#image_fields_container').html(`
                            <div class="image-field-group mb-2">
                                <div class="input-group">
                                    <input type="file" name="images[]" class="form-control image-input" accept="image/*" onchange="previewImage(this)" required>
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-danger" onclick="removeImageField(this)" disabled>
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="image-preview mt-2"></div>
                            </div>
                        `);
                        $("#addModal").modal("hide");
                        toastr_success(data.messages);
                        redraw();
                    }else{
                        toastr_error(data.messages);
                    }
                },
                complete: function(){
                    $('.loading-clock').css('display','none');
                },
            });
        });
        $("#btn-cari").click(function(){
            let search = $("#cari").val();
            Tporto.draw();
        });
        $("#Tporto tbody").on('click','.btnUpdate',function(){
            let data = Tporto.row( $(this).parents('tr') ).data();
            let idData = data.id;
            $.ajax({
                url:"{{ URL::route('editor.portofolio.detail') }}",
                type: "GET",
                data: {
                    "_token": "{{ csrf_token() }}",
                    'id': idData
                },
                dataType: "JSON",
                cache: false,
                beforeSend: function(){
                    $('.loading-clock').css('display','flex');
                },
                success: function(data) {
                    if(data.success == 1){
                        let portfolio = data.data;
                        $("#id_update").val(portfolio.id);
                        $("#updateForm #project_name_update").val(portfolio.project_name);
                        $("#updateForm #status_update").val(portfolio.status);
                        $("#location_update").val(portfolio.location);
                        $("#owner_project_update").val(portfolio.owner_project);
                        $("#alamat_update").val(portfolio.alamat);
                        $("#nilai_kontrak_update").val(portfolio.nilai_kontrak);
                        $("#jenis_bangunan_update").val(portfolio.jenis_bangunan);
                        $("#waktu_update").val(portfolio.waktu);
                        $("#status_update_text").val(portfolio.status_update);
                        
                        // Display existing images
                        let imagesHtml = '';
                        if(portfolio.images && portfolio.images.length > 0) {
                            portfolio.images.forEach(function(img) {
                                imagesHtml += `
                                    <div class="col-md-3 mb-2">
                                        <div class="card">
                                            <img src="{{ asset('storage') }}/${img.image_path}" class="card-img-top" style="height: 150px; object-fit: cover;">
                                            <div class="card-body p-2 text-center">
                                                <button type="button" class="btn btn-danger btn-sm" onclick="deletePortfolioImage(${img.id}, this)">
                                                    <i class="fas fa-trash"></i> Delete
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                `;
                            });
                        }
                        $('#existing_images_container').html(imagesHtml);
                        $('#update_image_fields_container').html('');
                        
                    } else{
                        toastr_error(data.messages);
                    }
                },
                complete: function(){
                    $('.loading-clock').css('display','none');
                },
            })
            $("#updateModal").modal("show");
        });
        $("#proses_update").click(function(){
            let portfolioId = $("#id_update").val();
            let postData = new FormData($("#updateForm")[0]);
            
            // Handle project data update
            let updatePromise = $.ajax({
                url:"{{ URL::route('editor.portofolio.update') }}",
                data:postData,
                type:"POST",
                dataType:"JSON",
                cache:false,
                contentType: false,
                processData: false,
            });
            
            // Handle new images upload if any
            let newImagesData = new FormData();
            newImagesData.append('_token', '{{ csrf_token() }}');
            newImagesData.append('portfolio_id', portfolioId);
            
            let newImageInputs = document.querySelectorAll('input[name="new_images[]"]');
            let hasNewImages = false;
            newImageInputs.forEach(function(input) {
                if(input.files && input.files[0]) {
                    newImagesData.append('new_images[]', input.files[0]);
                    hasNewImages = true;
                }
            });
            
            let addImagesPromise = hasNewImages ? $.ajax({
                url:"{{ URL::route('editor.portofolio.images.add') }}",
                data:newImagesData,
                type:"POST",
                dataType:"JSON",
                cache:false,
                contentType: false,
                processData: false,
            }) : Promise.resolve({success: 1});
            
            $('.loading-clock').css('display','flex');
            
            Promise.all([updatePromise, addImagesPromise]).then(function(results) {
                let updateResult = results[0];
                let addImagesResult = results[1];
                
                if(updateResult.success == 1) {
                    if(hasNewImages && addImagesResult.success != 1) {
                        toastr_error('Portfolio updated but some images failed to upload: ' + (addImagesResult.messages || 'Unknown error'));
                    } else {
                        toastr_success('Portfolio updated successfully');
                    }
                    $("#updateModal").modal("hide");
                    redraw();
                } else {
                    toastr_error(updateResult.messages || 'Error updating portfolio');
                }
            }).catch(function(error) {
                console.error('Update error:', error);
                if(error.responseJSON && error.responseJSON.messages) {
                    toastr_error(error.responseJSON.messages);
                } else if(error.statusText) {
                    toastr_error('Error: ' + error.statusText);
                } else {
                    toastr_error('Error updating portfolio. Please check the form data.');
                }
            }).finally(function() {
                $('.loading-clock').css('display','none');
            });
            
            return false;
        });
        
        $("#Tporto tbody").on('click','.btnDelete',function(){
            let data = Tporto.row( $(this).parents('tr') ).data();
            let idData = data.id;
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url:"{{ URL::route('editor.portofolio.delete') }}",
                        type: "DELETE",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            'id': idData
                        },
                        dataType: "JSON",
                        cache: false,
                        beforeSend: function(){
                            $('.loading-clock').css('display','flex');
                        },
                        success: function(data) {
                            if(data.success == 1){
                                toastr_success(data.messages);
                                redraw();
                            } else{
                                toastr_error(data.messages);
                            }
                        },
                        complete: function(){
                            $('.loading-clock').css('display','none');
                        },
                    }); 
                }
                });
        });
        function toastr_success(msg){
        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
            });
            Toast.fire({
            icon: "success",
            title: msg
        });
    }
    function toastr_error(msg){
        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
            });
            Toast.fire({
            icon: "error",
            title: msg
        });
        }
    });
</script>
@endsection