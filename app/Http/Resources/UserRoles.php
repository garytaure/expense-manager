<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserRoles extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'         => $this->id,
            'name'       => $this->name,
            'role_create' => $this->role_create,
            'role_read' => $this->role_read,
            'role_update' => $this->role_update,
            'role_delete' => $this->role_delete,
            'user_create' => $this->user_create,
            'user_read' => $this->user_read,
            'user_update' => $this->user_update,
            'user_delete' => $this->user_delete,
            'expense_category_create' => $this->expense_category_create,
            'expense_category_read' => $this->expense_category_read,
            'expense_category_update' => $this->expense_category_update,
            'expense_category_delete' => $this->expense_category_delete,
            'expense_create' => $this->expense_create,
            'expense_read' => $this->expense_read,
            'expense_update' => $this->expense_update,
            'expense_delete' => $this->expense_delete,
        ];
    }
}