<html lang="en">
<head>
  <title>Upload Documents</title>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

  <!-- Optional theme -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

  <!-- Latest compiled and minified JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</head>
<body>
  @include('templates.nav')
  <div class="container" style="width:80%">
      @include('templates.error')

        @if(session('success'))
        <div class="alert alert-success">
          {{ session('success') }}
        </div> 
        @endif

        @if(session('fail'))
        <div class="alert alert-danger">
          {{ session('fail') }}
        </div> 
        @endif

    <h3 class="jumbotron" style="padding:28px 40px ">Request New Project</h3>
    <form method="post" action="/siteinstructs" enctype="multipart/form-data">
        @csrf
        <div class="form-group" style="width:60%">
          <label for="title">PROJECT TITLE</label>
          <input type="text" class="form-control" id="title" placeholder="Title" name="title" required>
        </div>
        <br>
        
        <div class="input-group control-group" style="margin-bottom:10px">
          <label for="title">DOCUMENTS</label>
          <div class=""> 
              <button class="btn btn-primary btnAdd" type="button"><i class="glyphicon glyphicon-plus"></i>Add</button>
          </div>
        </div>
        <div class="control-group col-sm-3" style="margin-left:-15px">
          <input type="file" name="documents[]" id="documents" class="form-control" required>
        </div>

        <div class="row" >
          <div class="col-sm-2" style="padding:0px">
            
            <select class="form-control" id="doctypes" name="doctypes[]" required>
              <option value="">Document Type</option>
              <option value="Memo">Memo</option>
              <option value="Notulen Rapat">Notulen Rapat</option>
              <option value="Gambar Design">Gambar Design</option>
            </select>
          </div>
          <div class="col-sm-3">
            <input type="text" name="notes[]" id="notes" class="form-control" placeholder="Notes">
          </div>
        </div>

        <!-- <div class="clone hide">
          <div class="delete">
            <div class="control-group" style="margin-top:10px">
              <div class="control-group col-sm-3" style="margin-left:-15px">
                <input type="file" name="documents[]" id="documents" class="form-control">
              </div>

              <div class="row" >
                <div class="col-sm-2" style="padding:0">
                  
                  <select class="form-control" id="doctypes" name="doctypes[]">
                    <option value="">Document Type</option>
                    <option value="Memo">Memo</option>
                    <option value="Notulen Rapat">Notulen Rapat</option>
                    <option value="Gambar Design">Gambar Design</option>
                  </select>
                </div>
                <div class="col-sm-3">
                  <input type="text" name="notes[]" id="notes" class="form-control" placeholder="Notes">
                </div>
                <div class=""> 
                <button class="btn btn-danger" style="height:32px" type="button"><i class="glyphicon glyphicon-remove"></i></button>
                </div>
              </div>
              
            </div>
            
          </div>
        </div> -->
        <!-- Menambah form upload -->
        <div class="increment"></div>
        <hr>
        <div class="form-group">
          
          <textarea id="requester_notes" name="requester_notes" class="form-control" placeholder="Projects Information"></textarea>
        </div>

        <button type="submit" class="btn btn-success" style="margin-top:10px">Submit</button>
        
    </form>        
  </div>


<script type="text/javascript">
  
    $(document).ready(function() {
      
      $(".btnAdd").click(function(){ 
          var html2 = '<div class="clone">'+
    '<div class="delete">'+
    '<div class="control-group" style="margin-top:10px">'+
      '<div class="control-group col-sm-3" style="margin-left:-15px">'+
        '<input type="file" name="documents[]" id="documents" class="form-control" required>'+
      '</div>'+
      '<div class="row" >'+
      '<div class="col-sm-2" style="padding:0">'+
        '<select class="form-control" id="doctypes" name="doctypes[]" required>'+
          '<option value="">Document Type</option>'+
          '<option value="Memo">Memo</option>'+
          '<option value="Notulen Rapat">Notulen Rapat</option>'+
          '<option value="Gambar Design">Gambar Design</option>'+
        '</select>'+
      '</div>'+
      '<div class="col-sm-3">'+
        '<input type="text" name="notes[]" id="notes" class="form-control" placeholder="Notes">'+
      '</div>'+
      '<div class=""> '+
      '<button class="btn btn-danger" style="height:32px" type="button"><i class="glyphicon glyphicon-remove"></i></button> '+
      '</div> '+
      '</div> '+
      
    '</div>'+
    
  '</div> '+
  '</div>';
          var html = $(".clone").html();
          $(".increment").append(html2);
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
