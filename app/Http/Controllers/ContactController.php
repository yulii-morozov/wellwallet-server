<?php

namespace App\Http\Controllers;

use App\Services\ContactService;
use Illuminate\Http\JsonResponse;

class ContactController extends Controller
{
    /**
     * @param ContactService $contactService
     */
    public function __construct(
        protected ContactService $contactService)
    {
    }

    /**
     * @return JsonResponse
     */
    public function getAllContacts(): JsonResponse
    {
        $contacts = $this->contactService->getAllContacts();

        return new JsonResponse($contacts,200);
    }
}
