<?php
namespace App\Services;

use App\Models\Attachment;
use Illuminate\Support\Facades\Storage;

class AttachmentServices{
    public function attributes($attachments, $products) {
        return [
            'name' => $attachments->hashName(),
            'extension' => $attachments->extension(),
            'mime_type' => $attachments->getMimeType(),
            'size' => $attachments->getSize(),
            'product_id' => $products
        ];
    }
    
    public function save($request, $product){
        $attachments = $request->file('attachments');
        Storage::disk('public')->putFile('file',$attachments);
        $attachmentData = attachmentData($request, $product);
        Attachment::create($attachmentData);
    }
}