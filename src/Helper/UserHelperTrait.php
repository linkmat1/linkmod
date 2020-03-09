<?php

namespace App\Helper;


trait UserHelperTrait
{

    public function getCurrentUser()
    {
        return $this->getUser();
    }

    public function getCurrentDate()
    {
        return new \DateTime('now');
    }
}
