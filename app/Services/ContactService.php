<?php

namespace App\Services;

use App\Models\Contact;
use Illuminate\Database\Eloquent\Collection;

class ContactService
{
    /**
     * @return Collection
     */
    public function getAllContacts(): Collection
    {
        return Contact::with('contactable')->get();
    }

    /**
     * @param $id
     * @return Contact
     */
    public function getContactById($id): Contact
    {
        return Contact::with('contactable')->findOrFail($id);
    }
}
