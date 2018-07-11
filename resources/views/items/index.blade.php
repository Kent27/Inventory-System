@extends('templates.master')
@section('content')

<div class="container">
	<?php 
    use App\Item;
  ?>
  <div class="row">
    <div>
    <input class="form-control" id="searchInput" type="text" placeholder="Search.." width="40%">
    </div>
    <br>
    <div class="table table-responsive">
      <table class="table table-bordered" id="table">
        <thead>
          <tr>
            <th width="150px">Id</th>
            <th>Name</th>
            <th>In Stock</th>
            <th class="text-center" width="150px">
              <a href="#" class="create-modal btn btn-success btn-sm">
                <i class="glyphicon glyphicon-plus"></i>
              </a>
            </th>
          </tr>
        </thead>
        @csrf
        <tbody id="itemTable">
        @foreach ($items as $value)
          <tr class="items{{$value->id}}">
            <td>{{ $value->id }}</td>
            <td>{{ $value->name }}</td>
            <td>{{ $value->quantity }}</td>
            <td>
              <a href="#" class="show-modal btn btn-info btn-sm" data-id="{{$value->id}}" data-name="{{$value->name}}" data-stock="{{$value->quantity}}">
                <i class="fa fa-eye"></i>
              </a>
              <a href="#" class="edit-modal btn btn-warning btn-sm" data-id="{{$value->id}}" data-name="{{$value->name}}" data-stock="{{$value->quantity}}">
                <i class="glyphicon glyphicon-pencil"></i>
              </a>
              <a href="#" class="delete-modal btn btn-danger btn-sm" data-id="{{$value->id}}" data-name="{{$value->name}}" data-stock="{{$value->quantity}}">
                <i class="glyphicon glyphicon-trash"></i>
              </a>
            </td>
          </tr>
        @endforeach
        </tbody>
      </table>
    </div>
    {{$items->links()}}
    
  </div>
  
{{-- Modal Form Create Post --}}
<div id="create" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" role="form">
          <div class="form-group row add">
            <label class="control-label col-sm-2" for="name">Name </label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="name" name="name"
              placeholder="Item Name" required>
              <p class="error text-center alert alert-danger hidden"></p>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2" for="quantity">Current Stock </label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="quantity" name="quantity"
              placeholder="Stock" default="0" required>
              <p class="error text-center alert alert-danger hidden"></p>
            </div>
          </div>
        </form>
      </div>
          <div class="modal-footer">
            <button class="btn btn-warning" type="button" id="add" data-dismiss="modal">
              <span class="glyphicon glyphicon-plus"></span>Save and Submit Instruction
            </button>
            <button class="btn btn-warning" type="button" data-dismiss="modal">
              <span class="glyphicon glyphicon-remobe"></span>Close
            </button>
          </div>
    </div>
  </div>
</div>

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
            <b id="id"/>
          </div>
          <div class="form-group">
            <label for="">Name :</label>
            <b id="na"/>
          </div>
          <div class="form-group">
            <label for="">Stock :</label>
            <b id="qty"/>
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
            <label class="control-label col-sm-2"for="notes">Stock</label>
            <div class="col-sm-10">
            <input type="name" class="form-control" id="fqty">
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
        "order": [[ 1, "desc" ]],
        "pageLength": 10,
        "processing": true,
        "serverSide": true,
        "ajax": '{!! route('datatables.items') !!}',
        "columns": [
            { data: 'id',},
            { data: 'name'},
            { data: 'quantity'},
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
//ajax Form Add Post
  $(document).on('click','.create-modal', function() {
    $('#create').modal('show');
    $('.form-horizontal').show();
    $('.modal-title').text('Add Post');
  });
  $('.modal-footer').on('click','#add',function() {
    $.ajax({
      type: 'POST',
      url: 'items',
      data: {
        '_token': $('input[name=_token]').val(),
        'name': $('input[name=name]').val(),
        'quantity': $('input[name=quantity]').val()
      },
      success: function(data){
        if ((data.errors)) {
          alert('error');
          $('.error').removeClass('hidden');
          $('.error').text(data.errors.name);
          $('.error').text(data.errors.quantity);
        } else {
          alert('success');
          $('.error').remove();
          $('#table').append("<tr class='items" + data.id + "'>"+
          "<td>" + data.id + "</td>"+
          "<td>" + data.name + "</td>"+
          "<td>" + data.quantity + "</td>"+
          "<td><button class='show-modal btn btn-info btn-sm' data-id='" + data.id + "' data-name='" + data.name + "' data-stock='" + data.quantity + "'><span class='fa fa-eye'></span></button> <button class='edit-modal btn btn-warning btn-sm' data-id='" + data.id + "' data-name='" + data.name + "' data-stock='" + data.quantity + "'><span class='glyphicon glyphicon-pencil'></span></button> <button class='delete-modal btn btn-danger btn-sm' data-id='" + data.id + "' data-name='" + data.name + "' data-stock='" + data.quantity + "'><span class='glyphicon glyphicon-trash'></span></button></td>"+
          "</tr>");
        }
      },
    });
    $('#title').val('');
    $('#body').val('');
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
    $('#fna').val($(this).data('name'));
    $('#fqty').val($(this).data('stock'));
    $('#myModal').modal('show');
});

$('.modal-footer').on('click', '.edit', function() {
  $.ajax({
    type: 'POST',
    url: 'editItem',
    data: {
    '_token': $('input[name=_token]').val(),
    'id': $("#fid").val(),
    'name': $('#fna').val(),
    'quantity': $('#fqty').val()
    },
    success: function(data) {
        alert('Success Editing data');
        $('#siteinstructs-table').DataTable().draw( false );
        $('.items' + data.id).replaceWith(" "+
            "<tr class='items" + data.id + "'>"+
            "<td>" + data.id + "</td>"+
            "<td>" + data.name + "</td>"+
            "<td>" + data.quantity + "</td>"+
       "<td><button class='show-modal btn btn-info btn-sm' data-id='" + data.id + "' data-name='" + data.name + "' data-stock='" + data.quantity + "'><span class='fa fa-eye'></span></button> <button class='edit-modal btn btn-warning btn-sm' data-id='" + data.id + "' data-name='" + data.name + "' data-stock='" + data.quantity + "'><span class='glyphicon glyphicon-pencil'></span></button> <button class='delete-modal btn btn-danger btn-sm' data-id='" + data.id + "' data-name='" + data.name + "' data-stock='" + data.quantity + "'><span class='glyphicon glyphicon-trash'></span></button></td>"+
            "</tr>");
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
    type: 'DELETE',
    url: '/items/'+$('.id').text(),
    data: {
      '_token': $('input[name=_token]').val(),
    },
    success: function(data){
       $('.items' + $('.id').text()).remove();
    }
  });
});

// Show function
$(document).on('click', '.show-modal', function() {
    var table = $('#siteinstructs-table').DataTable();
    console.log( table.row( this ).data() );
    $('#show').modal('show');
    $('#id').text($(this).data('id'));
    $('#na').text($(this).data('name'));
    $('#qty').text($(this).data('stock'));
    $('.modal-title').text('Show Detail');
});

$("#searchInput").on("keyup", function() {
  var value = $(this).val().toLowerCase();
  $("#itemTable tr").filter(function() {
    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
  });
});

</script>

@endsection
