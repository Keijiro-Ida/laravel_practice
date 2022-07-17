<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HelloController extends Controller
{
    public function index(Request $request) {

        $items = DB::table('people')->get();
        return view('hello.index', ['items'=>$items]);
    }
    public function post(Request $request) {

        return view('hello.index', ['msg'=>$request->msg]);
    }

    public function show(Request $request) {
        $min = $request->min;
        $max = $request->max;

        $items = DB::table('people')->whereRaw('age >= ? and age <= ?', [$min, $max])->orderBy('id', 'asc')->offset(20)->limit(5)->get();
        return view('hello.show', ['items'=> $items]);
    }

    public function add(Request $request) {

        return view('hello.add');
    }

    public function create(Request $request) {

        $param = [
            'name' => $request->name,
            'mail' => $request->mail,
            'age' => $request->age,
        ];

        DB::table('people')->insert($param);
        return redirect('/hello');
    }

    public function edit(Request $request) {

        $item = DB::table('people')->where('id', $request->id)->first();

        return view('hello.edit', ['form'=>$item]);
    }

    public function update(Request $request) {

        $param = [
            'name' => $request->name,
            'mail'=> $request->mail,
            'age' => $request->age,
        ];

        DB::table('people')->where('id', $request->id)->update($param);

        return redirect('/hello');
    }

    public function del(Request $request) {

        $item = DB::table('people')->where('id', $request->id)->first();

        return view('hello.delete', ['form'=>$item]);
    }

    public function remove(Request $request) {

        DB::table('people')->where('id', $request->id)->delete();

        return redirect('/hello');
    }

    public function rest(Request $request) {
        return view('hello.rest');
    }

}
