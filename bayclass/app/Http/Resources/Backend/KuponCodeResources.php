<?php

namespace App\Http\Resources\Backend;

use Illuminate\Http\Resources\Json\JsonResource;

class KuponCodeResources extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'nama_kupon' => $this->nama_kupon,
            'status' => $this->status,
            'kode_kupon' => $this->kode_kupon,
            'user_id' => $this->user_id,
        ];
    }

    public $preserveKeys = true;


}
