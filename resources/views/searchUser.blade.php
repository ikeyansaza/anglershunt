@extends('layouts.view')

@section('h1', 'ユーザー検索')

@section('content')

    <div class="search-word">
      <form class="" action="/searchUser">
        <button type="submit" name="button">
          <i class="fas fa-search"></i>
        </button>
        <input type="text" name="keyword" value="{{ $keyword }}" class="form-control" placeholder="@ユーザー名">
      <div class="">
        エリア検索:
        <select name="area" style="cursor:pointer;">
          <option value="" selected>都道府県</option>
          <option <?= $area == '北海道' ? 'selected' : "" ?> value="北海道">北海道</option>
          <option <?= $area == '青森県' ? 'selected' : "" ?> value="青森県">青森県</option>
          <option <?= $area == '岩手県' ? 'selected' : "" ?> value="岩手県">岩手県</option>
          <option <?= $area == '宮城県' ? 'selected' : "" ?> value="宮城県">宮城県</option>
          <option <?= $area == '秋田県' ? 'selected' : "" ?> value="秋田県">秋田県</option>
          <option <?= $area == '山形県' ? 'selected' : "" ?> value="山形県">山形県</option>
          <option <?= $area == '福島県' ? 'selected' : "" ?> value="福島県">福島県</option>
          <option <?= $area == '茨城県' ? 'selected' : "" ?> value="茨城県">茨城県</option>
          <option <?= $area == '栃木県' ? 'selected' : "" ?> value="栃木県">栃木県</option>
          <option <?= $area == '群馬県' ? 'selected' : "" ?> value="群馬県">群馬県</option>
          <option <?= $area == '埼玉県' ? 'selected' : "" ?> value="埼玉県">埼玉県</option>
          <option <?= $area == '千葉県' ? 'selected' : "" ?> value="千葉県">千葉県</option>
          <option <?= $area == '東京都' ? 'selected' : "" ?> value="東京都">東京都</option>
          <option <?= $area == '神奈川県' ? 'selected' : "" ?> value="神奈川県">神奈川県</option>
          <option <?= $area == '新潟県' ? 'selected' : "" ?> value="新潟県">新潟県</option>
          <option <?= $area == '富山県' ? 'selected' : "" ?> value="富山県">富山県</option>
          <option <?= $area == '石川県' ? 'selected' : "" ?> value="石川県">石川県</option>
          <option <?= $area == '福井県' ? 'selected' : "" ?> value="福井県">福井県</option>
          <option <?= $area == '山梨県' ? 'selected' : "" ?> value="山梨県">山梨県</option>
          <option <?= $area == '長野県' ? 'selected' : "" ?> value="長野県">長野県</option>
          <option <?= $area == '岐阜県' ? 'selected' : "" ?> value="岐阜県">岐阜県</option>
          <option <?= $area == '静岡県' ? 'selected' : "" ?> value="静岡県">静岡県</option>
          <option <?= $area == '愛知県' ? 'selected' : "" ?> value="愛知県">愛知県</option>
          <option <?= $area == '三重県' ? 'selected' : "" ?> value="三重県">三重県</option>
          <option <?= $area == '滋賀県' ? 'selected' : "" ?> value="滋賀県">滋賀県</option>
          <option <?= $area == '京都府' ? 'selected' : "" ?> value="京都府">京都府</option>
          <option <?= $area == '大阪府' ? 'selected' : "" ?> value="大阪府">大阪府</option>
          <option <?= $area == '兵庫県' ? 'selected' : "" ?> value="兵庫県">兵庫県</option>
          <option <?= $area == '奈良県' ? 'selected' : "" ?> value="奈良県">奈良県</option>
          <option <?= $area == '和歌山県' ? 'selected' : "" ?> value="和歌山県">和歌山県</option>
          <option <?= $area == '鳥取県' ? 'selected' : "" ?> value="鳥取県">鳥取県</option>
          <option <?= $area == '島根県' ? 'selected' : "" ?> value="島根県">島根県</option>
          <option <?= $area == '岡山県' ? 'selected' : "" ?> value="岡山県">岡山県</option>
          <option <?= $area == '広島県' ? 'selected' : "" ?> value="広島県">広島県</option>
          <option <?= $area == '山口県' ? 'selected' : "" ?> value="山口県">山口県</option>
          <option <?= $area == '徳島県' ? 'selected' : "" ?> value="徳島県">徳島県</option>
          <option <?= $area == '香川県' ? 'selected' : "" ?> value="香川県">香川県</option>
          <option <?= $area == '愛知県' ? 'selected' : "" ?> value="愛媛県">愛媛県</option>
          <option <?= $area == '高知県' ? 'selected' : "" ?> value="高知県">高知県</option>
          <option <?= $area == '福岡県' ? 'selected' : "" ?> value="福岡県">福岡県</option>
          <option <?= $area == '佐賀県' ? 'selected' : "" ?> value="佐賀県">佐賀県</option>
          <option <?= $area == '長崎県' ? 'selected' : "" ?> value="長崎県">長崎県</option>
          <option <?= $area == '熊本県' ? 'selected' : "" ?> value="熊本県">熊本県</option>
          <option <?= $area == '大分県' ? 'selected' : "" ?> value="大分県">大分県</option>
          <option <?= $area == '宮崎県' ? 'selected' : "" ?> value="宮崎県">宮崎県</option>
          <option <?= $area == '鹿児島県' ? 'selected' : "" ?> value="鹿児島県">鹿児島県</option>
          <option <?= $area == '沖縄県' ? 'selected' : "" ?> value="沖縄県">沖縄県</option>
          </select>
          <input type="submit" value="▼" style="border:none;">
      </div>
    </div>

    <div class="follow-content">
    @foreach($data as $following)
      <div class="follow-user">
      <a href="{{ $following->name }}/album">
      <div class="follow-user-prof">
        @if($following->icon_img == null)
        <img class="prof-img2 "src="/images/noimage.jpg">
        @else
        <img class="prof-img2" src="/public/images/{{$following->id}}icon.jpg">
        @endif
      </div>
      </a>
      <div class="follow-user-content">
        <span class="follow-content-name">{{ $following->name }}</span><br>
        <span class="follow-content-add">{{'@'}}{{ $following->name_address }}</span><br>
        <span class="">{{ $following->comment }}</span>
      </div>
      <div class="follow-user-button item">
        {{--
        <span class="follow-button">
          @if (auth()->user()->isFollowing($following->id))
            <form action="{{route('unfollow', ['id' => $following->id])}}" method="POST">
              {{ csrf_field() }}
              {{ method_field('DELETE') }}
              <button type="submit" id="delete-follow-{{ $following->id }}" class="btn btn-danger">
                フォロー解除
              </button>
            </form>
          @else
            <form action="{{route('follow', ['id' => $following->id])}}" method="POST">
            {{ csrf_field() }}
            <button type="submit" id="follow-user-{{ $following->id }}" class="btn btn-success">
              フォローする
            </button>
            </form>
          @endif
        </span>
        --}}
      </div>
      </div>
    @endforeach
      </form>
    </div>


@endsection
