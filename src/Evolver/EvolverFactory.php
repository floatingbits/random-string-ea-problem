<?php

namespace FloatingBits\RandomStringEaProblem\Evolver;

use FloatingBits\EvolutionaryAlgorithm\Evaluation\EvaluatorInterface;
use FloatingBits\EvolutionaryAlgorithm\Evaluation\MaxArrayEvaluator;
use FloatingBits\EvolutionaryAlgorithm\Evaluation\StringCompareEvaluator;
use FloatingBits\EvolutionaryAlgorithm\Evolution\AbstractEvolverFactory;
use FloatingBits\EvolutionaryAlgorithm\Evolution\EvolverInterface;
use FloatingBits\EvolutionaryAlgorithm\Mutation\CollectionMutator;
use FloatingBits\EvolutionaryAlgorithm\Mutation\MutatorInterface;
use FloatingBits\EvolutionaryAlgorithm\Mutation\SimpleSymbolArrayMutator;
use FloatingBits\EvolutionaryAlgorithm\Mutation\SwapSymbolArrayMutator;
use FloatingBits\EvolutionaryAlgorithm\Phenotype\PhenotypeGeneratorInterface;
use FloatingBits\EvolutionaryAlgorithm\Randomizer\BooleanRandomizer;
use FloatingBits\EvolutionaryAlgorithm\Randomizer\IntRandomizer;
use FloatingBits\EvolutionaryAlgorithm\Recombination\CollectionRecombinator;
use FloatingBits\EvolutionaryAlgorithm\Recombination\SymbolArrayCrossoverRecombinator;
use FloatingBits\EvolutionaryAlgorithm\Selection\SelectorInterface;
use FloatingBits\EvolutionaryAlgorithm\Selection\SimpleSelector;
use FloatingBits\EvolutionaryAlgorithm\Specimen\CollectionReplenishInterface;
use FloatingBits\RandomStringEaProblem\Phenotype\PhenotypeGenerator;

class EvolverFactory extends AbstractEvolverFactory
{
    /** @var string */
    private $targetString;

    /**
     * @param string $targetString
     */
    public function __construct(string $targetString) {
        $this->targetString = $targetString;
    }

    protected function createSelector(): SelectorInterface
    {
        return new SimpleSelector(0.3);
    }

    /**
     * @return CollectionReplenishInterface[]
     */
    protected function createReplenishers(): array
    {
        return [ $this->createConservativeMutator(),$this->createCreativeMutator(),$this->createRecombinator()];
        // return [$this->createRecombinator()];
    }

    /**
     * @return CollectionReplenishInterface[]
     */
    protected function createCreativeReplenishers(): array {
        return [$this->createCreativeMutator(), $this->createConservativeMutator()];
    }

    private function createRecombinator(): CollectionReplenishInterface
    {
        return new CollectionRecombinator(
            new SymbolArrayCrossoverRecombinator(4, new IntRandomizer(), new BooleanRandomizer(), false),
            new IntRandomizer(0,0,null,0.5),//Bias towards better rated specimen
            50
        );
    }
    private function createConservativeMutator(): CollectionReplenishInterface
    {
        return new CollectionMutator(
            new SimpleSymbolArrayMutator(new BooleanRandomizer(0.2)),
            new IntRandomizer(0,0,null,0.3),//This Randomizer chooses the mutation origin. Bias to lower numbers means higher rated specimen are more probable
            40
        );
    }
    private function createCreativeMutator(): CollectionReplenishInterface
    {
        return new CollectionMutator(
            new SimpleSymbolArrayMutator(new BooleanRandomizer(0.5)),
            new IntRandomizer(0,0,null,0.1),//This Randomizer chooses the mutation origin. Bias to lower numbers means higher rated specimen are more probable
            5
        );
    }

    protected function createEvaluator(): EvaluatorInterface
    {
        return new StringCompareEvaluator($this->targetString);
    }
    protected function createPhenotypeGenerator(): PhenotypeGeneratorInterface
    {
        return new PhenotypeGenerator();
    }


}