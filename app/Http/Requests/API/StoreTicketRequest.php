<?php

namespace App\Http\Requests\API;

use App\Permissions\Abilities;

class StoreTicketRequest extends BaseTicketRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $authorId = $this->routeIs('tickets.store') ? 'data.relationships.author.data.id' : 'author';
        $rules = [
            'data.attributes.title' => 'required|string',
            'data.attributes.description' => 'required|string',
            'data.attributes.status' => 'required|string|in:A,C,H,X',
            $authorId => 'required|integer|exists:users,id',
        ];

        $user = $this->user();

        if ($user->tokenCan(Abilities::CreateOwnTicket)) {
            $rules[$authorId] .= '|size:' . $user->id;
        }

        return $rules;
    }

    protected function prepareForValidation()
    {
        if($this->routeIs('auhtors.tickets.store'))
        {
            $this->merge([
                'author' => $this->route('author'),
            ]);
        }
    }
}
