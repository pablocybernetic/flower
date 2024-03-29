@extends('admin/adminlayout')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <!-- Include Quill CSS -->
  <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
@section('container')


<div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Add Menu</h4>
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
                      <div class="container mt-5">
                        <form class="forms-sample" action="/menu/add/process" method="post" enctype="multipart/form-data">
                    
                          @csrf
                    
                          <div class="form-group">
                            <label for="exampleInputName1">Name</label>
                            <input type="text" name="name" class="form-control" id="exampleInputName1">
                          </div>
                          <div class="form-group">
                            <label for="editor">Description</label>
                            <div id="editor" style="height: 300px;"></div>
                            <input type="hidden" name="description" id="hiddenDescriptionInput">
                          </div>
                    
                          <div class="form-group">
                            <label for="exampleInputPassword4">Price</label>
                            <input type="number" name="price" class="form-control" id="exampleInputPassword4">
                          </div>
                          <div class="form-group">
                            <label for="exampleSelectGender">Catagory</label>
                            <select class="form-control" name="catagory" id="exampleSelectGender">
                              <option value="regular">Regular</option>
                              <option value="special">Special</option>
                            </select>
                          </div>
                          <div class="form-group">
                            <label for="exampleSelectGender">Season</label>
                            <select class="form-control" name="session" id="exampleSelectGender">
                              <option value="0">Breakfast</option>
                              <option value="1">Lunch</option>
                              <option value="2">Dinner</option>
                            </select>
                          </div>
                    
                          <div class="form-group">
                            <label for="exampleSelectGender">Available</label>
                            <select class="form-control" name="available" id="exampleSelectGender">
                              <option>Stock</option>
                              <option>Out of Stock</option>
                            </select>
                          </div>
                          <div class="form-group">
                            <label for="exampleFormControlFile1">Image</label>
                            <input type="file" name="image" class="form-control-file" id="exampleFormControlFile1">
                          </div>
                    
                          <button type="submit" class="btn btn-primary me-2">Submit</button>
                          <button class="btn btn-dark">Cancel</button>
                        </form>
                      </div>
                    
                      <!-- Include Bootstrap and Popper.js -->
                      <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
                      <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
                      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
                    
                      <!-- Include Quill JS -->
                      <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
                    
                      <script>
                        // Initialize Quill
                        var quill = new Quill('#editor', {
                          theme: 'snow',
                        });
                    
                        // Update the hidden input field with Quill's HTML content
                        quill.on('text-change', function () {
                          var hiddenInput = document.getElementById('hiddenDescriptionInput');
                          hiddenInput.value = quill.root.innerHTML;
                        });
                      </script>
                  </div>
                </div>

            </div>



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