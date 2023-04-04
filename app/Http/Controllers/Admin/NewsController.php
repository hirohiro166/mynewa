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

    public function edit()
    {
        return view('admin.news.edit');
    }

    public function update()
    {
        return redirect('admin/news/edit');
    }

}
