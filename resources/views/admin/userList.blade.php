@extends('admin/template')
@section('title')
    MOOC POLINEMA - User List
@endsection
@section('head-script')
  <script>
    $(document).ready(function(){
      $(".buttonDelete").click(function() {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
          if (result.isConfirmed) {
            var delurl = $(this).attr('delurl');
            window.location.replace(delurl);
          }
        })
      });

      $(".changePass").click(function() {
        (async () => {
          const { value: password } = await Swal.fire({
            title: "Enter password",
            input: "password",
            inputLabel: "Password",
            inputPlaceholder: "Enter your password",
            inputAttributes: {
              minlength: 8,
              autocapitalize: "off",
              autocorrect: "off"
            },
            inputValidator: (value) => {
              return new Promise((resolve) => {
                if (value.length >= 8 ) {
                  resolve()
                } else {
                  resolve('Min 8 Char')
                }
              })
            }
          });

          if (password) {
            var userid = $(this).attr('userid')
              window.location.replace('{{url('changePass')}}'+'/'+userid+'/'+password);
              Swal.fire('Password Changed','','success')
          }
        })();

      });
    });
  </script>
@endsection
@section('content')
<div class="content-header">
    <div class="container-fluid">
        <!-- general form elements -->
        <div class="card">
            <div class="card-header" style="background-color: #a12520; color: white">
                <h3 class="card-title">User List</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="courseList" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                        <th>No. </th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Badge</th>
                        <th>Level</th>
                        <th>Point</th>
                        <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $no = 1 ?>
                    @foreach ($user as $item)
                    <tr>
                        <td>{{$no++}}</td>
                        <td>{{$item->name}}</td>
                        <td>{{$item->email}}</td>
                        <td>{{$item->role}}</td>
                        <td>{{$item->badges}}</td>
                        <td>{{$item->levels}}</td>
                        <td>{{$item->point}}</td>
                        <td>
                          <a href="{{url('editUser/'.$item->id)}}" class="btn btn-success">Edit</a>
                          <a class="btn btn-dark changePass" userid="{{$item->id}}">Change Password</a>
                          <a delurl="{{url('deleteUser/'.$item->id)}}" class="btn btn-danger buttonDelete">Delete</a>
                        </td>
                    </tr>
                    @endforeach
                  </tbody>
                  <tfoot>
                    <tr>
                        <th>No. </th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Badge</th>
                        <th>Level</th>
                        <th>Point</th>
                        <th>Action</th>
                    </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->   
        </div>
        <!-- /.card -->
    </div><!-- /.container-fluid -->
</div>
@endsection
@section('script')
@endsection