<?php

namespace App\Asteroide\Traits;

use Illuminate\Http\Request;

trait Notifications
{
    public $notifications = [
        'store' => [
            'en' => 'Created successfully',
            'es' => 'Se creó correctamente',
        ],
        'update' => [
            'en' => 'Your changes have been saved',
            'es' => 'Se han guardado tu cambios',
        ],
        'destroy' => [
            'en' => 'Deleted successfully',
            'es' => 'Se eliminó correctamente',
        ],
    ];

    public function takeNotification($methodName)
    {
        $this->availableNotifications = collect($this->notifications);

        $translations = $this->availableNotifications->get($methodName);

        if (is_array($translations)) {
            return optional($translations)[app()->getLocale()];
        }

        return $this->availableNotifications->get($methodName);
    }

    public function prepareNotification(Request $request, $message = null)
    {
        $methodName = debug_backtrace(DEBUG_BACKTRACE_PROVIDE_OBJECT, 5)[1]['function'];

        $request->session()->flash('notification', $message ?? $this->takeNotification($methodName));
    }

    public function getApiNotification($message = null)
    {
        $methodName = debug_backtrace(DEBUG_BACKTRACE_PROVIDE_OBJECT, 5)[1]['function'];

        return [
            'notification' => $message ?? $this->takeNotification($methodName),
            'status' => true,
        ];
    }

    public function addNotifications($notifications = [])
    {
        $this->notifications = array_merge($this->notifications, $notifications);
    }
}
