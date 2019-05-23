@extends('layouts.mypageSub')

@section('content')
  <body>
    <form method="POST" action="/mypage/album" enctype="multipart/form-data">
    @csrf
    <section>
        <div class="header-top">
        <div class="back-button">
        <a href="../../{{ $user->name_address }}/album"><i class="fas fa-angle-left"></i></a>
        </div>
        <div class="header-up-button">
          ヘッダー画像を変更する <br>
        <span class="file-header-img">
          <input type="file" name="header_img" value="ヘッダー画像を変更する">
        </span>
        </div>
        <div class="header-img">
          <img class="header-img-item" src="/public/images/{{ $user->id }}.jpg">
        </div>
      </div>
    </section>

    <div class="edit-content">
      <div class="prof-edit-main">
        @if($user->icon_img == null)
        <img class="prof-img5" src="/public/images/noimage.jpg">
        @else
        <img class="prof-img5" src="/public/images/{{$user->id}}icon.jpg">
        @endif
        <div class="">
         プロフィール画像を変更する
        </div>
        <div class="icon-img">
          <input type="file" name="icon_img" value=""><br><br>
        </div>
        ユーザー名 <br><br>
        @if ($errors->has('name'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
            <br>
        @endif
        <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ $user->name }}" required>
        <br><br>
        @ユーザー名 <br><br>
        @if ($errors->has('name_address'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('name_address') }}</strong>
            </span>
            <br>
        @endif
        <input id="name" type="text" class="form-control{{ $errors->has('name_address') ? ' is-invalid' : '' }}" name="name_address" value="{{ $user->name_address }}" required>
        <br><br>
        メールアドレス <br><br>
        @if ($errors->has('email'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
            <br>
        @endif
        <input id="name" type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $user->email }}" required>
        <br><br>
        居住エリア <br><br>
        <select name="area" style="cursor:pointer;">
          <option value="" selected>都道府県</option>
          <option <?= $user->area == '北海道' ? 'selected' : "" ?> value="北海道">北海道</option>
          <option <?= $user->area == '青森県' ? 'selected' : "" ?> value="青森県">青森県</option>
          <option <?= $user->area == '岩手県' ? 'selected' : "" ?> value="岩手県">岩手県</option>
          <option <?= $user->area == '宮城県' ? 'selected' : "" ?> value="宮城県">宮城県</option>
          <option <?= $user->area == '秋田県' ? 'selected' : "" ?> value="秋田県">秋田県</option>
          <option <?= $user->area == '山形県' ? 'selected' : "" ?> value="山形県">山形県</option>
          <option <?= $user->area == '福島県' ? 'selected' : "" ?> value="福島県">福島県</option>
          <option <?= $user->area == '茨城県' ? 'selected' : "" ?> value="茨城県">茨城県</option>
          <option <?= $user->area == '栃木県' ? 'selected' : "" ?> value="栃木県">栃木県</option>
          <option <?= $user->area == '群馬県' ? 'selected' : "" ?> value="群馬県">群馬県</option>
          <option <?= $user->area == '埼玉県' ? 'selected' : "" ?> value="埼玉県">埼玉県</option>
          <option <?= $user->area == '千葉県' ? 'selected' : "" ?> value="千葉県">千葉県</option>
          <option <?= $user->area == '東京都' ? 'selected' : "" ?> value="東京都">東京都</option>
          <option <?= $user->area == '神奈川県' ? 'selected' : "" ?> value="神奈川県">神奈川県</option>
          <option <?= $user->area == '新潟県' ? 'selected' : "" ?> value="新潟県">新潟県</option>
          <option <?= $user->area == '富山県' ? 'selected' : "" ?> value="富山県">富山県</option>
          <option <?= $user->area == '石川県' ? 'selected' : "" ?> value="石川県">石川県</option>
          <option <?= $user->area == '福井県' ? 'selected' : "" ?> value="福井県">福井県</option>
          <option <?= $user->area == '山梨県' ? 'selected' : "" ?> value="山梨県">山梨県</option>
          <option <?= $user->area == '長野県' ? 'selected' : "" ?> value="長野県">長野県</option>
          <option <?= $user->area == '岐阜県' ? 'selected' : "" ?> value="岐阜県">岐阜県</option>
          <option <?= $user->area == '静岡県' ? 'selected' : "" ?> value="静岡県">静岡県</option>
          <option <?= $user->area == '愛知県' ? 'selected' : "" ?> value="愛知県">愛知県</option>
          <option <?= $user->area == '三重県' ? 'selected' : "" ?> value="三重県">三重県</option>
          <option <?= $user->area == '滋賀県' ? 'selected' : "" ?> value="滋賀県">滋賀県</option>
          <option <?= $user->area == '京都府' ? 'selected' : "" ?> value="京都府">京都府</option>
          <option <?= $user->area == '大阪府' ? 'selected' : "" ?> value="大阪府">大阪府</option>
          <option <?= $user->area == '兵庫県' ? 'selected' : "" ?> value="兵庫県">兵庫県</option>
          <option <?= $user->area == '奈良県' ? 'selected' : "" ?> value="奈良県">奈良県</option>
          <option <?= $user->area == '和歌山県' ? 'selected' : "" ?> value="和歌山県">和歌山県</option>
          <option <?= $user->area == '鳥取県' ? 'selected' : "" ?> value="鳥取県">鳥取県</option>
          <option <?= $user->area == '島根県' ? 'selected' : "" ?> value="島根県">島根県</option>
          <option <?= $user->area == '岡山県' ? 'selected' : "" ?> value="岡山県">岡山県</option>
          <option <?= $user->area == '広島県' ? 'selected' : "" ?> value="広島県">広島県</option>
          <option <?= $user->area == '山口県' ? 'selected' : "" ?> value="山口県">山口県</option>
          <option <?= $user->area == '徳島県' ? 'selected' : "" ?> value="徳島県">徳島県</option>
          <option <?= $user->area == '香川県' ? 'selected' : "" ?> value="香川県">香川県</option>
          <option <?= $user->area == '愛知県' ? 'selected' : "" ?> value="愛媛県">愛媛県</option>
          <option <?= $user->area == '高知県' ? 'selected' : "" ?> value="高知県">高知県</option>
          <option <?= $user->area == '福岡県' ? 'selected' : "" ?> value="福岡県">福岡県</option>
          <option <?= $user->area == '佐賀県' ? 'selected' : "" ?> value="佐賀県">佐賀県</option>
          <option <?= $user->area == '長崎県' ? 'selected' : "" ?> value="長崎県">長崎県</option>
          <option <?= $user->area == '熊本県' ? 'selected' : "" ?> value="熊本県">熊本県</option>
          <option <?= $user->area == '大分県' ? 'selected' : "" ?> value="大分県">大分県</option>
          <option <?= $user->area == '宮崎県' ? 'selected' : "" ?> value="宮崎県">宮崎県</option>
          <option <?= $user->area == '鹿児島県' ? 'selected' : "" ?> value="鹿児島県">鹿児島県</option>
          <option <?= $user->area == '沖縄県' ? 'selected' : "" ?> value="沖縄県">沖縄県</option>
          </select><br><br>
        コメント <br><br>
        <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="comment" value="{{ $user->comment }}" required>
        <br><br>
        <button type="submit" class="register-button">
            更新
        </button>
        </form>

        <div class="prof-edit-pass">
        <a href="{{ route('password.request') }}">パスワードを変更する</a>
        </div>
      </div>
    </div>

@endsection
