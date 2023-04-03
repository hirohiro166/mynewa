<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    //
    public function add()
    {
        return view('admin.news.create');
    }

    //4-15
    public function create(Request $request)
    {
        //admin/news/createにリダイレクト
        return redirect('admin/news/create');
    }
}
