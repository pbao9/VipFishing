<?php

namespace App\Admin\Traits;

use Illuminate\Support\Str;

trait Setup
{
    public function uniqidReal($lenght = 13)
    {
        // uniqid gives 13 chars, but you could adjust it to your needs.
        return uniqid_real($lenght);
    }

    public function uniqidBooking($lenght = 5)
    {
        // uniqid gives 13 chars, but you could adjust it to your needs.
        return uniqid_real($lenght);
    }

    public function uniqidEvent($lenght = 5)
    {
        // uniqid gives 13 chars, but you could adjust it to your needs.
        return uniqid_real($lenght);
    }

    public function createCodeUser()
    {
        return 'U' . $this->uniqidReal(5) . time();
    }
    public function createCodeBooking()
    {
        return 'CAUCA' . $this->uniqidBooking(5);
    }

    public function createCodeEvent()
    {
        return 'EV' . $this->uniqidEvent(5);
    }


    public function folderUploadFileForUser($path = '/')
    {
        $path = $path == '/' ? '/' : '/' . Str::finish($path, '/');

        return 'users/' . auth()->user()->id . $path;
    }

    public function generateTokenGetPassword()
    {
        return (string) Str::uuid() . '-' . time();
    }
}
