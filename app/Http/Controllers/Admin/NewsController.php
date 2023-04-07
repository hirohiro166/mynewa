<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\NewsRequest;
use App\Http\Requests\ProfileRequest;
use App\Models\History;
use App\Models\News;
use Carbon\Carbon;

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
        return redirect('admin/news');
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

    public function edit(Request $request)
    {
        //Newsmodelから取得
        $news = News::find($request->id);
        if(empty($news)){
            abort(404);
        }
        return view('admin.news.edit', ['news_form' =>$news]);
    }

    public function update(NewsRequest $request)
    {
        //NewsModelから取得
        $news = News::find($request->id);
        //送信されてきたフォームデータを格納
        $news_form = $request->all();
        if (isset($news_form['image'])){
            $path = $request->file('image')->store('public/image');
            $news->image_path = basename($path);
            unset($news_form['image']);

            //画像削除のチェックボックスにチェックがついたら処理
        } elseif (0 == strcmp($request->remove, 'true')) {
            $news->image_path = null;
        }
        unset($news_form['_token']);
        unset($news_form['remove']);

        //該当するデータを上書きして保存
        $news->fill($news_form)->save();

        $history = new History;
        $history->news_id = $news->id;
        $history->edited_at = Carbon::now();
        $history->save();

        return redirect('admin/news');
    }

    public function delete(Request $request)
    {
        //該当するNewsModelを取得
        $news = News::find($request->id);
        //削除
        $news->delete();

        return redirect('admin/news');
    }

}
