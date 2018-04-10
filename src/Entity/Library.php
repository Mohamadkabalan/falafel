<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LibraryRepository")
 */
class Library
{

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $ID;
    /**
     * @ORM\Column(type="text", length=100)
     */
    private $Name;
    /**
     * @ORM\Column(type="text", length=100)
     */
    private $Address;
    /**
     * @ORM\Column(type="text", length=100)
     */
    private $Image;

    // Getters & Setters
    public function getID()
    {
        return $this->ID;
    }
    public function getName() {
        return $this->Name;
    }
    public function setName($Name) {
        $this->Name = $Name;
    }
    public function getAddress() {
        return $this->Address;
    }
    public function setAddress($Address) {
        $this->Address = $Address;
    }
    public function getImage() {
        return $this->Image;
    }
    public function setImage($Image) {
        $this->Image = $Image;
    }
}
