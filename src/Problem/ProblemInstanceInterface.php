<?php

namespace FloatingBits\RandomStringEaProblem\Problem;

interface ProblemInstanceInterface
{
    /**
     * @return string
     */
    public function getTargetString(): string;
}