<?php
declare (strict_types = 1);

namespace App\Http\Controllers\Api;

use App\Http\Requests\CreateMessageRequest;
use App\Http\Resources\CountdownResource;
use App\Models\Message;

class MessageController extends ApiController
{
    public function send(CreateMessageRequest $request)
    {
        $message = $this->createMessage($request->only('title', 'body', 'timezone'));
        if ($request->has('file') && !empty($request->get('file'))) {
            $message->addMediaFromBase64($request->get('file'))->toMediaCollection();
        }
        
        return $this->successResponse(
            $this->transformDataForResponse(new CountdownResource($message)), trans('message.send'));
    }

    /**
     * @param array $data
     * @return $this|\Illuminate\Database\Eloquent\Model
     */
    private function createMessage(array $data)
    {
        return Message::create([
            'title'    => $data['title'],
            'body'     => $data['body'],
            'timezone' => $data['timezone']
        ]);
    }
}
