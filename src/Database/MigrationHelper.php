<?php

namespace TobyMaxham\Helper\Database;

use Illuminate\Database\Schema\Blueprint;

class MigrationHelper
{
    const REFERENTIAL_ACTION_CASCADE = 'CASCADE';
    const REFERENTIAL_ACTION_RESTRICT = 'RESTRICT';
    const REFERENTIAL_ACTION_SET_NULL = 'SET NULL';
    const REFERENTIAL_ACTION_NO_ACTION = 'NO ACTION';
    const REFERENTIAL_ACTION_SET_DEFAULT = 'SET DEFAULT';

    public static function uuid(Blueprint $table, string $comment = null)
    {
        $table->char('uuid', 36);
        /** @var \Illuminate\Support\Fluent $fluent */
        $fluent = $table->unique('uuid', 'uuid');
        if (! is_null($comment)) {
            $fluent->comment = $comment;
        }
    }

    public static function addSoftDelete(Blueprint $table)
    {
        $table->softDeletes();
        $table->index(['deleted_at'], 'deleted_at');
    }

    public static function dropSoftDelete(Blueprint $table)
    {
        $table->dropIndex('deleted_at');
        $table->dropSoftDeletes();
    }

    public static function addChangedByUserFields(Blueprint $table, array $fields = ['created_by', 'updated_by', 'deleted_by'], string $relation = 'users', string $foreign = 'id', string $onDelete = self::REFERENTIAL_ACTION_CASCADE)
    {
        if (! isset($fields[0]) || ! is_string($fields[0])) {
            $fields[0] = 'created_by';
        }
        if (! isset($fields[1]) || ! is_string($fields[1])) {
            $fields[1] = 'updated_by';
        }
        if (! isset($fields[2]) || ! is_string($fields[2])) {
            $fields[2] = 'deleted_by';
        }
        self::addCreatedByUser($table, $fields[0], $relation, $foreign, $onDelete);
        self::addUpdatedByUser($table, $fields[1], $relation, $foreign, $onDelete);
        self::addDeletedByUser($table, $fields[2], $relation, $foreign, $onDelete);
    }

    public static function addCreatedByUser(Blueprint $table, string $field = 'created_by', string $relation = 'users', string $foreign = 'id', string $onDelete = self::REFERENTIAL_ACTION_CASCADE)
    {
        self::addChangedByField($table, $field, $relation, $foreign, $onDelete);
    }

    public static function addUpdatedByUser(Blueprint $table, string $field = 'updated_by', string $relation = 'users', string $foreign = 'id', string $onDelete = self::REFERENTIAL_ACTION_CASCADE)
    {
        self::addChangedByField($table, $field, $relation, $foreign, $onDelete);
    }

    public static function addDeletedByUser(Blueprint $table, string $field = 'deleted_by', string $relation = 'users', string $foreign = 'id', string $onDelete = self::REFERENTIAL_ACTION_CASCADE)
    {
        self::addChangedByField($table, $field, $relation, $foreign, $onDelete);
    }

    public static function addChangedByField(Blueprint $table, string $field, string $relation, string $foreign, string $onDelete)
    {
        $table->unsignedInteger($field)->nullable();
        $table->foreign($field)
            ->references($foreign)->on($relation)
            ->onDelete($onDelete);
    }
}
