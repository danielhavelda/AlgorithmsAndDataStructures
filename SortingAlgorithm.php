<?php

class SortingAlgorithm {
  private ?array $sortableArray;
  private ?array $sortedArray;

  public function __construct(array $array)
  {
    $this->sortableArray = $this->setSortableArray($array);
  }

  public function getSortableArray(): array
  {
    return $this->sortableArray;
  }

  public function setSortableArray(array $array): array
  {
    $this->sortableArray = $array;
    return $this->sortableArray;
  }

  public function getSortedArray(): array
  {
    return $this->sortedArray;
  }

  public function setSortedArray(array $array): void
  {
    $this->sortedArray = $array;
  } 
}