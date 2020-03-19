<?php
/**
 * Notes: 增加每页多少条
 * Author: BillyShen likeboat@163.com
 * Time: 2020/2/29 11:54 下午
 */

namespace App\Library;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BaseModel extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->perPage = \Request::get('limit') ?: 15;
    }

}



