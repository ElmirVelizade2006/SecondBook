<?php

namespace App\Services;

use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ActivityLogService
{
    public function log(
        string $action,
        string $module,
        string $description,
        ?Request $request = null
    ): ActivityLog {
        $request ??= request();

        return ActivityLog::create([
            'user_id' => Auth::id(),

            'action' => $action,

            'module' => $module,

            'description' => $description,

            'ip_address' => $request->ip(),

            'user_agent' => $request->userAgent(),
        ]);
    }
}


