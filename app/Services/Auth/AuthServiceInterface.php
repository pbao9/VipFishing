<?php

namespace App\Services\Auth;

use Illuminate\Http\Request;

interface AuthServiceInterface
{
    public function updatePassword(Request $request);

}