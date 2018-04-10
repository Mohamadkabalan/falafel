<?php
/**
 * Created by PhpStorm.
 * User: mkaba
 * Date: 4/10/2018
 * Time: 2:54 PM
 */

namespace App\Entity;


class library_book
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @ORM\Column(type="integer", length=100)
     */
    private $library_id;
    /**
     * @ORM\Column(type="integer", length=100)
     */
    private $book_id;

    public function getId()
    {
        return $this->id;
    }
    public function getLibrary_id() {
        return $this->library_id;
    }

    public function getBook_id() {
        return $this->book_id;
    }

}