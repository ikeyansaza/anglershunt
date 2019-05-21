@extends('layouts.notice')

@section('content')

    <div class="content">
      <div class="quest-width">
        <div class="notice-header">
          <div class="item main-notice">
            通知
          </div>
          <div class="item">
          <a href="official">運営より</a>
          </div>
        </div>
        <div class="notice-receive">
          <a href="{{ route('markRead') }}" style="color: #11cf2d" class="receive-item">通知を受け取る</a><br>
        </div>

        @foreach($notices as $notice)
        <div class="notice-first">
          <div class="item notice-icon">
            <i class="far fa-user"></i>
          </div>
        <div class="item">
          <span style="background-color: lightgray" class="notice-text">{{ $notice->data['follower_name'] }}さんにフォローされました -<?php echo ($notice->created_at)->diffForHumans($now); ?></span><br>
        </div>
        </div>
        @endforeach

        @foreach($oldnotices as $notice)
        <div class="notice-first">
          <div class="item notice-icon">
            <i class="far fa-user"></i>
          </div>
          <div class="item">
          <span class="notice-text">  {{ $notice->data['follower_name'] }}さんにフォローされました -<?php echo ($notice->created_at)->diffForHumans($now); ?></span><br>
          </div>
        </div>
        @endforeach
      </div>
    </div>

@endsection
