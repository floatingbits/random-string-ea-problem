<?php

namespace FloatingBits\RandomStringEaProblem\Phenotype;

use FloatingBits\EvolutionaryAlgorithm\Example\AssignJobToMachinesExample\Genotype\Genotype;
use FloatingBits\EvolutionaryAlgorithm\Phenotype\FloatArrayPhenotypeInterface;
use FloatingBits\EvolutionaryAlgorithm\Phenotype\PhenotypeGeneratorInterface;
use FloatingBits\EvolutionaryAlgorithm\Example\AssignJobToMachinesExample\Problem\Job;
use FloatingBits\EvolutionaryAlgorithm\Phenotype\PhenotypeInterface;
use FloatingBits\EvolutionaryAlgorithm\Phenotype\StringPhenotype;
use FloatingBits\EvolutionaryAlgorithm\Phenotype\StringPhenotypeInterface;

/**
 * @implements PhenotypeGeneratorInterface<Genotype, FloatArrayPhenotypeInterface>
 */
class PhenotypeGenerator implements PhenotypeGeneratorInterface
{
    /**
     * @param $genotype
     * @return StringPhenotypeInterface
     */
    public function generatePhenotype($genotype): StringPhenotypeInterface
    {
        return new StringPhenotype($genotype);
    }

}