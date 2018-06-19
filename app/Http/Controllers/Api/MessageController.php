<?php
declare (strict_types = 1);

namespace App\Http\Controllers\Api;

use App\Http\Resources\CountdownResource;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends ApiController
{
    public function send(Request $request)
    {
        $message =  $this->createMessage($request->only('title', 'body'));
        if ($request->has('file') && !empty($request->get('file'))) {
            $message->addMediaFromBase64($request->get('file'))->toMediaCollection();
        }
        /*todo TIMEZONE
           todo validation
        todo added lang file
        */
        return $this->successResponse(
            $this->transformDataForResponse(new CountdownResource($message)), trans('message.create'));
    }

    /**
     * @param array $data
     * @return $this|\Illuminate\Database\Eloquent\Model
     */
    private function createMessage(array $data)
    {
        return Message::create([
            'title' => $data['title'],
            'body' => $data['body']
        ]);
    }
}
