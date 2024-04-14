<?php

namespace App\Asteroide\Support;

use App\Asteroide\Models\Activity;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use Throwable;

class Monitor
{
    protected $activity;

    public function __construct()
    {
        $this->activity = new Activity;
        $this->customModel = null;
    }

    public function audit(callable $fn)
    {
        $this->createLog($fn);

        return $this;
    }

    public function auditAuth($user = null)
    {
        $this->createAuthLog($user);

        return $this;
    }

    public function model($model)
    {
        $this->customModel = $model;

        return $this;
    }

    public function createLog(callable $fn)
    {
        DB::enableQueryLog();

        if (empty($this->customModel)) {
            $this->customModel = call_user_func($fn);
        } else {
            call_user_func($fn);
        }

        $queries = DB::getQueryLog();
        $debug = debug_backtrace();

        [$query, $bindings] = isset($queries[0]) ? [$queries[0]['query'], $queries[0]['bindings']] : ['', []];

        $payload = preg_replace_array('/\\?/', $bindings, $query);

        $action = [
            'url' => Request::fullUrl(),
            'method' => Request::method(),
            'ip' => Request::ip(),
            'agent' => Request::header('user-agent'),
            'action' => "{$debug[2]['class']}::{$debug[2]['function']}",
            'payload' => $payload,
        ];

        if (is_object($this->customModel)) {
            $action['performed_on_model'] = optional($this->customModel)->id;
            $action['performed_on_class'] = get_class($this->customModel);
        }

        DB::disableQueryLog();

        $this->activity->fill($action);
        $this->activity->forceFill(['user_id' => optional(auth('admin')->user() ?? auth('api')->user())->id])->save();

        return $this;
    }

    public function createAuthLog($user)
    {
        $debug = debug_backtrace();

        $action = [
            'url' => Request::fullUrl(),
            'method' => Request::method(),
            'ip' => Request::ip(),
            'agent' => Request::header('user-agent'),
            'action' => "{$debug[2]['class']}::{$debug[2]['function']}",
        ];

        if ($user) {
            $action['performed_on_model'] = optional($user)->id;
            $action['performed_on_class'] = get_class($user);
            $this->activity->forceFill(['user_id' => $user->id]);
        }

        $this->activity->fill($action);

        try {
            $this->activity->save();
        } catch (Throwable $th) {
            //
        }

        return $this;
    }

    public function addDescription($description = null)
    {
        $this->activity->fill(['description' => $description]);

        try {
            $this->activity->save();
        } catch (Throwable $th) {
            //
        }

        return $this;
    }

    public function getLog()
    {
        return $this->activity;
    }
}
