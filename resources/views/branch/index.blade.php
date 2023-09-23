@extends('home')
@section('content')
@section('sidebar')
<li class="nav-item">
    <a class="nav-link" href="{{ url('main') }}">
        <i class="icon-grid menu-icon"></i>
        <span class="menu-title">Dashboard</span>
    </a>
</li>

<li class="nav-item">
    <a class="nav-link" href="{{ route('unit.index') }}">
        <i class="icon-grid menu-icon"></i>
        <span class="menu-title">Manage Unit</span>
    </a>
</li>
<li class="nav-item">
    <a class="nav-link active" href="{{ route('colour.index') }}">
        <i class="icon-paper menu-icon"></i>
        <span class="menu-title">Manage Colour</span>
    </a>
</li>
<li class="nav-item">
    <a class="nav-link" href="{{ route('size.index') }}">
        <i class="icon-paper menu-icon"></i>
        <span class="menu-title">Manage Size</span>
    </a>
</li>
<li class="nav-item">
    <a class="nav-link active" href="{{ route('brand.index') }}">
        <i class="icon-paper menu-icon"></i>
        <span class="menu-title">Manage Brand</span>
    </a>
</li>
<li class="nav-item active">
    <a class="nav-link active" href="{{ route('branch.index') }}">
        <i class="icon-paper menu-icon"></i>
        <span class="menu-title">Manage Branch</span>
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
        <h4 style="color:#4B49AC;"><b>Branch Management</b><a href="#" style="margin-left: 93%;
                    color: #ffffff;background-color: #4B49AC;" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Add New</a></h4>
    </div>
    <div class="card-body">
        <table class="table data-table table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Branch Name </th>
                    <th>Branch City</th>
                    <th>Mobile Number</th>
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
                <h5 class="modal-title" id="exampleModalLabel">Add New Brand</h5>
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="forms-sample" action="{{ route('branch.store') }}" method="POST">
                @csrf
                <input type="hidden" name="branch_id" id="branch_id" />
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Branch Name :</label>
                        <div class="col-sm-9">
                            <input type="text" id="branch_name" class="form-control" id="exampleInputUsername2" placeholder="Please Enter Branch Name" name="branch_name" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Branch City :</label>
                        <div class="col-sm-9">
                            <input type="text" id="branch_city" class="form-control" id="exampleInputUsername2" placeholder="Please Enter Branch City" name="branch_city" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Mobile Number :</label>
                        <div class="col-sm-9">
                            <input type="text" id="mobile_number" class="form-control" id="exampleInputUsername2" placeholder="Please Enter Mobile Number" name="mobile_number" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Password :</label>
                        <div class="col-sm-9">
                            <input type="password" id="password" class="form-control" id="exampleInputUsername2" placeholder="Please Enter Password" name="password">
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
            ajax: "{{ route('branch.index') }}",
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'branch_name',
                    name: 'branch_name'
                },
                {
                    data: 'branch_city',
                    name: 'branch_city'
                },
                {
                    data: 'mobile_number',
                    name: 'mobile_number'
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
        $.get("{{ url('branch') }}" + '/' + 'edit/' + food_id, function(
            data) {
            $('#exampleModal').modal('show');
            $('#branch_id').val(data.id);
            $('#branch_name').val(data.branch_name);
            $('#branch_city').val(data.branch_city);
            $('#mobile_number').val(data.mobile_number);
        })
    });

    $('body').on('click', '#close', function() {
        $('#exampleModal').modal('hide');
    });
</script>
@endsection
