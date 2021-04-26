@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header"><h3>Book {{$book->title}}</h3> </div>
               <div class="make-inline"> <h3> Description</h3>
               {!!$book->short_description!!}
               </div>
                
               </div>
           </div>
       </div>
   </div>
</div>
@endsection