<nav class="navbar navbar-default">
  		<div class="container-fluid">
    	<div class="navbar-header">
        <?php 
        date_default_timezone_set("Asia/Bangkok");
        $date = date("H");
        $time_hello = "";

        if($date < "11"){
            $time_hello = "Morning";
        }else if($date >= "11" && $date < "16"){
            $time_hello = "Afternoon";
        }else if($date >= "16" && $date < "19"){
            $time_hello = "Evening";
        }else{
            $time_hello = "Night";
        }
        ?>
      		<a class="navbar-brand" href="#">Good {{ $time_hello }}, {{ auth()->user()->name }}</a>
    	</div>
    	<ul class="nav navbar-nav">
      		<li><a href="/">Home</a></li>
      		<li><a href="/transactions">Transactions</a></li>
      		<li><a href="/items">Add Items</a></li>
    	</ul>

    	<ul class="nav navbar-nav navbar-right">
    		<li><a href="{{ url('/logout') }}">Logout</a></li>
    	</ul>
  		</div>
	</nav>