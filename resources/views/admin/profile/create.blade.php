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
                    @if (count($errors) > 0)
                        <ul>
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    @endif
                    <div class="form-group row md-2">
                        <label class="col-md-2" for="title">氏名</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                        </div>
                    </div> 
                    <div class="form-group row mb-2">
                        <label class="col-md-2" for="gender">性別</label>
                        <div class="col-md-10">
                            <input type="hidden" name="gender" value="">
                                <div class="form-check form-check-inline">
                                    <input type="radio" name="gender" id="男性" value="男性" {{ old('gender') == '男性' ? 'checked' : '' }}>男性
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" name="gender" id="女性" value="女性" {{ old('gender') == '女性' ? 'checked' : '' }}>女性
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" name="gender" id="その他" value="その他" {{ old('gender') == 'その他' ? 'checked' : '' }}>その他
                                </div>
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label class="col-md-2" for="title">趣味</label>
                            <div class="col-md-10">
                                <textarea class="form-control" name="hobby" rows="7">{{ old('body') }}</textarea>
                            </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label class="col-md-2" for="title">自己紹介欄</label>
                            <div class="col-md-10">
                                <textarea class="form-control" name="introduction" rows="7">{{ old('body') }}</textarea>
                            </div>
                    </div>
                    {{ csrf_field() }}
                    <input type="submit" class="btn btn-primary" value="登録">
                </form>
            </div>
        </div>
    </div>
@endsection