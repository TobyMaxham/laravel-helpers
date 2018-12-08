<?php

namespace TobyMaxham\Helper\Models\Logs;

use App;
use Auth;

trait ChangeByUser
{
    /**
     * automatically boot laravel model traits...
     */
    public static function bootChangeByUser()
    {
        static::creating(function ($model) {
            if (App::runningInConsole() || ! Auth::check()) {
                return true;
            }
            if ($model->getCreatedByColumn()) {
                $model->{$model->getUpdatedByColumn()} = Auth::user()->getKey();
            }
            if ($model->getUpdatedByColumn()) {
                $model->{$model->getUpdatedByColumn()} = Auth::user()->getKey();
            }

            return true;
        });

        static::updating(function ($model) {
            if (App::runningInConsole() || ! Auth::check()) {
                return true;
            }
            if ($model->getUpdatedByColumn()) {
                $model->{$model->getUpdatedByColumn()} = Auth::user()->getKey();
            }

            return true;
        });

        static::deleting(function ($model) {
            if (App::runningInConsole() || ! Auth::check()) {
                return true;
            }
            if ($model->getDeletedByColumn()) {
                $model->{$model->getDeletedByColumn()} = Auth::user()->getKey();
            }

            return true;
        });
    }

    public function getCreatedByColumn(): string
    {
        return 'created_by';
    }

    public function getUpdatedByColumn(): string
    {
        return 'updated_by';
    }

    public function getDeletedByColumn(): string
    {
        return 'deleted_by';
    }
}
