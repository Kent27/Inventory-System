<!DOCTYPE html>
<html>
<head>
	<title></title>
	<!-- Bootstrap, js, lighbox, editable cdn-->
    @include('templates.initlib');
    <link href="../css/loginpage.css" rel="stylesheet">
</head>
<body style="font-family: gramond;">
	
    @include('templates.loginparticles')
	<div class="container">    

    <div id="loginbox" class="mainbox col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3"> 
        
        <div class="row">                
            <div class="iconmelon">
              <img src="{{ url('/pictures/construct.png') }}" width="150">
            </div>
        </div>
        
        <div class="panel panel-default" >
            <div class="panel-heading">
                <div class="panel-title text-center">Graha Alam Company</div>
            </div>     

            <div class="panel-body" >

                <form name="form" id="form" class="form-horizontal" enctype="multipart/form-data" method="post" action="{{ url('/login') }}">
					@csrf                 
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input autofocus id="email" type="text" class="form-control" name="email" value="" placeholder="Email" required>                                   
                    </div>

                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                        <input id="password" type="password" class="form-control" name="password" placeholder="Password" required>
                    </div>
                                                                

                    <div class="form-group">
                        <!-- Button -->
                        <div class="col-sm-12 controls">
                            <button type="submit" href="#" class="btn btn-primary pull-right"><i class="glyphicon glyphicon-log-in"></i> Log in</button>
                        </div>
                    </div>

					@include('templates.error')
					
                </form>     

            </div>                     
        </div>  
    </div>
</div>


<script type="text/javascript">
        @if(Session::has('pesan'))
            swal('','{{ Session::get("pesan") }}','{{ Session::get("tipe") }}');
        @endif
    </script>
</body>
</html>
