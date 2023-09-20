@extends('home')
@section('content')
@section('sidebar')
<li class="nav-item">
    <a class="nav-link" href="{{ url('main') }}">
        <i class="icon-grid menu-icon"></i>
        <span class="menu-title">Dashboard</span>
    </a>
</li>

<li class="nav-item active">
    <a class="nav-link active" href="{{ route('unit.index') }}">
        <i class="icon-grid menu-icon"></i>
        <span class="menu-title">Manage Unit</span>
    </a>
</li>
<li class="nav-item ">
    <a class="nav-link" href="{{ route('colour.index') }}">
        <i class="icon-paper menu-icon"></i>
        <span class="menu-title">Manage Colour</span>
    </a>
</li>
<li class="nav-item ">
    <a class="nav-link " href="{{ route('size.index') }}">
        <i class="icon-paper menu-icon"></i>
        <span class="menu-title">Manage Size</span>
    </a>
</li>
<li class="nav-item ">
    <a class="nav-link " href="{{ route('brand.index') }}">
        <i class="icon-paper menu-icon"></i>
        <span class="menu-title">Manage Brand</span>
    </a>
</li>
@endsection
@if ($message = Session::get('success'))
<div class="alert alert-success">
  <p>{{ $message }}</p>
</div>
@endif
    <div class="card">
        <div class="card-header">
            <h4 style="color:#4B49AC;"><b>Unit Management</b><a href="#"
                    style="margin-left: 78%;
                    color: #ffffff;background-color: #4B49AC;"
                    class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" >Add New</a></h4>
        </div>
        <div class="card-body">
            <table class="table data-table table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        {{-- <th>Status</th> --}}
                        <th width="100px">Action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Add New Unit</h5>
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form class="forms-sample" action="{{ route('unit.store') }}" method="POST">
            @csrf
                <input type="hidden" name="unit_id" id="unit_id"/>
                <div class="modal-body">
                        <div class="form-group row">
                        <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Title</label>
                        <div class="col-sm-9">
                            <input type="title" id="title" class="form-control" id="exampleInputUsername2" placeholder="Please Enter Unit Title" name="title">
                        </div>
                        </div>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="close">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
          </div>
        </div>
      </div>
    <script type="text/javascript">
        $(function() {
            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('unit.index') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'title',
                        name: 'title'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });
        });
        $('body').on('click', '.editUnit', function() {
            var food_id = $(this).data('id');
            $.get("{{ url('unit') }}" + '/' + 'edit/' + food_id, function(
                data) {
                $('#exampleModal').modal('show');
                $('#unit_id').val(data.id);
                $('#title').val(data.title);
            })
        });

        $('body').on('click', '#close', function() {
            $('#exampleModal').modal('hide');
        });

    </script>
@endsection
