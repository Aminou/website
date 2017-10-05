<?php
namespace App\Traits;

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
        $this->update(['active' => self::$status['active']]);
    }

    public function disable()
    {
        $this->update(['active' => self::$status['disabled']]);
    }

    public function isActive()
    {
        return $this->active === self::$status['active'];
    }

    public function isDisabled()
    {
        return ! $this->isActive();
    }
}