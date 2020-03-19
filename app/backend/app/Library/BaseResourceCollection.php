<?php
/**
 * Notes: 格式化列表的输出
 * Author: BillyShen likeboat@163.com
 * Time: 2020/3/1 9:45 下午
 */

namespace App\Library;

use Illuminate\Http\Resources\Json\ResourceCollection;

class BaseResourceCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
//        return parent::toArray($request);
        return [
            'list' => $this->collection,
            'pagination' => [
                'total' => $this->total(),
                'current_page' => $this->currentPage(),
                'limit' => $this->perPage()
            ],
        ];
    }
}
