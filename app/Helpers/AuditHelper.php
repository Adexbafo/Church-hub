<?php

namespace App\Helpers;

use App\Models\AuditLog;
use Illuminate\Database\Eloquent\Model;

class AuditHelper
{
    public static function log(
        string $action,
        string $description,
        ?Model $model = null
    ): void {

        AuditLog::create([
            'user_id' => auth()->id(),
            'action' => $action,
            'description' => $description,
            'model_type' => $model?->getMorphClass(),
            'model_id' => $model?->getKey(),
        ]);
    }
}
