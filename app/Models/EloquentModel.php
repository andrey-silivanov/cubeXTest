<?php
declare(strict_types = 1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class EloquentModel
 * @package App\Models
 */
abstract class EloquentModel extends Model
{
    /**
     * @return string
     */
    public static function getTableName(): string
    {
        return with(new static)->getTable();
    }
}
