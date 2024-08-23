<?php

namespace App\Http\Filters;

class TicketsFilter extends QueryFilter
{
    protected $sortable = ['title', 'status', 'createdAt' => 'created_at', 'updatedAt' => 'updated_at'];

    public function createdAt($value)
    {
        $data = explode(',', $value);

        if (count($data) > 1) {
            return $this->builder->whereBetween('created_at', $data);
        }

        return $this->builder->where('created_at', $value);
    }
    public function include($value)
    {
        return $this->builder->with($value);
    }
    public function status($value)
    {
        return $this->builder->whereIn('status', explode(',', $value));
    }

    public function title($value)
    {
        $likeStr = str_replace('*', '%', $value);
        return $this->builder->where('title', 'like', $likeStr);
    }

    public function updatedAt($value)
    {
        $data = explode(',', $value);

        if (count($data) > 1) {
            return $this->builder->whereBetween('updated_at', $data);
        }

        return $this->builder->where('updated_at', $value);
    }
}
