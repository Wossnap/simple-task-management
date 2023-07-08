<?php

namespace App\Services;

use App\Models\Task;
use Illuminate\Support\Facades\DB;

class TaskService {
    public function updatePriority(Task $task, Task $prevTask){
        if($task->priority > $prevTask->priority){
            Task::where('priority', '>', $prevTask->priority)
            ->where('id', '<>', $task->id)
            ->where('priority','<',$task->priority)
            ->update(['priority' => DB::raw('priority + 1')]);

            $task->priority = $prevTask->priority+1;
            $task->save();
        }else{
            $ogTaskPriority =  $task->priority;
            $task->priority = $prevTask->priority;
            $task->save();

            Task::where('priority', '<=', $prevTask->priority)
            ->where('id', '<>', $task->id)
            ->where('priority','>',$ogTaskPriority)
            ->update(['priority' => DB::raw('priority - 1')]);
        }
    }
}
