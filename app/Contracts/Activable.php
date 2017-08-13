<?php
namespace App\Contracts;

interface Activable
{
    public function scopeActive($query);

    public function scopeDisabled($query);

    public function activate();

    public function disable();

    public function isActive();
}