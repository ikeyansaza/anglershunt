@extends('layouts.auth')

@section('link', 'register')

@section('span' , '登録')

@section('content')

  <div class="register-container">
    <div class="register-body">
      <div class="register-title">
        ログイン
      </div>

      <form method="POST" action="{{ route('login') }}">
          @csrf

      <div class="register-items">
        @if ($errors->has('email'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('email') }}</strong>
            </span> <br>
        @endif
        メールアドレス <br><br>
        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
      </div>
<br>
      <div class="register-items">
        パスワード <br><br>
        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
        @if ($errors->has('password'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
        @endif
      </div>
      <div class="register-item">
        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
        <label class="form-check-label" for="remember">
            次回ログインを省略する
        </label>
      </div>
      <div class="register-end">
        <button type="submit" class="register-button">
            ログイン
        </button>
      </div>
      <div style="color: #11cf2d;text-align: center;">
      <a href="index.php" style="border-bottom: 1px solid #11cf2d;">サイトをチラッと見てみる</a>
      </div>
      <div class="register-pass">
      @if (Route::has('password.request'))
          <a class="btn btn-link" href="{{ route('password.request') }}">
              パスワードを忘れた方はこちら
          </a>
      @endif
      </div>
  </form>
</div>

@endsection
