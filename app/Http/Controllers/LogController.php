<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use Illuminate\Http\Request;
use stdClass;

class LogController extends Controller
{
    /**
     * Show the navbar search results.
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request)
    {

        $count_registros = new stdClass;
        $count_registros->total = ActivityLog::count();
        $count_registros->create = ActivityLog::where('event', 'create')->count();
        $count_registros->update = ActivityLog::where('event', 'update')->count();
        $count_registros->destroy = ActivityLog::where('event', 'destroy')->count();

        $filtros = new stdClass;
        $filtros->model = $request->model_name;
        $filtros->event = $request->event;

        $logs = ActivityLog::readLogs();
        if(!empty($request->model_name) && empty($request->event)){

            $model = "App\Models".'\\'.$request->model_name;
            $logs = ActivityLog::readLogsByModel($model);
        }

        if($request->model_name == 'Outros'){
             $logs = ActivityLog::readLogsByModelNull();
        }
        
        if(empty($request->model_name) && !empty($request->event)){
            $logs = ActivityLog::readLogsByEvent($request->event);
        }


        return view('logs.index', compact('count_registros', 'logs', 'filtros'));
    }


}
