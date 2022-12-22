<?php

namespace FloatingBits\RandomStringEaProblem\Specimen;


use FloatingBits\EvolutionaryAlgorithm\Genotype\Symbol\IntSymbolFactory;
use FloatingBits\EvolutionaryAlgorithm\Genotype\Symbol\StringSymbolFactory;
use FloatingBits\EvolutionaryAlgorithm\Randomizer\IntRandomizer;
use FloatingBits\EvolutionaryAlgorithm\Randomizer\StringRandomizer;
use FloatingBits\EvolutionaryAlgorithm\Specimen\Specimen;
use FloatingBits\EvolutionaryAlgorithm\Specimen\SpecimenCollection;
use FloatingBits\EvolutionaryAlgorithm\Specimen\SpecimenGeneratorInterface;
use FloatingBits\RandomStringEaProblem\Genotype\Genotype;

class SpecimenGenerator implements SpecimenGeneratorInterface
{
    /** @var int */
    private $length;

    /**
     * @param int $numJobs
     * @param int $numMachines
     */
    public function __construct(int $length)
    {
        $this->length = $length;
    }
    public function generateSpecimen(int $populationSize): SpecimenCollection
    {
        $collection = new SpecimenCollection();
        while($populationSize--) {
            $specimen = new Specimen();
            $symbolFactory = new StringSymbolFactory(new StringRandomizer());
            $genotype = new Genotype($symbolFactory);
            $genotype->initialize($this->length);
            $specimen->setGenotype($genotype);
            $collection->addSpecimen($specimen);
        }
        return $collection;
    }


}