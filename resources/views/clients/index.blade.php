@extends('templates.master')
@section('content')
<div class="jumbotron text-center">
    <h1>Clients</h1>
    <p>Our trusted sellers and buyers from all around the world!</p>
    
</div>
<div class="container-fluid">
    <table class="table table-bordered" id="siteinstructs-table">
        <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Phone Number</th>
                <th>Bank Account/th>
                <th>Last Transaction</th>
                <th>In</th>
                <th>Out</th>
                <th>Actions</th>
            </tr>
        </thead>
        
    </table>
</div>
@endsection