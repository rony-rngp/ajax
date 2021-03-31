<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.15.7/sweetalert2.min.css" integrity="sha512-qZl4JQ3EiQuvTo3ccVPELbEdBQToJs6T40BSBYHBHGJUpf2f7J4DuOIRzREH9v8OguLY3SgFHULfF+Kf4wGRxw==" crossorigin="anonymous" />
    <title>Laravel Ajax Crud</title>
  </head>
  <body>
    
    <div class="container">
        
    <div class="row" style="margin-top: 50px">
        <div class="col-md-8">
            <div class="card">
              <div class="card-header">
                All Teacher
              </div>
              <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Title</th>
                            <th>Institute</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>

                        <!-- <tr>
                            <td>Rony</td>
                            <td>Web Developer</td>
                            <td>Anything</td>
                            <td>
                                <a href="" class="btn btn-sm btn-info">Edit</a>
                                <a href="" class="btn btn-sm btn-danger">Delete</a>
                            </td>
                        </tr> -->
                    </tbody>
                </table>
              </div>
            </div>
        </div>


        <div class="col-md-4">
            <div class="card">
                <div class="card-header"><span id="Add">Add Teacher</span>  <span id="Edit">Edit Teacher</span></div>

                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" placeholder="Name" class="form-control">
                        <span class="text-danger" id="nameError"></span>
                    </div>
                
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" name="title" id="title" placeholder="Title" class="form-control">
                        <span class="text-danger" id="titleError"></span>
                    </div>
 
                    <div class="form-group">
                        <label for="institute">Institute</label>
                        <input type="text" name="institute" id="institute" placeholder="Institute" class="form-control">
                        <span class="text-danger" id="instituteError"></span>
                    </div>

                    <input type="hidden" id="id" >

                    <button type="submit" id="submitBtn" onclick="addData()" class="btn btn-primary">Submit</button>
                    <button type="submit" id="updateBtn" onclick="updateData()" class="btn btn-primary">Update</button>
                    
                </div>
            </div>

        </div>
    </div>

    </div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.15.7/sweetalert2.min.js" integrity="sha512-IHQXMp2ha/aGMPumvzKLQEs9OrPhIOaEXxQGV5vnysMtEmNNcmUqk82ywqw7IbbvrzP5R3Hormh60UVDBB98yg==" crossorigin="anonymous"></script>
  <script type="text/javascript">
      $('#Add').show();
      $("#submitBtn").show();
      $('#Edit').hide();
      $("#updateBtn").hide();

    allData();

    function allData() {
        
        $.ajax({
            url : "{{ route('teacher.all') }}",
            type : "get",
            dataType : "json",
            success:function (res) {
                var data = "";
               $.each(res, function(key, value){
                    data += "<tr>";
                    data += "<td>"+value.name+"</td>"
                    data += "<td>"+value.title+"</td>"
                    data += "<td>"+value.institute+"</td>"
                    data +="<td>"
                    data += "<button class='btn btn-sm btn-info' onclick='editData("+value.id+")'>Edit</button> &nbsp;"
                    data += "<button class='btn btn-sm btn-danger' onclick='deleteData("+value.id+")'>Delete</button>"
                    data +="</td>"

                    data += "</tr>";

               });
               $('tbody').html(data);
            }
        });

    }


    function clear(){
        $('#name').val('');
        $('#title').val('');
        $('#institute').val('');

        $("#nameError").text('');
        $("#titleError").text('');
        $("#instituteError").text('');
    }


    function addData(){
        var name = $('#name').val();
        var title = $('#title').val();
        var institute = $('#institute').val();

        $.ajax({
            url : "{{ route('teacher.add') }}",
            type : "post",
            data : {name:name, title:title, institute:institute, "_token": "{{ csrf_token() }}"},

            success: function(data){
                Swal.fire({
                  toast : 'true',  
                  position: 'top-end',
                  icon: 'success',
                  title: 'Data Successfully Added',
                  showConfirmButton: false,
                  timer: 1500
                });

                clear();
                allData();
            },
            error: function(error){
                $("#nameError").text(error.responseJSON.errors.name);
                $("#titleError").text(error.responseJSON.errors.title);
                $("#instituteError").text(error.responseJSON.errors.institute);
            }
        })
    }

    function editData(id){

       $.ajax({
            url : "{{ route('teacher.edit') }}",
            type : "GET",
            data : {id:id},
            success: function(data){

                $('#Add').hide();
                $("#submitBtn").hide();
                $('#Edit').show();
                $("#updateBtn").show();

                $("#name").val(data.name);
                $("#title").val(data.title);
                $("#institute").val(data.institute);
                $('#id').val(data.id);
            },
       });
    }

    function updateData(){
        var name = $('#name').val();
        var title = $('#title').val();
        var institute = $('#institute').val();
        var id = $('#id').val();

        $.ajax({
            url : "{{ route('teacher.update') }}",
            type : "post",
            data : {name:name, title:title, institute:institute,id:id, "_token": "{{ csrf_token() }}"},

            success: function(data){

                Swal.fire({
                  toast : 'true',  
                  position: 'top-end',
                  icon: 'success',
                  title: 'Data Successfully Added',
                  showConfirmButton: false,
                  timer: 1500
                });

                clear();
                allData();
                $('#Add').show();
                $("#submitBtn").show();
                $('#Edit').hide();
                $("#updateBtn").hide();
            },
            error: function(error){
                $("#nameError").text(error.responseJSON.errors.name);
                $("#titleError").text(error.responseJSON.errors.title);
                $("#instituteError").text(error.responseJSON.errors.institute);
            }
        });
    }


    function deleteData(id){
        const swalWithBootstrapButtons = Swal.mixin({
          customClass: {
            confirmButton: 'btn btn-success',
            cancelButton: 'btn btn-danger'
          },
          buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
          title: 'Are you sure?',
          text: "You won't be able to revert this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Yes, delete it!',
          cancelButtonText: 'No, cancel!',
          reverseButtons: true
        }).then((result) => {
          if (result.isConfirmed) {

            $.ajax({
                url : "{{ route('teacher.delete') }}",
                type : "post",
                data : {id:id, "_token": "{{ csrf_token() }}"},
                success: function(data){
                    
                    swalWithBootstrapButtons.fire(
                      'Deleted!',
                      'Your file has been deleted.',
                      'success'
                    )
                    allData();
                },
            });
            
          } else if (
            /* Read more about handling dismissals below */
            result.dismiss === Swal.DismissReason.cancel
          ) {
            swalWithBootstrapButtons.fire(
              'Cancelled',
              'Your imaginary file is safe :)',
              'error'
            )
          }
        });
    }

    

   

  </script>

  </body>
</html>