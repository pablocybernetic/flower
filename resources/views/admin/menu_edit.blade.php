@extends('admin/adminlayout')
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

@section('container')


@foreach($products as $product)

<div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Edit Menu</h4>
                    <br>
                    @if(Session::has('wrong'))
              
                      <div class="alert">
                    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
                    <strong>Opps !</strong> {{Session::get('wrong')}}
                  </div>
                  <br>
                      @endif
                      @if(Session::has('success'))
                 
                      <div class="success">
                    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
                    <strong>Congrats !</strong> {{Session::get('success')}}
                  </div>
                      <br>
                      @endif

                      <form class="forms-sample" action="{{ asset('/menu/edit/process/'.$product->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                      
                        <div class="form-group">
                          <label for="exampleInputName1">Name</label>
                          <input type="text" name="name" value="{{ $product->name }}" class="form-control" id="exampleInputName1">
                        </div>
                      
                        <div class="form-group">
                          <label for="editor">Description</label>
                          <div id="editor" style="height: 300px;">{!! $product->description !!}</div>
                          <input type="hidden" name="description" id="hiddenDescriptionInput">
                        </div>
                      
                        <div class="form-group">
                          <label for="exampleInputPassword4">Price</label>
                          <input type="number" name="price" value="{{ $product->price }}" class="form-control" id="exampleInputPassword4">
                        </div>
                      
                        <!-- ... (Other form fields) ... -->
                        <div class="form-group">
                          <label for="exampleSelectGender">Catagory</label>
                          <select class="form-control" name="catagory" id="exampleSelectGender">
                            <option value="regular" @php if($product->catagory=="regular"){ echo"selected"; }   @endphp>Regular</option>
                            <option value="special" @php if($product->catagory=="special"){ echo"selected"; }   @endphp>Special</option>
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="exampleSelectGender">Season</label>
                          <select class="form-control" name="session" id="exampleSelectGender">
                            <option value="0" @php if($product->session=="0"){ echo"selected"; }   @endphp>Breakfast</option>
                            <option value="1" @php if($product->session=="1"){ echo"selected"; }   @endphp>Lunch</option>
                            <option value="2" @php if($product->session=="2"){ echo"selected"; }   @endphp>Dinner</option>
                          </select>
                        </div>
  
                        <div class="form-group">
                          <label for="exampleSelectGender">Available</label>
                          <select class="form-control" name="available" id="exampleSelectGender">
                            <option @php if($product->available=="Stock"){ echo"selected"; }   @endphp>Stock</option>
                            <option @php if($product->available=="Out Of Stock"){ echo"selected"; }   @endphp>Out of Stock</option>
  
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="exampleFormControlFile1">Image</label>
                          <input type="file" name="image" class="form-control-file" id="exampleFormControlFile1">
                      </div>
                      
                        <button type="submit" class="btn btn-primary me-2">Update</button>
                        <button class="btn btn-dark">Cancel</button>
                      </form>
                      
                      <!-- Include Bootstrap and Popper.js -->
                      <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
                      <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
                      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
                      
                      <!-- Include Quill JS -->
                      <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
                      
                      <script>
                        var quill = new Quill('#editor', {
                          theme: 'snow',
                        });
                      
                        // Update the hidden input with the HTML content when the form is submitted
                        $('form').submit(function() {
                          $('#hiddenDescriptionInput').val(quill.root.innerHTML);
                        });
                      </script>
                      
                  </div>
                </div>

            </div>


@endforeach

@endsection()



<style>
.alert {
  padding: 20px;
  background-color: #f44336;
  color: white;
}

.success {
  padding: 20px;
  background-color: #4BB543 ;
  color: white;
}

.closebtn {
  margin-left: 15px;
  color: white;
  font-weight: bold;
  float: right;
  font-size: 22px;
  line-height: 20px;
  cursor: pointer;
  transition: 0.3s;
}

.closebtn:hover {
  color: black;
}
</style>