<?php

class SortingAlgorithm {
  private ?array $sortableArray = [];

  public function __construct(array $array)
  {
    $this->sortableArray = $this->setArray($array);
  }

  public function getArray(): array
  {
    return $this->sortableArray;
  }

  public function setArray(array $array): void
  {
    $this->sortableArray = $array;
  }
}