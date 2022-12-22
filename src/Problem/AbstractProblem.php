<?php

namespace FloatingBits\RandomStringEaProblem\Problem;

use FloatingBits\EvolutionaryAlgorithm\Evolution\EvolverFactoryInterface;
use FloatingBits\EvolutionaryAlgorithm\Problem\ProblemInterface;
use FloatingBits\EvolutionaryAlgorithm\Specimen\SpecimenGeneratorInterface;
use FloatingBits\RandomStringEaProblem\Evolver\EvolverFactory;
use FloatingBits\RandomStringEaProblem\Specimen\SpecimenGenerator;

abstract class AbstractProblem implements ProblemInstanceInterface, ProblemInterface
{
    public function getEvolverFactory(): EvolverFactoryInterface
    {
        return new EvolverFactory($this->getTargetString());
    }

    public function getSpecimenGenerator(): SpecimenGeneratorInterface
    {

        return new SpecimenGenerator(strlen($this->getTargetString()));
    }


}