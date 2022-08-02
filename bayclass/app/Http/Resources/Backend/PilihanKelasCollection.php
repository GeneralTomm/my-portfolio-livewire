<?php

namespace App\Http\Resources\Backend;

use App\Http\Resources\Backend\PilihanKelasResources;
use Illuminate\Http\Resources\Json\ResourceCollection;

class PilihanKelasCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'data' => $this->collection,
            'links' => [
                'self' => 'link-value',
            ],
        ];
    }

    public $collects = PilihanKelasResources::class;
}
