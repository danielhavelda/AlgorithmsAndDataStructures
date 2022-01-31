<?php
include_once "./AlgorithmsAndDataStructures/Algorithms/SortingAlgorithm.php";
include_once "./AlgorithmsAndDataStructures/Algorithms/SortingAlgorithmInterface.php";

class SelectionSort extends SortingAlgorithm implements SortingAlgorithmInterface {
  public function __construct(array $input)
  {
    parent::__construct($input);
  }

  public function sort(): array
  {
    $sortableArray = $this->getSortableArray();
    $sortableArrayLength = count($sortableArray);

    for ($i = 0; $i < $sortableArrayLength; $i++) {
      $lesserValueIndex = $i;

      // A tömb értékein végigmenve csekkoljuk, hogy találunk e kisebb értéket
      // az éppen vizsgált elemnél (index 0, 1, 2, etc)
      // Ha találunk, a kisebb érték indexét lementjünk későbbi használatra.
      for ($j = $i + 1; $j < $sortableArrayLength; $j++) {
        if ($sortableArray[$j] < $sortableArray[$lesserValueIndex]) {
          $lesserValueIndex = $j;
        }
      }

      // Ha találtunk kisebb értéket a vizsgált elemnél, akkor a kisebb
      // értéket a vizsgált elemmel kicseréljük, így a tömb elejére rakva
      // a kisebb értéket.
      if ($sortableArray[$i] > $sortableArray[$lesserValueIndex]) {
        $temp = $sortableArray[$i];
        $sortableArray[$i] = $sortableArray[$lesserValueIndex];
        $sortableArray[$lesserValueIndex] = $temp;
      }
    }

    $this->setSortedArray($sortableArray);
    return $this->getSortedArray();
  }
}