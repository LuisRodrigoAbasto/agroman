@extends('layouts.app')

@section('content')
{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div> --}}
<template v-if="menu==0">
    <usuario-component></usuario-component>
</template>
<template v-if="menu==1">
    <departamento-component></departamento-component>
</template>
<template v-if="menu==2">
    <sucursal-component></sucursal-component>
{{-- </template>
<iframe width="900" height="700" src="https://app.powerbi.com/view?r=eyJrIjoiNDdlMmU1NmUtMWJlYy00YWQyLTg5MDktNDU4ZDNjOTg5NTRjIiwidCI6ImEwNGJlMDE1LWIyNjYtNDRiZi1iZTM3LTIxMWNmZDQ0YTMyMSIsImMiOjR9" frameborder="0" allowFullScreen="true"></iframe>
<iframe width="933" height="700" src="https://app.powerbi.com/view?r=eyJrIjoiNDdlMmU1NmUtMWJlYy00YWQyLTg5MDktNDU4ZDNjOTg5NTRjIiwidCI6ImEwNGJlMDE1LWIyNjYtNDRiZi1iZTM3LTIxMWNmZDQ0YTMyMSIsImMiOjR9" frameborder="0" allowFullScreen="true"></iframe> --}}
@endsection
