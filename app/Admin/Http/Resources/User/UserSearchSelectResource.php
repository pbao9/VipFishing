<?php

namespace App\Admin\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;

class UserSearchSelectResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // dd($this->bank);
        return [
            'id' => $this->id,
            'text' => "{$this->fullname} ({$this->phone}) - Số dư: " . number_format($this->balance->total_balance, 0, ',', '.') . ' VNĐ',
            'fullname' => $this->fullname,
            'phone' => $this->phone,
            'balance' => number_format($this->balance->total_balance, 0, ',', '.') . ' VNĐ',
            'bank_name' => $this->bank ? $this->bank->name : 'N/A',
            'bank_number' => $this->bank_number,
        ];
    }
}