@extends('templates.master')
@section('content')

<div class="container">
  <div>
    <a href="#" class="create-modal btn btn-success btn-sm">
    <i class="glyphicon glyphicon-plus"></i>
    </a>
    <a href="#" class="create-modal btn btn-primary btn-sm">
      Preview
    </a>
  </div> 
  <br>
  <table class="table table-bordered" id="siteinstructs-table">
    <thead>
        <tr>
            <th>Id</th>
            <th>Entry Date</th>
            <th>Client</th>
            <th>Driver</th>
            <th>Item</th>
            <th>In</th>
            <th>Out</th>
            <th>Actions</th>
        </tr>
    </thead>
        
  </table>

  {{-- Modal Form Create Post --}}
  @include('transactions.modalcreate')
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
            <label for="">Plate No :</label>
            <b id="pn"/>
          </div>
          <div class="form-group">
            <label for="">Notes :</label>
            <b id="n"/>
          </div>
          <div class="form-group">
            <label for="">Updated at :</label>
            <b id="ua"/>
          </div>
        </div>
      </div>
    </div>
  </div>
  {{-- Modal Form Edit and Delete Post --}}
  <div id="myModal" class="modal fade" role="dialog">
    @csrf
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"></h4>
        </div>
        <div class="modal-body">
          <form class="form-horizontal" role="modal">
            <input type="text" class="form-control hidden" id="fid" value="">
            <div class="form-group">
              <label class="control-label col-sm-2"for="id">ID</label>
              <div class="col-sm-10">
                <select class="form-control" id="ftrid" name="ftrid" required>
                  @foreach($transactions as $tr)
                  <option value="{{$tr->id}}">{{$tr->id}}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2"for="id">Date</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="fed" disabled>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2"for="id">Client</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="fc" disabled>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2"for="id">Action</label>
              <div class="col-sm-10">
                <select class="form-control" id="fa" name="fa" required>
                <option value="in">In</option>
                <option value="out">Out</option>
                </select>
              </div>
            </div>
            <!-- <div class="form-group">
              <label class="control-label col-sm-2"for="status">Status</label>
              <div class="col-sm-10">
              <input type="text" class="form-control" id="fst" disabled></b>
              </div>
            </div> -->
            <div class="form-group">
              <label class="control-label col-sm-2" for="fd">Driver :</label>
              <div class="col-sm-10">
                  <select class="form-control" id="fd" name="fd" required>
                  @foreach($drivers as $driver)
                  <option value="{{$driver->id}}">{{$driver->name}}</option>
                  @endforeach
                  </select>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2"for="name">Plate No</label>
              <div class="col-sm-10">
              <input type="name" class="form-control" id="fpn">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="fi">Item :</label>
              <div class="col-sm-10">
                  <div class="clone-item">
                    <div style="margin-bottom:5px">
                    <div>
                    <select class="form-control col-sm-3" id="fi" name="fi" style="width:40%" required>
                    @foreach($items as $item)
                    <option value="{{$item->id}}">{{$item->name}}</option>
                    @endforeach
                    </select>
                    <input type="number" id=fqty name="fqty" class="col-sm-3 form-control form-margin" style="width:30%">
                    <input type="text" name="fn" id="fn" class="form-control form-margin col-sm-2" placeholder="Notes" style="width:30%">
                    </div>
                    </div>
                  </div>
                  <p class="error-fquantity error-reset text-center alert alert-danger hidden"></p>
                  
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
var cars = 1;
//add cars 
$(".btnAddCar").click(function(){
  cars++;
  var html = '<fieldset class="delete">'+
          '<legend>Mobil '+cars+'<span style="display:inline-block; width: 20px;"></span><button class="btn btn-danger" type="button" style="height:30px;margin:5px">'+
    'X</button></legend>'+
          '<div class="form-group">'+
            '<label class="control-label col-sm-2" for="driver">Driver :</label>'+
            '<div class="col-sm-10">'+
                '<select class="form-control" id="drivers'+cars+'" name="drivers'+cars+'" required>'+
                '<option value=""></option>'+
                '@foreach($drivers as $driver)'+
                '<option value="{{$driver->id}}">{{$driver->name}}</option>'+
                '@endforeach'+
                '</select>'+
              '<p class="error-driver error-reset text-center alert alert-danger hidden"></p>'+
            '</div>'+
          '</div>'+
          '<div class="form-group">'+
            '<label class="control-label col-sm-2" for="plate_no'+cars+'">Plate No :</label>'+
            '<div class="col-sm-10">'+
                '<input type="text" name="plate_no'+cars+'" id="plate_no'+cars+'" class="form-control">'+
              '<p class="error-driver error-reset text-center alert alert-danger hidden"></p>'+
            '</div>'+
          '</div>'+
          '<div class="form-group">'+
            '<label class="control-label col-sm-2" for="item'+cars+'">Item :</label>'+
            '<div class="col-sm-10">'+
                '<div class="clone-item">'+
                  '<div style="margin-bottom:5px">'+
                  '<div>'+        
                  '<select class="form-control col-sm-3" id="items'+cars+'" name="items'+cars+'[]" style="width:30%" required>'+
                  '@foreach($items as $item)'+
                  '<option value="{{$item->id}}">{{$item->name}}</option>'+
                  '@endforeach'+
                  '</select>'+            
                  '<input type="number" id=quantity'+cars+' name="quantity'+cars+'[]" class="col-sm-3 form-control form-margin" style="width:20%">'+    
                  '<input type="text" name="notes'+cars+'[]" id="notes'+cars+'" class="form-control form-margin col-sm-2" placeholder="Notes" style="width:30%">'+    
                  '</div>'+
                  '<button class="btn btn-success btnAdd" style="margin-left:5px" type="button" value="'+cars+'">'+
                  '<i class="glyphicon glyphicon-plus"></i></button>'+
                  '</div>'+
                '</div>'+
                '<div class="increment'+cars+'"></div>'+
                '<p class="error-items error-reset text-center alert alert-danger hidden"></p>'+
                '<p class="error-quantity error-reset text-center alert alert-danger hidden"></p>'+
            '</div>'+
          '</div>'+
          '</fieldset>';
  
  $(".incrementCar").append(html);
});
//add input field for documents
$(".btnAddDoc").click(function(){
  var html = 
  '<div style="margin-bottom:5px" class="delete">'+
    '<div class="col-sm-5">'+ 
      '<input type="file" name="documents1[]" id="documents1" class="form-control" style="margin-left:-15px" required>'+     
    '</div>'+
    '<button class="btn btn-danger" type="button">'+
    '<i class="glyphicon glyphicon-remove"></i></button>'+
  '</div>';

  $(".incrementDoc").append(html);
});
//add input field for items 
$("body").on("click",".btnAdd",function(){ 
  var index=$(this).attr("value");
  var html = '<div style="margin-bottom:5px" class="delete">'+
            '<div>'+        
            '<select class="form-control col-sm-3" id="items'+index+'" name="items'+index+'[]" style="width:30%" required>'+
            '@foreach($items as $item)'+
            '<option value="{{$item->id}}">{{$item->name}}</option>'+
            '@endforeach'+
            '</select>'+
            '<p class="error text-center alert alert-danger hidden"></p>'+            
            '<input type="number" id=quantity'+index+' name="quantity'+index+'[]" class="col-sm-3 form-control form-margin" style="width:20%">'+    
            '<input type="text" name="notes'+index+'[]" id="notes'+index+'" class="form-control form-margin col-sm-2" placeholder="Notes" style="width:30%">'+    
            '</div>'+
            '<button class="btn btn-danger" style="margin-left:5px" type="button">'+
            '<i class="glyphicon glyphicon-remove"></i></button>'
            '</div>';
  
  $(".increment"+index).append(html);
});

