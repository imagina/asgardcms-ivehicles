<?php


namespace Modules\Ivehicles\Transformers;

use Illuminate\Http\Resources\Json\Resource;

class BrandTransformer extends Resource
{

    public function toArray($request){

        $data=[
            'id'=>$this->when($this->id,$this->id),
            'name'=>$this->when($this->name,$this->name),
            'description'=>$this->when($this->description,$this->description),
            'status'=>$this->when($this->status,$this->present()->status),
            'created_at'=>$this->when($this->created_at,$this->created_at),
            'models'=>ModelTransformer::collection($this->whenLoaded('models')),
            'vehicles'=>VehicleTransformer::collection($this->whenLoaded('vehicles'))
        ];

        return $data;
    }

}