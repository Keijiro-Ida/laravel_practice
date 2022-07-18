@extends('layouts.helloapp')
<style>
    .pagination { font-size:10pt; }
.pagination li { display:inline-block }
</style>
@section('title', 'Index')

@section('menubar')
    @parent
    詳細ページ
@endsection

@section('content')

{{ $msg }}
@if(count($errors )> 0)
<p>入力内容に問題があります。</p>
@endif
<form action="/hello" method="post">
    <table>
        @csrf
        @error('name')
        <tr><th>ERROR:</th><td>{{$errors->first('name')}}</td></tr>
        @enderror
        <tr><th>name: </th>
        <td><input type="text" name="name" value="{{old('name')}}"></td></tr>
        @error('mail')
        <tr><th>ERROR:</th><td>{{$errors->first('mail')}}</td></tr>
        @enderror
        <tr><th>mail: </th>
        <td><input type="text" name="mail"value="{{old('mail')}}"></td></tr>
        @error('age')
        <tr><th>ERROR:</th><td>{{$errors->first('age')}}</td></tr>
        @enderror
        <tr><th>age: </th>
        <td><input type="text" name="age" value="{{old('age')}}"></td></tr>
        <tr><th></th><td>
        <input type="submit" value="send"></td></tr>
    </table>
</form>


@endsection

@section('footer')
copyright 2022 keijiro
@endsection
