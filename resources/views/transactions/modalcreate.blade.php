<div id="create" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" id="addForm" role="form">
          <div class="form-group row add">
            <label class="control-label col-sm-2" for="name">Entry Date :</label>
            <div class="col-sm-10">
              <input type='text' class="form-control" id='entry_date' name="entry_date" style='width: 300px;' autocomplete="off" required>
              
              <p class="error-entry_date error-reset text-center alert alert-danger hidden"></p>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2" for="client">Client :</label>
            <div class="col-sm-10">
                <select class="form-control" id="client" name="client">
                <option value=""></option>
                @foreach($clients as $client)
                <option value="{{$client->id}}">{{$client->name}}</option>
                @endforeach
                </select>
              <p class="error-client error-reset text-center alert alert-danger hidden"></p>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2" for="action">Action :</label>
            <div class="col-sm-10">
                <select class="form-control" id="action" name="action">
                <option value="in">In</option>
                <option value="out">Out</option>
                </select>
              <p class="error-action error-reset text-center alert alert-danger hidden"></p>
            </div>
          </div>
          <fieldset>
          <legend>Mobil 1 <button class="btn btn-danger" type="button">
    <i class="glyphicon glyphicon-remove"></i></button> </legend>
          <div class="form-group">
            <label class="control-label col-sm-2" for="driver">Driver :</label>
            <div class="col-sm-10">
                <select class="form-control" id="drivers1" name="drivers1" required>
                <option value=""></option>
                @foreach($drivers as $driver)
                <option value="{{$driver->id}}">{{$driver->name}}</option>
                @endforeach
                </select>
              <p class="error-driver error-reset text-center alert alert-danger hidden"></p>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2" for="plate_no1">Plate No :</label>
            <div class="col-sm-10">
                <input type="text" name="plate_no1" id="plate_no1" class="form-control">
              <p class="error-driver error-reset text-center alert alert-danger hidden"></p>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2" for="item1">Item :</label>
            <div class="col-sm-10">
                <div class="clone-item">
                  <div style="margin-bottom:5px">
                  <div>        
                  <select class="form-control col-sm-3" id="items1" name="items1[]" style="width:30%" required>
                  @foreach($items as $item)
                  <option value="{{$item->id}}">{{$item->name}}</option>
                  @endforeach
                  </select>            
                  <input type="number" id=quantity1 name="quantity1[]" class="col-sm-3 form-control form-margin" style="width:20%">    
                  <input type="text" name="notes1[]" id="notes1" class="form-control form-margin col-sm-2" placeholder="Notes" style="width:30%">    
                  </div>
                  <button class="btn btn-success btnAdd" style="margin-left:5px" type="button" value="1">
                  <i class="glyphicon glyphicon-plus"></i></button>
                  </div>
                </div>
                <div class="increment1"></div>
                <p class="error-items error-reset text-center alert alert-danger hidden"></p>
                <p class="error-quantity error-reset text-center alert alert-danger hidden"></p>
                
            </div>
            
          </div>

          </fieldset>
          
          <div class="incrementCar"></div>
          <hr>
          <!-- <div class="form-group">
            <label class="control-label col-sm-2" for="document1">Documents :</label>
            <div class="col-sm-10">
            <div style="margin-bottom:5px">
              <div class="col-sm-5"> 
                  <input type="file" name="documents" id="documents" class="form-control" style="margin-left:-15px" required>     
              </div>
              <button class="btn btn-success btnAddDoc" type="button" onclick="btnAddDoc()">
              <i class="glyphicon glyphicon-plus"></i></button>
            </div>

            <div class="incrementDoc"></div>
            </div>
          </div> -->
          <div class="form-group">
            <label class="control-label col-sm-2" for="reqnotes">General Notes :</label>
            <div class="col-sm-10">
                <textarea name="trnotes" id="trnotes" class="form-control" placeholder="Notes"></textarea>
            </div>
          </div>
        </form>
      </div>
          <div class="modal-footer">
            <button class="btn btn-success btnAddCar" style="margin-left:5px; float:left" type="button" value="2"><i class="glyphicon glyphicon-plus">Car</i></button>
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