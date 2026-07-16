<?php

namespace App\Helpers;

use App\Models\AuditLog;

class AuditHelper
{
    public static function log(
        string $action,
        string $description,
        $model = null
    ): void {
        AuditLog::create([
            'user_id' => auth()->id(),
            'action' => $action,
            'description' => $description,
            'model_type' => $model
                ? get_class($model)
                : null,
            'model_id' => $model
                ? $model->id
                : null,
        ]);
    }
}
