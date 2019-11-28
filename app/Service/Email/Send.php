<?php
declare(strict_types=1);
namespace App\Service\Email;

class Send
{
    protected $email;

    function __construct(string $email)
    {
        $this->isValidEmail($email);
        $this->email = $email;
    }

    public function __toString(): string
    {
        return $this->email;
    }

    public static function fromString(string $email): self
    {
        return new self($email);
    }

    private function isValidEmail(string $email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
            throw new \InvalidArgumentException(
                sprintf(
                    '"%s" 不是一个正确的邮箱',
                    $email
                )
            );
        }
    }
}
