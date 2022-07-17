@extends('layouts.helloapp')

@section('title', 'Index')

@section('menubar')
    @parent
    詳細ページ
@endsection

@section('content')
    <table>
        <tr><th>Person</th><th>Board</th></tr>
        @foreach($hasItems as $item)
            <tr>
                <td>{{$item->getData()}}</td>
                <td>@if($item->boards != null )
                    <table width="100%">
                    @foreach($item->boards as $board)
                    <tr><td>{{$board->getData()}}</td></tr>
                    @endforeach
                    </table>
                    @endif
                </td>
            </tr>
        @endforeach
    </table>
    <div style="margin: 10px;"></div>
    <table>
        <tr><th>Person</th></tr>
        @foreach($noItems as $item)
            <tr>
                <td>{{$item->getData()}}</td>
            </tr>
        @endforeach
    </table>
@endsection

@section('footer')
copyright 2022 keijiro
@endsection
