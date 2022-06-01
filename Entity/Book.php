<?php


class Book
{

    private $title;
    private $date;

    /**
     * Book constructor.
     * @param $title
     * @param $date
     */
    public function __construct($title, $date)
    {
        $this->title = $title;
        $this->date = $date;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

}