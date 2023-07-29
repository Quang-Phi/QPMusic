<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Album;
use App\Models\Artist;
use App\Models\Event;
use App\Models\Genre;
use App\Models\Song;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DateTime;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function getEvent(Request $request)
    {
        if ($request->ajax()) {
            $events = Event::get([
                'id',
                'title',
                'start',
                'end'
            ]);
            return response()->json($events);
        }
    }

    public function createEvent(Request $request)
    {
        $data = $request->except('_token');
        $data['user_id'] = Auth::user()->id;
        $event = Event::create($data);
        return response()->json([
            $event
        ]);
    }

    public function updateEvent(Request $request, $id)
    {
        $data = $request->except('_token');
        $end = Carbon::parse($data['end'])->addDays(1)->format('Y-m-d');
        $data['end'] = $end;
        $event = Event::find($id);
        $event->update($data);
        return redirect()->route('admin.index');
    }

    public function deleteEvent($id)
    {
        $event = Event::find($id);
        $event->delete();
        return response()->json([
            'success' => "Delete event successfully."
        ]);
    }

    public function index()
    {
        $songs = Song::all();
        $genres = Genre::all();
        $albums = Album::all();
        $artists = Artist::all();

        $tasks = Task::orderBy('created_at', 'desc')->paginate(8);
        $timeNow = now();
        $tasksWithRelativeTime = [];
        foreach ($tasks as $task) {
            $created_at = Carbon::parse($task->created_at);
            $diff = $created_at->diffForHumans($timeNow);
            $tasksWithRelativeTime[] = [
                'task' => $task,
                'relative_time' => $diff,
            ];
        };

        return view('modules.admin.index', [
            'songs' => $songs,
            'genres' => $genres,
            'albums' => $albums,
            'artists' => $artists,
            'tasks' => $tasks,
            'tasksWithRelativeTime' => $tasksWithRelativeTime,
        ])->with('clearLocalStorage', true);
    }

    public function addTodo(Request $request)
    {
        $user = auth()->user();
        $data = $request->except('_token');
        $data['user_id'] = $user->id;
        $data['created_at'] = new DateTime();
        $task = Task::create($data);
        $timeNow = now();
        $tasksWithRelativeTime = [];
        $created_at = Carbon::parse($data['created_at']);
        $diff = $created_at->diffForHumans($timeNow);
        $tasksWithRelativeTime[] = [
            'task' => $task,
            'relative_time' => $diff,
        ];
        return response()->json([
            'task' => $task,
            'tasksWithRelativeTime' => $tasksWithRelativeTime,
        ]);
    }

    public function deleteTodo(Request $request)
    {
        $task = Task::find($request->id);
        $task->delete();
        return response()->json([
            "success" => true
        ]);
    }

    public function updateTodo(Request $request)
    {
        $task = Task::find($request->id);
        $data = $request->except('_token');
        $data['updated_at'] = new DateTime();
        $task->update($data);
        return response()->json([
            "task" => $task
        ]);
    }

    public function changeStatusTodo($id)
    {
        $task = Task::find($id);
        $task->completed = !$task->completed;
        $task->save();
        return response()->json([
            "task" => $task
        ]);
    }
}
