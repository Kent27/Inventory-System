@extends('templates.master')
@section('content')
<div class="jumbotron text-center">
    <h1>Clients</h1>
    <p>Our trusted sellers and buyers from all around the world!</p>
    
</div>
<div class="container-fluid">
    <div>
        <a href="#" class="create-modal btn btn-success btn-sm">
        <i class="glyphicon glyphicon-plus"></i>
        </a>
    </div> 
    <br>
    <table class="table table-bordered" id="clients-table">
        <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Phone Number</th>
                <th>Account Number</th>
                <th>Last Transaction</th>
                <th>Actions</th>
            </tr>
        </thead>
    </table>

    {{-- Modal Form Create Post --}}
    <div id="create" class="modal fade" role="dialog">
    @csrf
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title"></h4>
          </div>
          <div class="modal-body">
            <form class="form-horizontal" id="addForm" role="form">
              <div class="form-group row add">
                <label class="control-label col-sm-3" for="name">Name :</label>
                <div class="col-sm-8">
                  <input type='text' class="form-control" id='name' name="name">
                  <p class="error-name error-reset text-center alert alert-danger hidden"></p>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-3" for="phone_number">Phone Number :</label>
                <div class="col-sm-8">
                    <input type='text' class="form-control" id='phone_number' name="phone_number">
                    <p class="error-phone_number error-reset text-center alert alert-danger hidden"></p>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-3" for="bank_name">Bank name :</label>
                <div class="col-sm-8">
                    <input type='text' class="form-control" id='bank_name' name="bank_name">
                  <p class="error-bank_name error-reset text-center alert alert-danger hidden"></p>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-3" for="account_name">Account Name :</label>
                <div class="col-sm-8">
                    <input type='text' class="form-control" id='account_name' name="account_name">
                  <p class="error-account_name error-reset text-center alert alert-danger hidden"></p>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-3" for="account_number">Account No :</label>
                <div class="col-sm-8">
                    <input type='text' class="form-control" id='account_number' name="account_number">
                  <p class="error-account_number error-reset text-center alert alert-danger hidden"></p>
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-sm-3" for="address">Address :</label>
                <div class="col-sm-8">
                    <input type='text' class="form-control" id='address' name="address">
                    <p class="error-address error-reset text-center alert alert-danger hidden"></p>
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
                <label for="">Address :</label>
                <b id="addr"/>
              </div>
            </div>
          </div>
        </div>
    </div>
    {{-- Modal Form Edit and Delete Client --}}
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
            <div class="form-group">
              <label class="control-label col-sm-2"for="id">ID</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="fid" disabled>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="name">Name</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="fn">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="phone">Phone Number</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="fpn">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="bank_name">Bank Name</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="fbn">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="account_name">Account Name</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="fan">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="account_number">Account No</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="fano">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="address">Address</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="fa">
              </div>
            </div>
            
          </form>
                  {{-- Form Delete Client --}}
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
  <!-- end edit and delete client -->
</div>
<script type="text/javascript">
    $(function(){
        $('#clients-table').DataTable({
            "order": [[ 1, "desc" ]],
            "pageLength": 10,
            "processing": true,
            "serverSide": true,
            "ajax": '{!! route('datatables.clients') !!}',
            "columns": [
                { data: 'id'},
                { data: 'name'},
                { data: 'phone_number'},
                { data: 'account_number'},
                { data: 'last_transaction'},        
                {
                    data: null,
                    searchable: false,
                    render: function ( data, type, row, meta ) {
                        var table = $('#clients-table').DataTable();
                        /*var data = table.row( $(this).parents('tr') ).data();*/
                        return '<a style="margin-right:3px" href="#" class="show-modal btn btn-info btn-sm" data-address="'+data.address+'"><i class="fa fa-eye"></i>'+
                        '</a>'+
                        '<a style="margin-right:3px" href="#" class="edit-modal btn btn-warning btn-sm" data-id="'+data.id+'" data-name="'+data.name+'" data-phone_number="'+data.phone_number+'" data-account_number="'+data.account_number+'" data-account_name="'+data.account_name+'" data-bank_name="'+data.bank_name+'" data-address="'+data.address+'">'+
                        '<i class="glyphicon glyphicon-pencil"></i>'+
                        '</a>'+
                        '<a style="margin-right:3px" href="#" class="delete-modal btn btn-danger btn-sm" data-id="'+data.id+'" data-name="'+data.name+'">'+
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
    $('.modal-title').text('Add Client');
    });

    $('.modal-footer').on('click','#add',function() {
        $('.error-reset').addClass('hidden');

        $.ajax({
          type: 'POST',
          url: 'clients',
          data: {
            '_token': $('input[name=_token]').val(),
            'name': $('input[name=name]').val(),
            'phone_number': $('#phone_number').val(),
            'bank_name': $('#bank_name').val(),
            'account_name': $('#account_name').val(),
            'account_number': $('#account_number').val(),
            'address': $('#address').val(),
          },
          success: function(data){
            if(data.error){
              alert(data.error);
            }
            else{
              alert('Success Inserting data');

            }
            
            $('#clients-table').DataTable().draw( false );
            $('.error-reset').addClass('hidden');

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
        $('#fn').val($(this).data('name'));
        $('#fpn').val($(this).data('phone_number'));
        $('#fbn').val($(this).data('bank_name'));
        $('#fan').val($(this).data('account_name'));
        $('#fano').val($(this).data('account_number'));
        $('#fa').val($(this).data('address'));
        $('#myModal').modal('show');
    });

    $('.modal-footer').on('click', '.edit', function() {
      $.ajax({
        type: 'POST',
        url: 'editClient',
        data: {
        '_token': $('input[name=_token]').val(),
        'id': $('#fid').val(),
        'name': $('#fn').val(),
        'phone_number': $('#fpn').val(),
        'bank_name' : $('#fbn').val(),
        'account_name' : $('#fan').val(),
        'account_number' : $('#fano').val(),
        'address' : $('#fa').val(),
        },
        success: function(data) {
            alert('Success Editing data');
            $('#clients-table').DataTable().draw( false );
            
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
        url: 'deleteClient',
        data: {
          '_token': $('input[name=_token]').val(),
          'id': $('.id').text()
        },
        success: function(data){
           $('#clients-table').DataTable().draw( false );
        }
      });
    });
</script>
@endsection