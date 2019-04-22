<?php


namespace Modules\Ivehicles\Transformers;

use Illuminate\Http\Resources\Json\Resource;

class ModelTransformer extends Resource
{

    public function toArray($request){

        $data=[
            'id'=>$this->when($this->id,$this->id),
            'name'=>$this->when($this->name,$this->name),
            'created_at'=>$this->when($this->created_at,$this->created_at),
            'brand'=>new BrandTransformer($this->whenLoaded('brand')),
        ];

        return $data;
    }

}