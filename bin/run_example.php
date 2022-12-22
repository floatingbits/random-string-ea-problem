<?php

require_once '../vendor/autoload.php';
$problem = new \FloatingBits\RandomStringEaProblem\Problem\RandomStringProblem('Hello World Ive been waiting so long');
$factory = $problem->getEvolverFactory();
$evolver = $factory->createEvolver();
$specimenGenerator = $problem->getSpecimenGenerator();
$tournament = new \FloatingBits\EvolutionaryAlgorithm\Evolution\DefaultTournament();
$tournament->setEvolver($evolver);
$tournament->setCleanupAfterNRounds(49);
$tournament->setNumRounds(100);
$tournament->setSpecimenCollection($specimenGenerator->generateSpecimen(50));
$currentPopulation = $tournament->getSpecimenCollection();
printPopulation($currentPopulation);

for ($i = 0; $i < 200; $i++) {
    print('Running 100 rounds' . "\n");
    $tournament->runTournament();
    $currentPopulation = $tournament->getSpecimenCollection();
    printPopulation($currentPopulation, 5);
}

function printPopulation(\FloatingBits\EvolutionaryAlgorithm\Specimen\SpecimenCollection $population, $max = 0) {
    $population->sortByFitness();
    /** @var \FloatingBits\EvolutionaryAlgorithm\Specimen\SpecimenInterface $specimen */
    foreach ($population as $key => $specimen) {
        if ($max && $key >= $max) {
            break;
        }
        /** @var \FloatingBits\RandomStringEaProblem\Genotype\Genotype $genotype */
        $genotype = $specimen->getGenotype();
        print("Specimen " . $key . ": Evaluation " . $specimen->getEvaluation()->getMainFitness());
        print("\n");
        for ($i = 0; $i < $genotype->getSymbolLength(); $i++) {
            $symbol = $genotype->getSymbolAt($i);
            print($symbol->getValue() . ' ');
        }
        print("\n");

    }
    print("\n");
}
