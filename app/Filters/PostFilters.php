<?php
namespace App\Filters;

use App\User;

class PostFilters extends Filters
{

    public function author($name)
    {
        if (strpos($name, ' ') !== false) {

            [$firstname, $lastname] = explode(' ', $name);
            
            $user = User::where('firstname', $firstname)->orWhere('lastname', $firstname)
                        ->where('lastname', $lastname)->orWhere('firstname', $lastname)
                        ->get();

            return $this->builder->whereIn('user_id', $user->map->id);
        }

        $user = User::where('firstname', $name)
                        ->orWhere('lastname', $name)
                        ->get();

        return $this->builder->whereIn('user_id', $user->map->id);
    }

    public function by($user_id)
    {
        return $this->builder->where('user_id', $user_id);
    }

    public function year($year)
    {
        return $this->builder->whereYear('published_at', $year);
    }

    public function month($month)
    {
        return $this->builder->whereYear('published_at', date('Y'))->whereMonth('published_at', $month);
    }

}