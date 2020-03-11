<?php

namespace App;

use App\Library\BaseModel;
use Illuminate\Database\Eloquent\Model;

class Article extends BaseModel
{
    protected $fillable = ['title','body'];


    /**
     * Notes: 文章所有者
     * Author: BillyShen likeboat@163.com
     * Time: 2020/3/11 10:28 下午
     * @return mixed
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
