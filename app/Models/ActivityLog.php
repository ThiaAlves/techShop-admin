<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class ActivityLog extends Model
{
    use HasFactory;

    protected $table = "activity_log";

    protected $fillable = [
        'log_name',
        'description',
        'subject_type',
        'subject_id',
        'causer_type',
        'causer_id',
        'properties',
        'event',
        'batch_uuid'
    ];

    public static function readLogs(){
        return ActivityLog::leftjoin('usuario' , 'usuario.id', '=', 'activity_log.causer_id')
        ->orderBy('activity_log.created_at', 'desc')
        ->select('activity_log.id', 'activity_log.log_name', 'activity_log.description', 'activity_log.subject_type', 'activity_log.subject_id',
         'activity_log.causer_type', 'activity_log.properties', 'activity_log.event', 'activity_log.batch_uuid',
         'usuario.nome as usuario_nome', 'activity_log.created_at')
        ->get();
    }


    public static function readLogsByEvent($event){
        return ActivityLog::leftjoin('usuario' , 'usuario.id', '=', 'activity_log.causer_id')
        ->orderBy('activity_log.created_at', 'desc')
        ->select('activity_log.id', 'activity_log.log_name', 'activity_log.description', 'activity_log.subject_type', 'activity_log.subject_id',
         'activity_log.causer_type', 'activity_log.properties', 'activity_log.event', 'activity_log.batch_uuid',
         'usuario.nome as usuario_nome', 'activity_log.created_at')
        ->where('event', $event)
        ->get();
    }

    public static function readLogsByModel($model){
        return ActivityLog::leftjoin('usuario' , 'usuario.id', '=', 'activity_log.causer_id')
        ->orderBy('activity_log.created_at', 'desc')
        ->select('activity_log.id', 'activity_log.log_name', 'activity_log.description', 'activity_log.subject_type', 'activity_log.subject_id',
         'activity_log.causer_type', 'activity_log.properties', 'activity_log.event', 'activity_log.batch_uuid',
         'usuario.nome as usuario_nome', 'activity_log.created_at')
         ->where('subject_type', $model)
        ->get();
    }

    public static function readLogsByModelNull(){
        return ActivityLog::leftjoin('usuario' , 'usuario.id', '=', 'activity_log.causer_id')
        ->orderBy('activity_log.created_at', 'desc')
        ->select('activity_log.id', 'activity_log.log_name', 'activity_log.description', 'activity_log.subject_type', 'activity_log.subject_id',
         'activity_log.causer_type', 'activity_log.properties', 'activity_log.event', 'activity_log.batch_uuid',
         'usuario.nome as usuario_nome', 'activity_log.created_at')
         ->whereNull('subject_type')
        ->get();
    }
    
}
