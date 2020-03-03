<?php

namespace App\Http\Admin\Data;

use Doctrine\ORM\EntityManagerInterface;

interface CrudDataInterface {

    /**
     * @method hydrate(object $post, EntityManagerInterface $em)
     */
    public function getEntity(): object;

    public function getFormClass(): string;
}