<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tweet extends Model
{
    use HasFactory;
    // アプリケーション側でcreateなどできない値を記述する
  // 🔽 以下の処理を記述

  protected $guarded = [
    'id',
    'created_at',
    'updated_at',
  ];
  // 🔽 追加
  public static function getAllOrderByUpdated_at()
  {
    return self::orderBy('updated_at', 'desc')->get();
  }

  public function user()
  {
    return $this->belongsTo(User::class);
  }
}
