<?php

namespace App\Http\Resources;

use App\Library\BaseResourceCollection;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ArticleCollection extends BaseResourceCollection
{

    public $collects = 'App\Http\Resources\ArticleResource';
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
