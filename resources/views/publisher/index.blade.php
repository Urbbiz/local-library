@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header">
               <h2>Publishers List</h2>
               
                  
               <a href="{{route('publisher.index',['sort'=>'title'])}}">Sort by title</a>
               <a href="{{route('publisher.index')}}">Default</a>


               </div>
               <div class="card-body">
                <ul class="list-group">
                  @foreach ($publishers as $publisher)
                    <li class="list-group-item list-line">
                      <div>
                        {{$publisher->title}} 
                      </div> 
                      <div class="list-line__buttons">
                        <a href="{{route('publisher.edit',[$publisher])}}" class="btn btn-info">EDIT</a>
                        <form method="POST" action="{{route('publisher.destroy', [$publisher])}}">
                        @csrf
                        <button type="submit" class="btn btn-danger">DELETE</button>
                        </form>
                      </div>
                    </li>
                    @endforeach
                </ul>
               </div>
           </div>
       </div>
   </div>
</div>
@endsection
