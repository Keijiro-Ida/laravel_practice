<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Person;
use App\Http\Requests\HelloRequest;
use Validator;

class HelloController extends Controller
{
    public function index(Request $request) {

        $validator = Validator::make($request->query(), [
            'id'=> 'required',
            'pass' => 'required'
        ]);

        if($validator->fails()) {
            $msg = 'クエリに問題あります。';
        } else {
            $msg = 'ID/PASSを受け付けました。';
        }

        return view('hello.index', ['msg'=>$msg]);
    }
    public function post(Request $request) {

        $rules = [
            'name' => 'required',
            'mail' => 'email',
            'age' => 'numeric',

        ];
        $messages = [
            'name.required' => '名前は必ず入れてね',
            'mail.email' => 'メールアドレスが必要よん',
            'age.numeric' => '年齢は整数で記入ください',
            'age.min' => '年齢はゼロ以上でね。',
            'age.max' => '年齢は200以下で。',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        $validator->sometimes('age', 'min:0', function($input) {
            return is_numeric($input->age);
        });
        $validator->sometimes('age', 'max:200', function($input) {
            return is_numeric($input->age);
        });

        if($validator->fails()) {
            return redirect('/hello')->withErrors($validator)->withInput();
        }

        return view('hello.index', ['msg'=>'正しく入力されました']);
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

    public function ses_get(Request $request) {
        $sesdata = $request->session()->get('msg');
        return view('hello.session', ['session_data'=>$sesdata]);
    }

    public function ses_put(Request $request) {
        $msg = $request->input;
        $request->session()->put('msg', $msg);
        return redirect('hello/session');
    }

}
