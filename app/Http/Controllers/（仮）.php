<?php

  public function store(Request $request){
    //クエスト達成テーブルから検索する処理を記述



    //左辺はクエスト達成テーブルから検索した値をカラムごとに配列の形で格納
    //クエスト達成テーブルに同じユーザーIDがない場合
    if (!($quest_user_id == $request->user_id)) {
      $quest->save();
    }
    //クエスト達成テーブルに同じユーザーIDはあるが同じクエストIDがない場合
    elseif ($quest_user_id == $request->user_id AND !($quest_id == $request->quest_id)) {
      $quest->save();
    }
    //クエスト達成テーブルに同じユーザーIDとクエストIDはあるが同じ登録年ではない場合
    elseif ($quest_user_id == $request->user_id AND $quest_id == $request->quest_id
            AND !($quest_year == $request->quest_year)) {
      $quest->save();
    }
    //クエスト達成テーブルに同じユーザーIDとクエストIDと登録年はあるが同じ登録月ではない場合
    elseif ($quest_user_id == $request->user_id AND $quest_id == $request->quest_id
            AND $quest_year == $request->quest_year AND !($quest_month == $request->quest_month)) {
      $quest->save();
    }
    //クエスト達成テーブルに同じユーザーIDとクエストIDと登録年と登録月がある場合falseを返しエラーメッセージを表示
    else {
      false;
      echo->erro_message;
    }

  }
