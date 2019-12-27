@extends('layouts.app')

@section('contenido')
<template>
<equipo-component :user="{{ Auth::user() }}"></equipo-component>
</template>
@endsection
