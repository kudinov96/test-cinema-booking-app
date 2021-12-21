<?php

namespace App\Domain\Booking\Command;

use Symfony\Component\Validator\Constraints as Assert;

class ToBookingCommand
{
    /**
     * @Assert\NotBlank
     */
    private string $name;

    /**
     * @Assert\NotBlank
     */
    private string $phone_number;

    /**
     * @Assert\NotBlank
     */
    private string $session_id;

    public function __construct(string $name, string $phone_number, string $session_id) {
        $this->name = $name;
        $this->phone_number = $phone_number;
        $this->session_id = $session_id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPhoneNumber(): string
    {
        return $this->phone_number;
    }

    public function getSessionId(): string
    {
        return $this->session_id;
    }
}