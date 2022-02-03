<?php

class Queue {
  private array $queue;

  private int $limit;

  // Aktuális első elem
  private $first;

  // Aktuális utolsó elem
  private $last;

  private int $size;

  // Üzenet szövege, ami megjelenik, ha a Sor elérte a limitet
  private string $overflowStatusMessage;

  // Üzenet szövege, ami megjelenik, ha a Sor üres
  private string $underflowStatusMessage;

  public function __construct(array $queue, int $limit)
  {
    $this->queue = count($queue) > $limit ? throw new LengthException("A Sor mérete nem lehet nagyobb, mint a megadott limit.") : $queue;
    $this->limit = $limit;

    $this->first = count($queue) === 0 ? null : $queue[0];
    $this->last = count($queue) === 0 ? null : $queue[count($queue) - 1];
    $this->size = count($queue);

    $this->overflowStatusMessage = "A Sor megtelt. További elem nem adható hozzá.";
    $this->underflowStatusMessage = "A Sor üres. További elem nem törölhető.";
  }

  // Hozzáadás a Sor végéhez (enqueue)
  public function add($item): bool
  {
    if ($this->isFull()) {
      echo $this->getOverflowStatusMessage();
      return false;
    } else {
      if ($this->size === 0) {
        $this->first = $item; 
      }
      
      $this->size++;
      $this->last = $item;
      array_push($this->queue, $item);
      return true;
    }
  }

  // Kivétel a Sor elejéről (dequeue)
  public function remove()
  {
    if ($this->isEmpty()) {
      echo $this->getUnderflowStatusMessage();
      return false;
    } else {
      $this->size--;
      $tmp = $this->first;
      array_shift($this->queue);
      
      if ($this->size === 0) {
        $this->first = null;
        $this->last = null;
      } else {
        $this->first = $this->queue[0];
      }
      
      return $tmp;
    }
  }

  public function getLimit(): int
  {
    return $this->limit;
  }

  public function getSize(): int
  {
    return $this->size;
  }

  public function peek()
  {
    return $this->first;
  }

  public function isEmpty(): bool
  {
    return ($this->size === 0);
  }

  public function isFull(): bool
  {
    return ($this->size === $this->limit);
  }

  public function getOverflowStatusMessage(): string
  {
    return $this->overflowStatusMessage;
  }

  public function setOverflowStatusMessage(string $msg): bool
  {
    $this->overflowStatusMessage = $msg;
    return true;
  }

  public function getUnderflowStatusMessage(): string
  {
    return $this->underflowStatusMessage;
  }

  public function setUnderflowStatusMessage(string $msg): bool
  {
    $this->underflowStatusMessage = $msg;
    return true;
  }
}