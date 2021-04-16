<?php

namespace App\Dice;

class Dice
{
    private $numberOfFaces;
    private $value;
    private $uniqid;
    private $kept = false;

    public function __construct($numberOfFaces)
    {
        $this->numberOfFaces = $numberOfFaces;
        $this->uniqid = uniqid();
    }

    /**
     * @param bool $kept
     */
    public function setKept(bool $kept): void
    {
        $this->kept = $kept;
    }

    /**
     * @return mixed
     */
    public function getKept()
    {
        return $this->kept;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->uniqid;
    }

    public function throw()
    {
        if ($this->kept) {
            return false;
        }

        $this->value = rand(1, $this->numberOfFaces);
    }

    public function getValue()
    {
        return $this->value;
    }

    public function resetValue()
    {
        $this->value = null;
    }
}
