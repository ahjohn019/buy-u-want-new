<?php
namespace App\Services;

use App\Models\Attachment;
use App\Services\AttachmentServices;
use Illuminate\Support\Facades\Storage;

class AttachmentServices
{
    private function initialize($request) {
        try{
            $attachments = $request->file('attachments');
            Storage::disk('public')->putFile('file',$attachments);
            return AttachmentServices::attributes($request);
        } catch(\Throwable $th) {
            dd($th);
        }
    }

    private function attributes($request){
        $attachments = $request->file('attachments');
        return [
            'name' => $attachments->hashName(),
            'extension' => $attachments->extension(),
            'mime_type' => $attachments->getMimeType(),
            'size' => $attachments->getSize(),
            'product_id' => $request->id
        ];
    }

    public function save($request){
        try{
            $attachmentData = AttachmentServices::initialize($request);
            Attachment::create($attachmentData);
        } catch(\Throwable $th){
            dd($th);
        }
    }

    public function update($request, $selected){
        try{
            $attachmentData = AttachmentServices::initialize($request);
            $selected->update($attachmentData);
        } catch(\Throwable $th){
            dd($th);
        }
    }
}