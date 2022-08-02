<?php

namespace App\Http\Resources\frontLogin;

use App\Http\Resources\frontLogin\LoginResources;
use Illuminate\Http\Resources\Json\ResourceCollection;

class LoginCollection extends ResourceCollection
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
    public $collects = LoginResources::class;
}
