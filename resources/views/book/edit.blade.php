 @extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header">Edit book </div>

               <div class="card-body">


                    <form method="POST" action="{{route('book.update',[$book])}}">

                    <div class="form-group">
                        <label>Title:  </label>
                        <input type="text" class="form-control" name="book_title" value="{{old('book_title', $book->title)}}">
                        <small class="form-text text-muted">Edit book title.</small>
                    </div>
                    <div class="form-group">
                        <label>Pages:  </label>
                        <input type="text" class="form-control" name="book_pages" value="{{old('book_pages', $book->pages)}}">
                        <small class="form-text text-muted">Edit book pages.</small>
                    </div>
                    <div class="form-group">
                        <label>ISBN: </label>
                        <input type="text" class="form-control" name="book_isbn"  value="{{old('book_isbn', $book->isbn)}}">
                        <small class="form-text text-muted">Edit book ISBN.</small>
                    </div>
                      <div class="form-group">
                        <label>Short description:</label>
                        <textarea id="summernote" name="book_short_description">{{old('book_short_description', $book->short_description)}}</textarea>
                        <small class="form-text text-muted">Short description.</small>
                    </div>
                             <div class="form-group">
                                <label>Author:  </label>
                                 <select name="author_id">
                                 @foreach ($authors as $author)
                                    <option value="{{$author->id}}" @if($author->id == $book->author_id) selected @endif>
                                    {{$author->name}} {{$author->surname}}
                                    </option>
                                 @endforeach
                            </select>
                                <small class="form-text text-muted">Please select authors name.</small>
                            </div>

                            <div class="form-group">
                                <label>Publisher:  </label>
                                 <select name="publisher_id">
                                 @foreach ($publishers as $publisher)
                                    <option value="{{$publisher->id}}" @if($publisher->id == $book->publisher_id) selected @endif>
                                    {{$publisher->title}}
                                    </option>
                                 @endforeach
                            </select>
                                <small class="form-text text-muted">Please select publisher.</small>
                            </div>
                             @csrf
                        <button type="submit" class="btn btn-primary">EDIT</button>
                    </form>
               </div>
           </div>
       </div>
   </div>
</div>
<script>
$(document).ready(function() {
   $('#summernote').summernote();
 });
</script>

@endsection


