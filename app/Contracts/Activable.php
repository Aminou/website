<?php
namespace App\Contracts;

trait Activable
{
    protected static $status = [
        'active' => 1,
        'disabled' => 0
    ];

    public function scopeActive($query)
    {
        return $query->where('active', self::$status['active']);
    }

    public function scopeDisabled($query)
    {
        return $query->where('active', self::$status['disabled']);
    }

    public function activate()
    {
        $this->active = self::$status['active'];

        return $this->save();
    }

    public function disable()
    {
        $this->active = self::$status['disabled'];

        return $this->save();
    }
}