//To Delete Added Fields
$("body").on("click",".btn-danger",function(){ 
  $(this).closest(".delete").remove();
});
    
$(function() {
  //Date Picker for Entry Date
  $('#entry_date').datepicker();
  $('#siteinstructs-table').DataTable({
      "order": [[ 1, "desc" ]],
      "pageLength": 10,
      "processing": true,
      "serverSide": true,
      "ajax": '{!! route('datatables.trans') !!}',
      "columns": [
          { data: 'transactions_id'},
          { data: 'entry_date'},
          { data: 'client_name', name: 'clients.name'},
          { data: 'driver_name', name:'drivers.name'},
          { data: 'item_name', name: 'items.name'},
          { data: 'in'},
          { data: 'out'},         
          {
              data: null,
              searchable: false,
              render: function ( data, type, row, meta ) {
                  var table = $('#siteinstruct-table').DataTable();
                  /*var data = table.row( $(this).parents('tr') ).data();*/
                  return '<a style="margin-right:3px" href="#" class="show-modal btn btn-info btn-sm" data-plate="'+data.plate_no+'" data-notes="'+data.notes+'" data-updated="'+data.updated_at+'"><i class="fa fa-eye"></i>'+
                  '</a>'+
                  '<a style="margin-right:3px" href="#" class="edit-modal btn btn-warning btn-sm" data-date="'+data.entry_date+'" data-id="'+data.id+'" data-trid="'+data.transactions_id+'" data-item="'+data.item_id+'" data-client="'+data.client_name+'" data-driver="'+data.driver_id+'" data-plate="'+data.plate_no+'" data-notes="'+data.notes+'" data-in="'+data.in+'" data-out="'+data.out+'">'+
                  '<i class="glyphicon glyphicon-pencil"></i>'+
                  '</a>'+
                  '<a style="margin-right:3px" href="#" class="delete-modal btn btn-danger btn-sm" data-id="'+data.id+'">'+
                  '<i class="glyphicon glyphicon-trash"></i>'+
                  '</a>';
              }
          }    
      ]
  });

});
/*ajax Form Add Transaction*/
  $(document).on('click','.create-modal', function() {
    $('#create').modal('show');
    $('.form-horizontal').show();
    $('.modal-title').text('Add Transaction');
  });
  $('.modal-footer').on('click','#add',function() {
    $('.error-reset').addClass('hidden');
    var items=[];
    var quantity=[];
    var notes=[];
    var drivers=[];
    var plate_no=[];
    var i, j;
    //var formData = new FormData();
    /*var formData;
    var doc = document.getElementById('documents');
    formData = $('#addForm').serialize();*/

    //console.log(formData);
    for(i=1;i<=cars;i++){
      if(!$('#drivers'+i).length){
        continue;
      }
      else if($('select[name=drivers'+i+']').val()==""){
        alert('Driver of Car '+i+' is empty');
        return false;
      }
      else{
        for(j=0;j<$('input[name^="quantity'+i+'"]').length;j++){
          if($('input[name^="quantity'+i+'"]').eq(j).val()==""){
            alert('Quantity '+(j+1)+' in Car '+i+' is empty');
            return false;
          }
        }
        drivers[i] = $('select[name=drivers'+i+']').val();
        plate_no[i] = $('input[name^=plate_no'+i+']').val();
        items[i] = $('#addForm').find('select[name^="items'+i+'"]').serialize();
        quantity[i] = $('#addForm').find('input[name^="quantity'+i+'"]').serialize();
        notes[i] = $('#addForm').find('input[name^="notes'+i+'"]').serialize();
      }
      
    }
    $.ajax({
      type: 'POST',
      url: 'transactions',
      data: {
        '_token': $('input[name=_token]').val(),
        'entry_date': $('input[name=entry_date]').val(),
        'client': $('#client').val(),
        'action': $('#action').val(),
        'drivers': drivers,
        'plate_no': plate_no,
        'items': items,
        'quantity': quantity,
        'notes': notes,
        'cars': cars,
        'trnotes': $('#trnotes').val(),
      },
      success: function(data){
        if(data.error){
          alert(data.error);
        }
        else{
          alert('Success Inserting data');

        }
        
        $('#siteinstructs-table').DataTable().draw( false );
        $('.error-reset').addClass('hidden');
        /*$('#table').append("<tr class='post" + data.id + "'>"+
        "<td>" + data.id + "</td>"+
        "<td>" + data.title + "</td>"+
        "<td>" + data.body + "</td>"+
        "<td>" + data.created_at + "</td>"+
        "<td><button class='show-modal btn btn-info btn-sm' data-id='" + data.id + "' data-title='" + data.title + "' data-body='" + data.body + "'><span class='fa fa-eye'></span></button> <button class='edit-modal btn btn-warning btn-sm' data-id='" + data.id + "' data-title='" + data.title + "' data-body='" + data.body + "'><span class='glyphicon glyphicon-pencil'></span></button> <button class='delete-modal btn btn-danger btn-sm' data-id='" + data.id + "' data-title='" + data.title + "' data-body='" + data.body + "'><span class='glyphicon glyphicon-trash'></span></button></td>"+
        "</tr>");*/
        
      },
      error: function(data){
        alert("Input Incorrect, Please Check Again")
        if ((data.responseJSON.errors)) {
          
          $.each(data.responseJSON.errors, function(i, j){
            $('.error-'+i).removeClass('hidden');
            $('.error-'+i).text(j);
          });
        }
                //your code here
      }
    });
  });

