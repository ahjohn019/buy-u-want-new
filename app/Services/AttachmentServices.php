<?php
namespace App\Services;

use App\Models\Attachment;
use Illuminate\Support\Facades\Storage;

class AttachmentServices{
    /**
     * Save the attachment to public folder
     *
     * @param array $request
     * @param array $product
     * @return void
     */
    public function save($request, $product){
        $attachments = $request->file('attachments');
        Storage::disk('public')->putFile('file',$attachments);
        $attachmentData = attachmentData($request, $product);
        Attachment::create($attachmentData);
    }
}