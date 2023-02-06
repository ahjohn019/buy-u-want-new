<?php

namespace App\Services;

use App\Services\VariantServices;
use App\Services\AttachmentServices;
use App\Http\Requests\VariantRequest;

class ConditionServices{
    public function condition($request){
        if($request->attachments){
            AttachmentServices::save($request);
        }

        $colorsCheck = count($request->variants['colors']) - 1;
        if($colorsCheck != 0 && !empty($request->variants['sizes'])){
            VariantServices::save($request);
        } 
        
    }
}