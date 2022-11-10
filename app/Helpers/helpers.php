<?php
use App\Services\AttachmentServices;
use App\Services\VariantServices;

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

function productColumnName(){
    return  [
                'name',
                'description',
                'category',
                'sku',
                'price',
                'image',
                'status',
                'created_at'
            ];
}

function orderColumnName(){
    return ['id','number','created_at','email','status','payment_id','total','items'];
}

function paymentIntentData($cartTotal, $customerNew){
    $intentData = [
            'amount' => $cartTotal,
            'currency' => currencyList('Malaysia'),
            'customer' => auth()->user()->stripeUsers->stripe_customer_id ?? @$customerNew['id'],
            'payment_method_types' => [
                'card',
            ]
    ];

    return $intentData;
}

function sessionMessage($session){
    switch ($session) {
        case 'orderDeletedMessage':
            return "Order Deleted Successfully";
            break;

        case 'refundSuccessMessage':
            return "Refund Successfully";
            break;

        case 'orderFulFilledMessage':
            return "Order Fulfilled Successfully";
            break;

        case 'orderDeletedMessage':
            return "Order Deleted Successfully";
            break;
            
        default:
            # code...
            break;
    }
}