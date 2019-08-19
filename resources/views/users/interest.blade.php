@extends('admin.master')

@section('content')
	<div class="right_col" role="main">
		  <div class="row">
        <!--flass message-->
        @if (count($errors) > 0)
            <div class="alert alert-danger">
              <a class='close' data-dismiss='alert'>×</a>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif        
        @if(Session::has('success'))
            <div class="alert alert-success">
              <a class='close' data-dismiss='alert'>×</a>
                <h4>{!!Session::get('success')!!}</h4>
            </div>
        @endif        

        @if(Session::has('fail'))
            <div class="alert alert-danger">
                <h4>{!!Session::get('fail')!!}</h4>
            </div>
        @endif
        <!--end flass message-->
      </div>  

        <div class="table-responsive">
            <button class="btn-default btn btn-sm" data-toggle="modal" data-target="#addSkills"><i class="fas fa-plus-circle"></i> Interest</button>

            
            <table class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th>Sl No:</th>
                    <th>Interest</th>
                    <th>Type</th>


                    <th>Delete</th>
                </tr>
                </thead>
                <tbody>
                	<?php 
                		$i=1;
                	?>

                @forelse($interests as $value)
                	<tr>
                    <td>{{$i++}}</td>
                    <td>{{$value->interest}}</td>
                    <td>{{$value->type}}</td>
                       
                        <?php 
                        /*
                        echo 
                        '
                        <i class="fas fa-edit" onClick ="edit('.$value->id.',\''.$value->country.'\',\''.$value->city.'\',\''.$value->address.'\')" data-toggle="modal" data-target="#editform"
                        aria-hidden="true" style="color:green; font-size:18px;cursor:pointer;"></i>

                        ';
                        */
                        ?>
                        
                        <td class="" id="dlt"><i id="delete" onClick="deleteUser({{$value->id}})" class=" fas fa-trash-alt" style="color:red; font-size:18px;cursor:pointer;"></i></td>                		
                	</tr>
                @empty
                	<tr>
                		<td>No record found</td>
                	</tr>
                @endforelse
                </tbody>
            </table>  
     
        </div>      

<!-- Modal for skills -->
<div class="modal fade" id="addSkills" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Your Interest</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="{{route('saveInterest')}}" enctype="multipart/form-data">
              {{ csrf_field() }}
          <input type="hidden" name="type" value="skill">

          <div class="form-group">
            <label for="country">Add Interest</label>
            <input class="form-control" id="search" name="" onkeyup="getInterests()" placeholder="search interest..."></input>
            <div class="search-result"></div>
          </div>          
       
          <div class="form-group">
            <button type="submit" class="btn-default btn" id="save">Submit</button>
          </div>

        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!--modal for skills end-->   

<!--edit form--> 

<div class="modal fade" id="editform" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update Location</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="{{route('updateLocation')}}" enctype="multipart/form-data">
              {{ csrf_field() }}
              
          <input type="hidden" name="id">

          <div class="form-group">

            <label for="country">Country</label>
            <input class="form-control" name="name" required></input>
          </div>

          <div class="form-group">

            <label for="name">City</label>
            <input class="form-control" name="city" id="name" required></input>
          </div>   

          <div class="form-group">
            <label for="name">Address</label>
            <input class="form-control" name="address" id="name" required></input>
          </div>   

          <div class="form-group">
            <button type="submit" class="btn-default btn" id="save">Submit</button>
          </div>

        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!--edit form end--> 
	</div><!--main  col div end-->
@endsection

@section('js')

	<script type="text/javascript">
		function edit(id, country,city,address){
      $('[name="id"]').val(id);
      $('[name="name"]').val(country);
      $('[name="city"]').val(city);
      $('[name="address"]').val(address);

		}

//deleting 
 
	</script>
  <script type="text/javascript">

      function deleteUser(id){
        
       var url ="<?php echo url('delete-interest')?>";

        if(confirm('Are you sure delete this data?'))
        {
          // ajax delete data from database
            $.ajax({

              url : url+'/'+id,            
              type: "GET",
              dataType: "HTML",
              success: function(data)
              {
                  
               $("#dlt").closest("tr").remove();
              },
              error: function (jqXHR, textStatus, errorThrown)
              {
                  alert('Error deleting data');
              }
          });

        }
      }
//get location from here
  function getInterests(){
        var interest= $("#search").val();
            $.ajax({

              url : "<?php echo url('search-interest')?>"+'/'+interest,            
              type: "GET",
              dataType: "HTML",
              success: function(data)
              {
                 console.log(data); 
               $(".search-result").html(data);
              },
              error: function (jqXHR, textStatus, errorThrown)
              {
                  //alert('Error deleting data');
              }
          });

  }      
  </script>
@endsection