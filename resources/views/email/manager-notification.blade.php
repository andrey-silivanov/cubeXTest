<h1>Message</h1>
<div>ID {{ $userMessage->id }}</div>
<div>Title {{ $userMessage->title }}</div>
<div>Name {{ $userMessage->users->name }}</div>
<div>Email {{ $userMessage->users->email }}</div>
<div>Date {{ $userMessage->created_at }}</div>
@if($userMessage->hasFile())
    <div>File <a href="{{$userMessage->pathFile}}">Download</a></div>
@endif
<div> {!! $userMessage->body !!}</div>