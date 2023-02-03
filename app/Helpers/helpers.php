<?php
use App\Services\AttachmentServices;
use App\Services\VariantServices;

/**
 * List of currency
 *
 * @return void
 */
function currencyList() {
    return [
        'Malaysia' => 'myr',
        'Singapore' => 'sgd'
    ];
}

/**
 * Attachment Insert Process
 *
 * @param [type] $request
 * @param [type] $product
 * @return void
 */
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

/**
 * Product Table With Column Name
 *
 * @return void
 */
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

/**
 * Order Table With Column Name
 *
 * @return void
 */
function orderColumnName(){
    return ['id','number','created_at','email','status','payment_id','total','items'];
}

/**
 * Payment Intent With Data
 *
 * @param [type] $cartTotal
 * @param [type] $customerNew
 * @return void
 */
function paymentIntentData($cartTotal, $customerNew){
    $intentData = [
            'amount' => $cartTotal,
            'currency' => currencyList()['Malaysia'],
            'customer' => auth()->user()->stripeUsers->stripe_customer_id ?? @$customerNew['id'],
            'payment_method_types' => [
                'card',
            ]
    ];

    return $intentData;
}

/**
 * Session Message List
 *
 * @return void
 */
function sessionMessage(){
    return [
        'orderDeletedMessage' => "Order Deleted Successfully",
        'refundSuccessMessage' => "Refund Successfully",
        'orderFulFilledMessage' => "Order Fulfilled Successfully",
        'addCartSuccessMessage' => "Added Successfully",
        'checkoutSuccessMessage' => "Payment Successfully",
        'createProductSuccesMessage' => "Product created successfully",
        'createUserMessage' => "Create User Successfully",
        'updateProductSuccessMessage' => "Update Products Successfully",
        'deleteProductSuccessMessage' => "Delete Product Successfully",
    ];
}