<?php

namespace App\DataLayer;

class Customer
{
    public $email;

    public $createdAt;

    public function __construct($email, $createdAt)
    {
        $this->email = $email;
        $this->createdAt = $createdAt;
    }
}

class Order
{
    public $customerEmail;

    public $createdAt;

    public function __construct($customerEmail, $createdAt)
    {
        $this->customerEmail = $customerEmail;
        $this->createdAt = $createdAt;
    }


}

class DataLayer
{
	public static function ListCustomers()
    {
        return [
            (new Customer('mail1@mail.com', (new \DateTime())->modify('-7 hour'))),
            (new Customer('mail2@mail.com', (new \DateTime())->modify('-1 day'))),
            (new Customer('mail3@mail.com', (new \DateTime())->modify('-6 month'))),
            (new Customer('mail4@mail.com', (new \DateTime())->modify('-1 month'))),
            (new Customer('mail5@mail.com', (new \DateTime())->modify('-2 hour'))),
            (new Customer('mail6@mail.com', (new \DateTime())->modify('-5 day'))),
        ];
    }

    public static function ListOrders()
    {
        return [
            (new Order('mail3@mail.com', (new \DateTime())->modify('-6 month'))),
            (new Order('mail5@mail.com', (new \DateTime())->modify('-2 month'))),
            (new Order('mail6@mail.com', (new \DateTime())->modify('-2 day'))),
        ];
    }
}