// function Edit Transaction
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
    $('#ftrid option[value="'+$(this).data('trid')+'"]').attr('selected', true);
    $('#fed').val($(this).data('date'));
    $('#fc').val($(this).data('client'));
    if($(this).data('in')==0){
      $('#fa option[value="'+$(this).data('out')+'"]').attr('selected', true);
      $('#fqty').val($(this).data('out'));
    }
    else{
      $('#fa option[value="'+$(this).data('in')+'"]').attr('selected', true);
      $('#fqty').val($(this).data('in'));
    }
    $('#fd option[value="'+$(this).data('driver')+'"]').attr('selected', true);
    $('#fpn').val($(this).data('plate'));
    $('#fi option[value="'+$(this).data('item')+'"]').attr('selected', true);
    $('#fn').val($(this).data('notes'));
    $('#myModal').modal('show');
});

$('.modal-footer').on('click', '.edit', function() {
  $.ajax({
    type: 'POST',
    url: 'editTransaction',
    data: {
    '_token': $('input[name=_token]').val(),
    'id': $('#fid').val(),
    'tr_id': $('#ftrid').val(),
    'quantity': $('#fqty').val(),
    'driver' : $('#fd').val(),
    'plate_no' : $('#fpn').val(),
    'item' : $('#fi').val(),
    'notes' : $('#fn').val(),
    },
    success: function(data) {
        alert('Success Editing data');
        $('#siteinstructs-table').DataTable().draw( false );
        
    }
  });
});

