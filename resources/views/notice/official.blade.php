@extends('layouts.notice')

@section('content')

    <div class="content">
      <div class="quest-width">
        <div class="notice-header">
          <div class="item">
            <a href="main">通知</a>
          </div>
          <div class="item main-notice">
            運営より
          </div>
        </div>
      @foreach($newsposts as $newspost)
        <div class="official-notice">
          <div class="official-notice-title">
          <span class="notice-title">{{ $newspost->name }}</span> <span class="notice-date"><?php echo date('Y年n月d日', strtotime($newspost->updated_at)); ?></span>
        </div>
        <div class="official-notice-content">
          {!! nl2br(e($newspost->post)) !!}
        </div>
      </div>

      @endforeach
    </div>

@endsection
