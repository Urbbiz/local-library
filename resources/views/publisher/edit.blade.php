@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header">Edit Author</div>
               <div class="card-body">
               <form method="POST" action="{{route('publisher.update',$publisher)}}">
                    <div class="form-group">
                        <label>Name: </label>
                        <input type="text" class="form-control" name="publisher_title"  value="{{old('publisher_title', $publisher->title)}}">
                        <small class="form-text text-muted">Edit  publishers title.</small>
                    </div>                  
   @csrf
   <button type="submit" class="btn btn-primary" >EDIT</button>
</form>
               </div>
           </div>
       </div>
   </div>
</div>
@endsection