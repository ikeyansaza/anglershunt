@extends('layouts.auth')

@section('link', 'login')

@section('span' , 'ログイン')

@section('content')

<div class="register-container">
    <div class="register-body">
      <div class="register-title">
        登録
      </div>

      <form method="POST" action="{{ route('register') }}">
          @csrf

      <div class="register-items">
        ユーザー名 <br><br>
        @if ($errors->has('name'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
            <br>
        @endif
        <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>
      </div>
      <br>
      <div class="register-items">
        @ユーザー名<span class="register-span">（半角英数字のみ）</span> <br><br>
        @if ($errors->has('name_address'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('name_address') }}</strong>
            </span>
            <br>
        @endif
        <input id="name_address" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name_address" value="{{ old('name_address') }}" required autofocus>
      </div>
      <br>
      <div class="register-items">
        メールアドレス<br><br>
        @if ($errors->has('email'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
            <br>
        @endif
        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
      </div>
      <br>
      <div class="register-items">
        パスワード<span class="register-span">（８文字以上）</span> <br><br>
        @if ($errors->has('password'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
            <br>
        @endif
        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
      </div>
      <br>
      <div class="register-items">
        パスワード<span class="register-span">（再入力）</span><br><br>
        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
      </div>
      <br>
      <div class="register-items">
        <input id="password-confirm" type="checkbox" name="checkbox" required>
        <a href="policy" class="policy">利用規約</a>と<a href="privacy" class="policy">プライバシーポリシー</a>に同意します
      </div>
      <br>
      <div class="register-end">
        <button type="submit" class="register-button">
            登録
        </button>
      </div>
      </div>
    </form>
    </div>
@endsection
