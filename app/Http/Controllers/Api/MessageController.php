<?php
declare (strict_types = 1);

namespace App\Http\Controllers\Api;

use App\Http\Requests\CreateMessageRequest,
    App\Http\Resources\CountdownResource,
    App\Notifications\ManagerNotification,
    Illuminate\Support\Facades\Auth,
    Illuminate\Http\JsonResponse,
    Illuminate\Database\Eloquent\Model;

use App\Models\{
    Message,
    User
};

/**
 * Class MessageController
 * @package App\Http\Controllers\Api
 */
class MessageController extends ApiController
{
    /**
     * @param CreateMessageRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function send(CreateMessageRequest $request): JsonResponse
    {
        $message = $this->createMessage($request->only('title', 'body', 'timezone'));
        if ($request->has('file') && !empty($request->get('file'))) {
            $message->saveFile($request->get('file'), $request->get('extensionFile'));
        }
       
        $this->notify($message);

        return $this->successResponse(
            $this->transformDataForResponse(new CountdownResource($message)), trans('message.send'));
    }

    /**
     * @param array $data
     * @return $this|\Illuminate\Database\Eloquent\Model
     */
    private function createMessage(array $data): Model
    {
        return Auth::user()->messages()->create([
            'title'    => $data['title'],
            'body'     => $data['body'],
            'timezone' => $data['timezone'] ?? config('app.timezone')
        ]);
    }

    /**
     * Send notification manager
     *
     * @param Message $message
     */
    private function notify(Message $message)
    {
        User::getManagers()->each(function ($manager) use ($message) {
            $manager->notify(new ManagerNotification($message));
        });
    }
}
