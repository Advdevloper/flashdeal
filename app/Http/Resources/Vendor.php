<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Vendor extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($data)
    {
        // return $data['data']->id;
        return [
            
             'id' =>$data['data']['id'],
            // 'vendor_firstname' => $this->vendor_firstname,
            // 'vendor_lastname' => $this->vendor_lastname,
            // 'vendor_email' => $this->vendor_email,
            // 'vendor_mobile' => $this->vendor_mobile,
            // 'vendor_country' => $this->vendor_country,
            // 'vendor_status' => $this->vendor_status,
            // 'vendor_userid' => $this->vendor_userid,
            // 'vendordetails_file' => asset('/images/' .$this->image),
            // 'created_at' => $this->created_at->format('m/d/Y'),
            // 'updated_at' => $this->updated_at->format('m/d/Y'),
          ];
    }
}
