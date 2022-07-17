@extends('layouts.helloapp')

@section('title', 'Board.add')

@section('menubar')
    @parent
    投稿ページ
@endsection

@section('content')
    @if(count($errors) > 0)
    <div>
        <ul>
            @foreach($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <form action="/board/add" method="post">
        @csrf
        <table>
        <tr><th>person id: </th>
        <td>
        <input type="number" name="person_id" >
        </td>
        </tr>
        <tr><th>title: </th>
        <td>
        <input type="text" name="title">
        </td>
        </tr>
        <tr><th>message: </th>
        <td>
        <input type="text" name="message" >
        </td>
        </tr>
        <tr><th></th><td>

        <input type="submit" value="send">
        </td></tr>
        </table>
    </form>
@endsection

@section('footer')
copyright 2022 keijiro
@endsection
