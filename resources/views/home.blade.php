@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">

            <h1>{{ trans('dashboard.title') }}</h1>

            @include('panels/uptime', compact('uprobot'))

        </div>
    </div>
</div>
@endsection
