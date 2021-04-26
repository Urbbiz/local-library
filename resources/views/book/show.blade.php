@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header"><h3>Book: {{$book->title}}</h3> </div>
               <div class="make-inline"> <h4> Description:{!!$book->short_description!!}</h4>
               </div>
               <div class="make-inline-show">
               <a href="{{route('author.edit',[$book->bookAuthor])}}" class="btn btn-info">EDIT AUTHOR</a>
               <a href="{{route('book.edit',[$book])}}" class="btn btn-info">EDIT BOOK</a>
               </div>
                
               </div>
           </div>
       </div>
   </div>
</div>
@endsection