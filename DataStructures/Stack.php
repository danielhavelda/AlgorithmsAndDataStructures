<?php

class Stack {
  private array $stack;
  private int $limit;

  public function __construct(array $initialContent, int $limit)
  {
    $this->stack = $initialContent;
    $this->limit = $limit < count($initialContent) 
      ? throw new RuntimeException("Stack overflow. A Stack elérte limitjét. Maximális elemek száma: ".(string)$limit) 
      : $limit;
  }

  public function push($stackItem)
  {
    // Stack overflow csekkolása
    if (count($this->stack) < $this->limit) {
      array_unshift($this->stack, $stackItem);
    } else {
      throw new RuntimeException("Stack overflow. A Stack elérte limitjét. Maximális elemek száma: ".(string)$this->getLimit());      
    }
  }

  public function pop()
  {
    // Stack underflow csekkolása
    if (!empty($this->stack)) {
      array_shift($this->stack);
    } else {
      throw new RuntimeException("Stack underflow. A Stack nem tartalmaz egy elemet sem.");
    }
  }

  public function peek()
  {
    $lastElement = count($this->stack) < 1 
      ? throw new RuntimeException("Stack underflow. A Stack nem tartalmaz egy elemet sem.") 
      : $this->stack[count($this->stack) - 1];

    echo $lastElement;
  }

  public function print(): void
  {
    $arrayLength = count($this->stack) - 1;
    for ($i = $arrayLength; $i >= 0; $i--) {
      echo $this->stack[$i] ."\r\n";
    }
  }

  public function getLimit(): int
  {
    return $this->limit;
  }
}