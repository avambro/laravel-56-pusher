<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

//avambro add ShouldBroadcast
class TaskCreated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */

    private $task;
     
    public function __construct($task)
    {

        $this->task = $task;

        //Important to add dontBroadcastToCurrentUser , because it avoid to send
        //the notification to the same user
        $this->dontBroadcastToCurrentUser();
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        //return new Channel('tasks');
        //to add unique channel for every "model" ID
        \Log::info('- [Tasks]:: '.$this->task['project_id']);
        return new PrivateChannel('tasks.' . $this->task['project_id']);
    }
}
