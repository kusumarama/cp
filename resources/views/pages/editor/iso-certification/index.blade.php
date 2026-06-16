@extends('layout.editor')
@section('title')
    ISO Certification
@endsection

@section('content')
<div id="content">

    <!-- Topbar -->
        @include('include.editor.topbar')
    <!-- End of Topbar -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">ISO Certification / Berstandar ISO</h1>
        
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
            <h6 class="m-0 font-weight-bold text-primary">Data ISO Certification</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="Tmh" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Title (EN)</th>
                            <th>Title (ID)</th>
                            <th>Description (EN)</th>
                            <th>Description (ID)</th>
                            <th>Image</th>
                            <th>Action</th>
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
                    <h5 class="modal-title">Add new ISO Certification</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-grop row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Title (English)</label>
                                <input type="text" id="title" name="title" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Title (Bahasa Indonesia)</label>
                                <input type="text" id="title_id" name="title_id" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Description (English)</label>
                                <textarea id="description" name="description" class="form-control" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Description (Bahasa Indonesia)</label>
                                <textarea id="description_id" name="description_id" class="form-control" rows="3"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Certificate Image</label>
                        <div id="imagev" class="my-2"></div>
                        <input type="file" id="file" name="file" class="form-control" onchange="ViewImage(this);">
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
                    <h5 class="modal-title">Update ISO Certification</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-grop row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Title (English)</label>
                                <input type="hidden" id="id_update" name="id" class="form-control">
                                <input type="text" id="title_update" name="title" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Title (Bahasa Indonesia)</label>
                                <input type="text" id="title_id_update" name="title_id" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Description (English)</label>
                                <textarea id="description_update" name="description" class="form-control" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Description (Bahasa Indonesia)</label>
                                <textarea id="description_id_update" name="description_id" class="form-control" rows="3"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Certificate Image</label>
                        <div id="imagev_update" class="my-2"></div>
                        <input type="file" id="file_update" name="file" class="form-control" onchange="ViewImageUp(this);">
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
    function ViewImage(input) {
        let imagev = $('#imagev');
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
            imagev.empty().append('<img id="imgv" class="img-fluid" src="#">');
            $('#imgv').attr('src', e.target.result).height(200);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
    function ViewImageUp(input) {
        let imagev = $('#imagev_update');
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
            imagev.empty().append('<img id="imgv_update" class="img-fluid" src="#">');
            $('#imgv_update').attr('src', e.target.result).height(200);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
    $('document').ready(function(e){
        var Tmh = $('#Tmh').DataTable({
            "responsive": true,
            'searching': false,
            "processing": true,
            "serverSide": true,
            "pagingType": "full_numbers",
            "paging":true,
            "ajax":{
                "url":"{{ route('editor.iso-certification.data') }}",
                "data":function(parm){
                    parm.search = function(){
                        return $('#cari').val()
                    }
                },
                   
            },
            "columns":[
                {"data": "title","orderable":false},
                {"data": "title_id","orderable":false},
                {"data": "description","orderable":false},
                {"data": "description_id","orderable":false},
                {
                    "data": "image","orderable":false,render:function(data,type,row){
                        let img_path = row.image;
                        let img_view = '<img src="/cp/public/storage/'+img_path+'" class="rounded float-left" width="100">';
                        return img_view;
                    }
                },
                {
                    "data": "id","orderable":false,render: function ( data, type, row ){
                        var idData = row.id;
                        let btn ='<div class="btn-group" role="group" aria-label="Basic example">';
                        btn += '<button type="button" class="btn btn-warning btnUpdate">Update</button>';
                        btn += '<button type="button" class="btn btn-danger btnDelete">Delete</button>';
                        btn += '</div>';
                        return btn;
                    }
                },
            ]
        });
        function redraw(){
            Tmh.draw();
        }
        $("#add_new").click(function(){
            $("#addModal").modal("show");
        });
        $("#proses_add").click(function(){
            var postData = new FormData($("#addForm")[0]);
            $.ajax({
                url:"{{ URL::route('editor.iso-certification.store') }}",
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
                        // Remove image preview
                        $('#imagev').empty();
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
            Tmh.draw();
        });
        $("#Tmh tbody").on('click','.btnUpdate',function(){
            let data = Tmh.row( $(this).parents('tr') ).data();
            let idData = data.id;
            $.ajax({
                url:"{{ URL::route('editor.iso-certification.detail') }}",
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
                        let id = data.data.id;
                        let title = data.data.title;
                        let title_id = data.data.title_id;
                        let description = data.data.description;
                        let description_id = data.data.description_id;
                        let image = data.data.image;
                        $("#updateForm #imagev_update").empty().append('<img id="img" class="img-fluid" src="#">');
                        $('#img').attr('src', "/cp/public/storage/"+image).height(200);
                        $("#id_update").val(id);
                        $("#title_update").val(title);
                        $("#title_id_update").val(title_id);
                        $("#description_update").val(description);
                        $("#description_id_update").val(description_id);
                        $('#file_update').val(null);
                        
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
            var postData = new FormData($("#updateForm")[0]);
            $.ajax({
                url:"{{ URL::route('editor.iso-certification.update') }}",
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
                        $('#updateForm')[0].reset();
                        // Remove image preview
                        $('#imagev_update').empty();
                        $("#updateModal").modal("hide");
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
        $("#Tmh tbody").on('click','.btnDelete',function(){
            let data = Tmh.row( $(this).parents('tr') ).data();
            let idData = data.id;
            Swal.fire({
                title: 'Apakah Anda Yakin?',
                text: "Anda tidak akan dapat mengembalikan ini!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url:"{{ URL::route('editor.iso-certification.delete') }}",
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
                    })
                }
            })
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
</script>
@endsection
