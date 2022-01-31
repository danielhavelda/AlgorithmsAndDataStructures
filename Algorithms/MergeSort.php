<?php
include_once "./AlgorithmsAndDataStructures/Algorithms/SortingAlgorithm.php";

class MergeSort extends SortingAlgorithm {
  public function __construct(array $input)
  {
    parent::__construct($input);
  }

  public function sort(array $input)
  {
    // Base case, melyet elérve a rekurzió véget ér.
    if (count($input) < 2) return $input;

    // Kapott tömb két részre bontása
    $leftHalf = array_slice($input, 0, count($input) / 2);
    $rightHalf = array_slice($input, count($input) / 2);

    // Rekurzív szétbontás
    $leftHalf = $this->sort($leftHalf);
    $rightHalf = $this->sort($rightHalf);
    
    // A szétbontott elemek összerakása
    $mergedArr = $this->merge($leftHalf, $rightHalf);
    
    $this->setSortedArray($mergedArr);
    return $this->getSortedArray($mergedArr);
  }

  public function merge(array $left, array $right)
  {
    $result = [];
    $leftSize = count($left);
    $rightSize = count($right);

    $i = 0; $j = 0; $k = 0;

    // A szétbontott tömböket újra összeilesztjük, miközben összevetjük értékeit, 
    // és aszerint rendezzük őket
    while ($i < $leftSize && $j < $rightSize) {
      if ($left[$i] <= $right[$j]) {
        array_push($result, $left[$i]);
        $i++;
      } else {
        array_push($result, $right[$j]);
        $j++;
      }

      $k++;
    }

    // Clean up, ha a szétbontott két tömb egyikében marad elem (pl. left - 0, right - 1),
    // akkor az is hozzáadásra kerül
    while ($i < $leftSize) {
      $result[$k] = $left[$i];
      $i++;
      $k++;
    }

    while ($j < $rightSize) {
      $result[$k] = $right[$j];
      $j++;
      $k++;
    }

    return $result;
  }
}