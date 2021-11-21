<?php

namespace App\Http\Resources;


use App\Http\Resources\Opportunity;
use App\Http\Resources\Lookups\Country;
use App\Http\Resources\Lookups\Category;
use App\Http\Resources\User;
use Illuminate\Http\Resources\Json\JsonResource;

class Opportunity extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        //laravel default
        // return parent::toArray($request);

        //added by muself
        return [
            'id' => $this->id,
            'title' => $this->title,
            'category' => new Category($this->category),
            'country' => new Country($this->country),
            'deadline' => $this->deadline->toDayDateTimeString(),
            'createdBy' => new User($this->user, 'created_by'),
            'organizer' => $this->organizer,
            'createdAt' => $this->created_at->toDateTimeString(),
            'updatedAt' => $this->updated_at->toDateTimeString(),
        ];
    }
}
