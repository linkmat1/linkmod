<?php

namespace App\Search;

class ContentSearch
{
    private $title;

    private $online;

    /**
     * @param mixed $title
     *
     * @return ContentSearch
     */
    public function setTitle($title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $online
     *
     * @return ContentSearch
     */
    public function setOnline($online): self
    {
        $this->online = $online;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getOnline()
    {
        return $this->online;
    }
}
