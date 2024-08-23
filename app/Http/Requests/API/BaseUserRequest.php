<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;

class BaseUserRequest extends FormRequest
{
    public function mappedAttributes(array $otherAttributes = []) {
        $attributemap = array_merge([
            'data.attributes.name' => 'name',
            'data.attributes.email' => 'email',
            'data.attributes.isManager' => 'is_manager',
            'data.attributes.password' => 'password',
        ],$otherAttributes);

        $attributesToUpdate = [];

        foreach ($attributemap as $key => $attribute) {
            if($this->has($key)) {
                $value = $this->input($key);

                if($attribute == 'password') {
                    $value = bcrypt($value);
                }
                $attributesToUpdate[$attribute] = $value;
            }
        }

        return $attributesToUpdate;
    }
}
