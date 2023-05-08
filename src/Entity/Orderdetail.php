<?php

namespace App\Entity;

use App\Repository\OrderdetailRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OrderdetailRepository::class)
 */
class Orderdetail
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Order::class, inversedBy="orderdetails")
     */
    private $orderid;

    /**
     * @ORM\ManyToOne(targetEntity=Book::class, inversedBy="orderdetails")
     */
    private $bookid;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOrderid(): ?Order
    {
        return $this->orderid;
    }

    public function setOrderid(?Order $orderid): self
    {
        $this->orderid = $orderid;

        return $this;
    }

    public function getBookid(): ?Book
    {
        return $this->bookid;
    }

    public function setBookid(?Book $bookid): self
    {
        $this->bookid = $bookid;

        return $this;
    }
}
