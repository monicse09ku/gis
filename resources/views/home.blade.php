@extends('layouts.admin')

@section('title', 'Home')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card" style="text-align: center;background: #f4f4f4; padding: 20px 0; margin-top:200px">
                <h1>Welcome {{ Auth::user()->name }}</h1>
            </div>
        </div>
    </div>
</div>
@endsection
