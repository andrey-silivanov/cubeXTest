<?php
declare (strict_types = 1);

namespace App\Http\Controllers\Api;

use App\Http\Requests\CreateMessageRequest;
use App\Http\Resources\CountdownResource;
use App\Models\Message;
use App\Models\User;
use App\Notifications\ManagerNotification;

class MessageController extends ApiController
{
    public function send(CreateMessageRequest $request)
    {
        //return $this->getManager();
        $message = $this->createMessage($request->only('title', 'body', 'timezone'));
        if ($request->has('file') && !empty($request->get('file'))) {
            $message->addMediaFromBase64($request->get('file'))->toMediaCollection();
        }
        return $this->notify($message);
      /*  return $this->successResponse(
            $this->transformDataForResponse(new CountdownResource($message)), trans('message.send'));*/
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

    private function getManager()
    {
        return User::whereHas('roles', function($q) {
            return $q->where('name', User::ROLE_MANAGER);
        })->first();
    }

    private function notify(Message $message)
    {
        $manager = $this->getManager();
        $manager->notify(new ManagerNotification($message));
    }
}
