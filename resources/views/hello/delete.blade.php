
@extends('layouts.helloapp');
@section('title', 'Edit');
@section('menubar')
@parent
削除
@endsection

@section('content')
<table>
<form action="/hello/del" method="post">
@csrf
    <input type="hidden" name="id" value="{{$form->id}}">
    <tr><th>name: </th><td>{{$form->name}}</td></tr>
    <tr><th>mail: </th><td>{{$form->mail}}</td></tr>
    <tr><th>age: </th><td>{{$form->age}}</td></tr>

    <input type="submit">

</form>

</table>

@endsection
@section('footer')
copyright 2020 tuyano.
@endsection
