<?php

function currencyList($currency) {
    switch ($currency) {
        case 'Malaysia':
            return 'myr';
            break;
        case 'Singapore':
            return 'sgd';
            break;
        default:
            return 'myr';
            break;
    }
}

function attachmentData($request, $product){
    $attachmentList = [
        'name' => $request->attachments->hashName(),
        'extension' => $request->attachments->extension(),
        'mime_type' => $request->attachments->getClientMimeType(),
        'size' => $request->attachments->getSize()
    ];

    if($request->type == 'create'){
        $productId = ['product_id' => $product->id];
        $attachmentList = array_merge($attachmentList, $productId);
    }

    return $attachmentList;
}

function statusList(){
    return ['hidden','active'];
}