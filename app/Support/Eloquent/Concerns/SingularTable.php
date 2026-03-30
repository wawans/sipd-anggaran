<?php

namespace App\Support\Eloquent\Concerns;

use Illuminate\Support\Str;

trait SingularTable
{
    /**
     * Get the table associated with the model.
     */
    public function getTable(): string
    {
        return $this->table ?? Str::snake(class_basename($this));
    }
}
