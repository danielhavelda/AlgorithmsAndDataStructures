<?php
include_once "./AlgorithmsAndDataStructures/SortingAlgorithm.php";
include_once "./AlgorithmsAndDataStructures/SortingAlgorithmInterface.php";

class InsertionSort extends SortingAlgorithm implements SortingAlgorithmInterface
{
  public function __construct(array $input)
  {
    parent::__construct($input);
  }

  public function sort(): array
  {
    $sortableArr = $this->getSortableArray();
    $sortableArrLength = count($sortableArr);

    for ($i = 0; $i < $sortableArrLength; $i++) {
      $currentValue = $sortableArr[$i];
      $prevIndex = $i - 1;

      while ($prevIndex >= 0 && $currentValue < $sortableArr[$prevIndex]) {
        $sortableArr[$prevIndex + 1] = $sortableArr[$prevIndex];
        $sortableArr[$prevIndex] = $currentValue;
        // A csere után csekkoljuk a kisebb elem _előtti_ elemet mindaddig,
        // 1) míg a prevIndex értéke el nem éri a legelső elemét (0), vagy
        // 2) míg az éppen vizsgált elem nem nagyobb, mint az azt előző.
        $prevIndex = $prevIndex - 1;
      }
    }

    $this->setSortedArray($sortableArr);
    return $this->getSortedArray();
  }
}

?>