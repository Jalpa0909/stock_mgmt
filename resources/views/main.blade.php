@extends('home')
@section('content')
@section('sidebar')
<li class="nav-item active">
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
<li class="nav-item ">
    <a class="nav-link " href="{{ route('colour.index') }}">
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
@endsection
