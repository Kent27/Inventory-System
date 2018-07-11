<!DOCTYPE html>
<html>
<head>
	<title></title>
	<!-- Bootstrap, js, lighbox, editable cdn-->
    @include('templates.initlib')
</head>
<body style="font-family: gramond;font-size: 18px;">
	@include('templates.nav')

	@yield('content')

	<script type="text/javascript">
    	@if(Session::has('pesan'))
        	swal('','{{ Session::get("pesan") }}','{{ Session::get("tipe") }}');
    	@endif
    </script>
</body>
</html>