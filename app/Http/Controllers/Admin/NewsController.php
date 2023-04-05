<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\NewsRequest;
use App\Http\Requests\ProfileRequest;
use App\Models\News;

class NewsController extends Controller
{
    //
    public function add()
    {
        return view('admin.news.create');
    }

    //4-15
    public function create(NewsRequest $request)
    {
        //Varidate
        //$this->varidate($request, News::$rules);
        //Newsのインスタンス化
        $news = new News();
        //フォームに入力された内容を格納
        $form = $request->all();

        //フォームから画像を受け取ったら保存してimage_pathにパスを保存
        if (isset($form['images'])) {
            $path = $request->file('image')->store('public/image');
            $news->image_path = basename($path);
        } else {
            $news->image_path = null;
        };

        //フォームから送信された_tokenを削除
        unset($form['_token']);
        //画像を削除
        unset($form['image']);

        //データベースに保存
        $news->fill($form);
        $news->save();
        //admin/news/createにリダイレクト
        return redirect('admin/news/create');
    }

    public function index(Request $request)
    {
        $cond_title = $request->cond_title;
        if ($cond_title !=''){
            //検索されたら結果を取得
            $posts = News::where('title',$cond_title)->get();
        } else {
            //それ以外は全てのニュースを取得
            $posts = News::all();
        }
        return view('admin.news.index', ['posts' => $posts, 'cond_title' => $cond_title]);
    }

    public function edit()
    {
        return view('admin.news.edit');
    }

    public function update()
    {
        return redirect('admin/news/edit');
    }

}
