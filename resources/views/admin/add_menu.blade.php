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
                            <label for="exampleSelectGender">Category</label>
                            <select class="form-control" name="catagory" id="exampleSelectGender">
                                <option value="">Select a category</option>
                                <!-- Categories will be populated here by JS -->
                            </select>
                        </div>
                        
                        <script>
                            // Fetch categories from the backend API
                            fetch('/api/categories')
                                .then(response => response.json()) // Parse the response as JSON
                                .then(data => {
                                    if (data.success) {
                                        const categories = data.data; // The list of categories
                                        const selectElement = document.getElementById('exampleSelectGender');
                        
                                        // Loop through the categories and create option elements
                                        categories.forEach(category => {
                                            const option = document.createElement('option');
                                            option.value = category.slug; // Use slug as the value
                                            option.textContent = category.name; // Display the category name
                                            selectElement.appendChild(option); // Append option to the select
                                        });
                                    }
                                })
                                .catch(error => {
                                    console.error('Error fetching categories:', error);
                                });
                        </script>
                        
                          <div class="form-group">
                            <label for="exampleSelectGender">Season</label>
                            <select class="form-control" name="session" id="exampleSelectGender">
                              <option value="0">All seasons</option>
                              <option value="1">Winter</option>
                              <option value="2">Summer</option>
                            </select>
                          </div>
                          <div class="form-group">
                            <label for="exampleSelectGender">Size</label>
                            <select class="form-control" name="size" id="exampleSelectGender">
                              <option value="Small">Small</option>
                              <option value="Medium">Medium</option>
                              <option value="Large">Large</option>

                            </select>
                          </div>     <div class="form-group">
                            <label for="exampleSelectGender">Light Requirements</label>
                            <select class="form-control" name="light" id="exampleSelectGender">
                              <option value="Full Sun">Full Sun</option>
                              <option value="Partial Sun">Partial Sun</option>
                              <option value="Low Light">Low Light</option>

                            </select>
                          </div>     <div class="form-group">
                            <label for="exampleSelectGender">Watering Needs</label>
                            <select class="form-control" name="water" id="exampleSelectGender">
                              <option value="Low">Low</option>
                              <option value="Medium">Medium</option>
                              <option value="High">High</option>

                            </select>
                          </div>     <div class="form-group">
                            <label for="exampleSelectGender">Growth Rate</label>
                            <select class="form-control" name="growth" id="exampleSelectGender">
                              <option value="Slow">Slow</option>
                              <option value="Medium">Medium</option>
                              <option value="Fast">Fast</option>

                            </select>
                          </div>     <div class="form-group">
                            <label for="exampleSelectGender">Pet-Friendly</label>
                            <select class="form-control" name="pet" id="exampleSelectGender">
                              <option value="Yes">Yes</option>
                              <option value="No">No</option>
                             

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
                    <div class="form-group">
                      <label for="gallery_images">Gallery Images:</label>
                      <input type="file" name="gallery_images[]" id="gallery_images" multiple accept="image/*"  class="form-control-file">
                      
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