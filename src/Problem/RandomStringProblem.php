<?php

namespace FloatingBits\RandomStringEaProblem\Problem;

class RandomStringProblem extends AbstractProblem
{
    private $targetString;

    public function __construct(string $targetString) {
        $this->targetString = $targetString;
    }

    public function getTargetString(): string
    {
        return $this->targetString;
    }


}