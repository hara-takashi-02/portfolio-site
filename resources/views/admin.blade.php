<!-------------------
home本体
------------------->

@extends('admin_layouts.app')
@include('admin_layouts.head', [])
@include('admin_layouts.header', [])
@section('content_admin')
<main class="l-main">

<!--<header-component></header-component>-->
<router-view auth_type="{{$auth_type}}"></router-view>
<router-view name="works" auth_type="{{$auth_type}}"></router-view>
<router-view name="skills" auth_type="{{$auth_type}}"></router-view>
<router-view name="products" auth_type="{{$auth_type}}"></router-view>
<router-view name="profiles" auth_type="{{$auth_type}}"></router-view>
<router-view name="historys" auth_type="{{$auth_type}}"></router-view>
</main>
@endsection
@include('admin_layouts.footer', [])