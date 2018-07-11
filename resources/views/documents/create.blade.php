<html lang="en">
<head>
  <title>Upload Documents</title>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
</head>
<body>
  <div class="container">
      @include('templates.error')

        @if(session('success'))
        <div class="alert alert-success">
          {{ session('success') }}
        </div> 
        @endif

    <h3 class="jumbotron">Upload Documents</h3>
    <form method="post" action="/documents" enctype="multipart/form-data">
        @csrf
        <div class="input-group control-group" style="margin-bottom:10px">
          <div class=""> 
              <button class="btn btn-success" type="button"><i class="glyphicon glyphicon-plus"></i>Add</button>
          </div>
        </div>
        <div class="input-group control-group col-sm-5" >
          <input type="file" name="documents[]" id="documents" class="form-control">
        </div>

        <div class="row" >
          <div class="dropdown col-sm-1">
            <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
              Dropdown
              <span class="caret"></span>
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
              <li><a href="#">Action</a></li>
              <li><a href="#">Another action</a></li>
              <li><a href="#">Something else here</a></li>
              <li role="separator" class="divider"></li>
              <li><a href="#">Separated link</a></li>
            </ul>
          </div>
          <div class="col-sm-4">
            <input type="text" name="notes[]" id="notes" class="form-control">
          </div>
        </div>

        <div class="clone hide">
          <div class="delete">
            <div class="control-group input-group col-sm-6" style="margin-top:10px">
              <input type="file" name="documents[]" id="documents" class="form-control">
              <div class="input-group-btn"> 
                <button class="btn btn-danger" type="button"><i class="glyphicon glyphicon-remove"></i> Remove</button>
              </div>
            </div>
            <div class="row" >
              <div class="dropdown col-sm-1">
                <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                  Type
                  <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                  <li><a href="#">Action</a></li>
                  <li><a href="#">Another action</a></li>
                  <li><a href="#">Something else here</a></li>
                  <li role="separator" class="divider"></li>
                  <li><a href="#">Separated link</a></li>
                </ul>
              </div>
              <div class="col-sm-4">
                <input type="text" name="notes[]" id="notes" class="form-control">
              </div>
            </div>
          </div>
        </div>
        <div class="increment"></div>
        <button type="submit" class="btn btn-primary" style="margin-top:10px">Submit</button>
        
    </form>        
  </div>


<script type="text/javascript">

    $(document).ready(function() {

      $(".btn-success").click(function(){ 
          var html = $(".clone").html();
          $(".increment").append(html);
      });

      $("body").on("click",".btn-danger",function(){ 
          $(this).parents(".delete").remove();
      });

    });

</script>
</body>
</html>


	<!-- <script>
		//indirect ajax
		//file collection array
		var fileCollection = new Array();
		$('#documents').on('change',function(e){
			var files = e.target.files;
			$.each(files, function(i, file){
				fileCollection.push(file);
				var reader = new FileReader();
				reader.readAsDataURL(file);
				reader.onload = function(e){
					var template = '<form action="/upload">'+
						'<img src="'+e.target.result+'"> '+
						'<label>Image Title</label> <input type="text" name="title">'+
						' <button class="btn btn-sm btn-info upload">Upload</button>'+
						' <a href="#" class="btn btn-sm btn-danger remove">Remove</a>'+
					'</form>';
					$('#documents-to-upload').append(template);
				};
			});
		});
		//form upload ... delegation
		$(document).on('submit','form',function(e){
			e.preventDefault();

			console.log('form_prevented');
			//this form index
			var index = $(this).index();
			console.log(fileCollection[index]);
			var formdata = new FormData($(this)[0]); //direct form not object
			//append the file relation to index
			formdata.append('document',fileCollection[index]);
			var request = new XMLHttpRequest();
			request.open('post', '/documents', true);
			request.send(formdata);
		});
		
	</script> -->
