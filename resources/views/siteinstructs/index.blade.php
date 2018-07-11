@extends('templates.master')
@section('content')

<div class="container">
	<table class="table table-bordered" id="siteinstructs-table">
        <thead>
            <tr>
                <th>Id</th>
                <th>Name/th>
                <th>Status</th>
                <th>Notes</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th>Actions</th>
            </tr>
        </thead>
        
    </table>

    {{-- Modal Form Show POST --}}
<div id="show" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"></h4>
                  </div>
                    <div class="modal-body">
                    <div class="form-group">
                      <label for="">ID :</label>
                      <b id="i"/>
                    </div>
                    <div class="form-group">
                      <label for="">Status :</label>
                      <b id="st"/>
                    </div>
                    <div class="form-group">
                      <label for="">Name :</label>
                      <b id="na"/>
                    </div>
                    <div class="form-group">
                      <label for="">Requester Notes :</label>
                      <b id="rn"/>
                    </div>
                    </div>
                    </div>
                  </div>
</div>
{{-- Modal Form Edit and Delete Post --}}
<div id="myModal"class="modal fade" role="dialog">
    @csrf
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" role="modal">
          <div class="form-group">
            <label class="control-label col-sm-2"for="id">ID</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="fid" disabled>
            </div>
          </div>
          <!-- <div class="form-group">
            <label class="control-label col-sm-2"for="status">Status</label>
            <div class="col-sm-10">
            <input type="text" class="form-control" id="fst" disabled></b>
            </div>
          </div> -->
          <div class="form-group">
            <label class="control-label col-sm-2"for="name">Name</label>
            <div class="col-sm-10">
            <input type="name" class="form-control" id="fna">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2"for="notes">Requester Notes</label>
            <div class="col-sm-10">
            <input type="name" class="form-control" id="frn">
            </div>
          </div>
          
        </form>
                {{-- Form Delete Post --}}
        <div class="deleteContent">
          Are You sure want to delete <span class="title"></span>?
          <span class="hidden id"></span>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn actionBtn" data-dismiss="modal">
          <span id="footer_action_button" class="glyphicon"></span>
        </button>
        <button type="button" class="btn btn-warning" data-dismiss="modal">
          <span class="glyphicon glyphicon"></span>close
        </button>
      </div>
    </div>
  </div>
</div>
</div>

<script>
    
$(function() {
    $('#siteinstructs-table').DataTable({
        "order": [[ 4, "desc" ]],
        "pageLength": 10,
        "processing": true,
        "serverSide": true,
        "ajax": '{!! route('datatables.data') !!}',
        "columns": [
            { data: 'id',},
            { data: 'name'},
            { data: 'status'},
            { data: 'requester_notes'},
            { data: 'created_at'},
            { data: 'updated_at'},
            {
                data: null,
                render: function ( data, type, row, meta ) {
                    var table = $('#example').DataTable();
                    /*var data = table.row( $(this).parents('tr') ).data();*/
                    return '<a href="#" class="show-modal btn btn-info btn-sm" data-id="'+data.id+'"'+
                    'data-notes="'+data.requester_notes+'" data-name="'+data.name+'" data-status="'+data.status+'"><i class="fa fa-eye"></i>'+
                    '</a>'+
                    '<a href="#" class="edit-modal btn btn-warning btn-sm" data-id="'+row.id+'"'+
                    'data-notes="'+data.requester_notes+'" data-name="'+row.name+'" data-status="'+row.status+'">'+
                    '<i class="glyphicon glyphicon-pencil"></i>'+
                    '</a>'+
                    '<a href="#" class="delete-modal btn btn-danger btn-sm" data-id="'+row.id+'"'+
                    'data-notes="'+data.requester_notes+'" data-name="'+row.name+'" data-status="'+row.status+'">'+
                    '<i class="glyphicon glyphicon-trash"></i>'+
                    '</a>';
                }
            }    
        ]
    });
    
});


// function Edit POST
$(document).on('click', '.edit-modal', function() {
    $('#footer_action_button').text(" Update Project");
    $('#footer_action_button').addClass('glyphicon-check');
    $('#footer_action_button').removeClass('glyphicon-trash');
    $('.actionBtn').addClass('btn-success');
    $('.actionBtn').removeClass('btn-danger');
    $('.actionBtn').addClass('edit');
    $('.modal-title').text('Project Edit');
    $('.deleteContent').hide();
    $('.form-horizontal').show();
    $('#fid').val($(this).data('id'));
    $('#fst').val($(this).data('status'));
    $('#fna').val($(this).data('name'));
    $('#frn').val($(this).data('notes'));
    $('#myModal').modal('show');
});

$('.modal-footer').on('click', '.edit', function() {
  $.ajax({
    type: 'POST',
    url: 'editPost',
    data: {
    '_token': $('input[name=_token]').val(),
    'id': $("#fid").val(),
    'name': $('#fna').val(),
    'requester_notes': $('#frn').val()
    },
    success: function(data) {
        alert('Success Editing data');
        $('#siteinstructs-table').DataTable().draw( false );
        
    }
  });
});

// form Delete function
$(document).on('click', '.delete-modal', function() {
    $('#footer_action_button').text(" Delete");
    $('#footer_action_button').removeClass('glyphicon-check');
    $('#footer_action_button').addClass('glyphicon-trash');
    $('.actionBtn').removeClass('btn-success');
    $('.actionBtn').addClass('btn-danger');
    $('.actionBtn').addClass('delete');
    $('.modal-title').text('Delete Project');
    $('.id').text($(this).data('id'));
    $('.deleteContent').show();
    $('.form-horizontal').hide();
    $('.title').text($(this).data('name'));
    $('#myModal').modal('show');
});

$('.modal-footer').on('click', '.delete', function(){
  $.ajax({
    type: 'POST',
    url: 'deletePost',
    data: {
      '_token': $('input[name=_token]').val(),
      'id': $('.id').text()
    },
    success: function(data){
       $('.post' + $('.id').text()).remove();
       $('#siteinstructs-table').DataTable().draw( false );
    }
  });
});

// Show function
$(document).on('click', '.show-modal', function() {
    var table = $('#siteinstructs-table').DataTable();
    console.log( table.row( this ).data() );
    $('#show').modal('show');
    $('#i').text($(this).data('id'));
    $('#st').text($(this).data('status'));
    $('#na').text($(this).data('name'));
    $('#rn').text($(this).data('notes'));
    $('.modal-title').text('Show Project');
});

</script>

@endsection
