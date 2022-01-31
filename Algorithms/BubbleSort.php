<?php
include_once "./AlgorithmsAndDataStructures/Algorithms/SortingAlgorithm.php";
include_once "./AlgorithmsAndDataStructures/Algorithms/SortingAlgorithmInterface.php";

class BubbleSort extends SortingAlgorithm implements SortingAlgorithmInterface {
  public function __construct(array $input)
  {
    parent::__construct($input);
  }

  public function sort(): array
  {
    $sortableArray = $this->getSortableArray();
    $sortableArrLength = count($sortableArray);
    
    for ($i = 0; $i < $sortableArrLength - 1; $i++) {
      // Az utolsó elem minden ciklus végén a megfelelő pozicióba kerül,
      // ezért minden ciklussal egyre fogy a rendezetlen elemek száma (sortableArrLength - $i - 1) 
      for ($j = 0; $j < ($sortableArrLength - $i) - 1; $j++) {
        if ($sortableArray[$j] > $sortableArray[$j + 1]) {
          $temp = $sortableArray[$j];
          $sortableArray[$j] = $sortableArray[$j + 1];
          $sortableArray[$j + 1] = $temp;
        }
      }
    }

    $this->setSortedArray($sortableArray);
    return $this->getSortedArray();
  }
}