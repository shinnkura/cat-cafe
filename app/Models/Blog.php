<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    /* 
    laravelでは、「マスアサイメント」という考え方がある
    フォームやリクエストから送られてきたデータを一気にモデルに登録する方法
    でも安全のために、Laravelはどのデータをまとめて保存してもいいかを指定する必要があります。
    これがfillableというものです。fillableに書かれた項目だけがまとめて保存されます。

    まとめて、指定するときにfillableを使う
    今回、画像は個別で指定したため、fillableにはimageは含めていません。
     */
    protected $fillable = [
        'title',
        'body',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
