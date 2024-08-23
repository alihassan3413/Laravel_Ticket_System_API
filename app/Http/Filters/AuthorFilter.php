<?php

namespace App\Http\Filters;

class AuthorFilter extends QueryFilter
{
    protected $sortable = ['name', 'email', 'createdAt' => 'created_at', 'updatedAt' => 'updated_at'];
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
    public function id($value)
    {
        return $this->builder->whereIn('id', explode(',', $value));
    }

    public function email($value)
    {
        $likeStr = str_replace('*', '%', $value);
        return $this->builder->where('email', 'like', $likeStr);
    }

    public function name($value)
    {
        $likeStr = str_replace('*', '%', $value);
        return $this->builder->where('name', 'like', $likeStr);
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
