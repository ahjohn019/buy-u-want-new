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

function imagesList($request){
    $attachmentList = [
        'name' => $request->attachments->hashName(),
        'extension' => $request->attachments->extension(),
        'mime_type' => $request->attachments->getClientMimeType(),
        'size' => $request->attachments->getSize()
    ];

    if($request->create){
        $productId = ['product_id' => $request->product_id];
        $attachmentList = array_merge($attachmentList, $productId);
    }

    return $attachmentList;
}