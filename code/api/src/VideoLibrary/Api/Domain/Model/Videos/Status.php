<?php
declare(strict_types=1);


namespace VideoLibrary\Api\Domain\Model\Videos;


final class Status
{

    private string $value;

    const ALOWED_VALUES = [
        'pending',
        'published',
        'remove'
    ];

    public function __construct(string $value)
    {
        if(!in_array($value,self::ALOWED_VALUES)){
            throw  new InvalidStatusValueException();
        }
        $this->value = $value;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function equals(Status $status){
        return $this->getValue() === $status->getValue();
    }

}