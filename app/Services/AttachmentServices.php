<?php
namespace App\Services;

use App\Models\Attachment;
use Illuminate\Support\Facades\Storage;

class AttachmentServices{
    public function save($request, $product){
        $attachments = $request->file('attachments');
        if(empty($attachments)) return "Image Is Empty";
        Storage::disk('public')->putFile('file',$attachments);

        $attachmentData = attachmentData($request, $product);

        Attachment::create($attachmentData);
    }
}