// To Show Delete Modal
$(document).on('click', '.delete-modal', function() {
    $('#footer_action_button').text(" Delete");
    $('#footer_action_button').removeClass('glyphicon-check');
    $('#footer_action_button').addClass('glyphicon-trash');
    $('.actionBtn').removeClass('btn-success');
    $('.actionBtn').addClass('btn-danger');
    $('.actionBtn').addClass('deleteBtn');
    $('.modal-title').text('Delete Project');
    $('.id').text($(this).data('id'));
    $('.deleteContent').show();
    $('.form-horizontal').hide();
    $('.title').text($(this).data('name'));
    $('#myModal').modal('show');
});

//To Delete
$('.modal-footer').on('click', '.deleteBtn', function(){
  $.ajax({
    type: 'POST',
    url: 'deleteDetail',
    data: {
      '_token': $('input[name=_token]').val(),
      'id': $('.id').text()
    },
    success: function(data){
       $('#siteinstructs-table').DataTable().draw( false );
    }
  });
});

// Show function
$(document).on('click', '.show-modal', function() {
    var table = $('#siteinstructs-table').DataTable();
    console.log( table.row( this ).data() );
    $('#show').modal('show');
    $('#pn').text($(this).data('plate'));
    $('#n').text($(this).data('notes'));
    $('#ua').text($(this).data('updated'));
    $('.modal-title').text('Show Detail');
});

</script>

@endsection
