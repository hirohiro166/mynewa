{{-- layouts/profile.blade.phpを読み込む --}}
@extends('layouts.profile')

{{-- profile.blade.phpの@yield('MyNews')に'プロフィールの新規作成'を埋め込む --}}
@section('MyNews', 'プロフィールの新規作成')

{{-- profile.blade.phpの@yield('content')に以下のタグを埋め込む --}}
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>Myプロフィール作成画面</h2>
                <form action="{{ route('profile.create') }}" method="post" enctype="multipart/form-data">
                    <div class="form-group row md-2">
                        <label class="col-md-2" for="title">氏名</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="title" value="{{ old('title') }}">
                        </div>
                    </div> 
                    <div class="form-group row mb-2">
                        <label class="col-md-2" for="gender">性別</label>
                        <div class="col-md-3">
                        <input type="hidden" name="id" value="">
                            <label><input type="radio" name="gender" value="0">男性</label>
                            <label><input type="radio" name="gender" value="1">女性</label>
                            <label><input type="radio" name="gender" value="1">その他</label>
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label class="col-md-2" for="title">趣味</label>
                            <div class="col-md-10">
                                <textarea class="form-control" name="body" rows="7">{{ old('body') }}</textarea>
                            </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label class="col-md-2" for="title">自己紹介欄</label>
                            <div class="col-md-10">
                                <textarea class="form-control" name="body" rows="7">{{ old('body') }}</textarea>
                            </div>
                    </div>
                    {{ csrf_field() }}
                    <input type="submit" class="btn btn-primary" value="登録">
                </form>
            </div>
        </div>
    </div>
@endsection