<!-------------------
home本体
------------------->

@extends('admin_layouts.app')
@include('admin_layouts.head', [])
@include('admin_layouts.header', [])
@section('content_admin')
<main class="l-main">

<!--<header-component></header-component>-->
<router-view></router-view>
<router-view name="works"></router-view>
<router-view name="skills"></router-view>
<router-view name="products"></router-view>
<router-view name="profiles"></router-view>
<router-view name="historys"></router-view>
</main>
@endsection
@include('admin_layouts.footer', [])