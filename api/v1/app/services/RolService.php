<?php

class RolService extends Service
{
    public function __construct()
    {
        // $this->authentication();
    }

    public function index($request = null)
    {
        return httpResponse(
            Rol::all()
        )->json();
    }
}
