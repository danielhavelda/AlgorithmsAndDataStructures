<?php

class LinkedNode {
  private int | string $head;
  public ?LinkedNode $next;

  function __construct($head)
  {
    $this->head = $head;
    $this->next = null;
  }

  public function getHead(): string
  {
    return $this->head;
  }
}

class LinkedList {
  public ?LinkedNode $firstNode;
  private int $size;

  public function __construct()
  {
    $this->firstNode = null;
    $this->size = 0;
  }

  public function size(): int
  {
    return $this->size;
  }

  public function getLastNode(): int | string
  {
    // Végigmegyünk az elemeken mindaddig, míg nem találjuk meg azt,
    // melynek a next property-je nincs megadva. (utolsó elem)
    $firstNode = $this->firstNode;
    while ($firstNode->next != null) {
      $firstNode = $firstNode->next;
    }

    return $firstNode->getHead();
  }

  public function insertFirst($head): void
  {
    $node = new LinkedNode($head);
    $node->next = $this->firstNode;
    $this->firstNode = &$node;
    $this->size++;
  }

  public function insert(string | int $head, int $key): void
  {
    // Megvizsgáljuk, hogy az első elem helyére akarunk e beszúrni elemet.
    // Ha igen, az insertFirst metódust hívjuk meg.
    if ($key !== 1) {
      // Megvizsgáljuk, hogy a megadott elem poziciója nagyobb e,
      // mint a lista elemeinek száma. Ha igen, Exceptiont dobunk.
      if ($key <= ($this->size + 1)) {
        $node = new LinkedNode($head);
        $current = $this->firstNode;
        $previous = $this->firstNode;

        for ($i = 1; $i < $key; $i++) {
          $previous = $current;
          $current = $current->next;
        }

        $previous->next = $node;
        $node->next = $current;
        $this->size++;
      } else {
        throw new OutOfBoundsException(
          "A key argumentum értéke nem lehet nagyobb, mint a LinkedList elemeinek száma.
          Az elem számát a size metódussal tudhatja meg."
        );
      }
    } else {
      $this->insertFirst($head);
    }
  }

  public function getList(): array
  {
    $list = [];
    $currentNode = $this->firstNode;
    
    // Egyenként végigmegyünk a lista elemein, és a listában szereplő elemeket 
    // hozzáadjuk egy tömbhöz, melyet aztán visszaadunk.
    while ($currentNode !== null) {
      array_push($list, $currentNode->getHead());
      $currentNode = $currentNode->next;
    }

    return $list;
  }

  public function emptyList(): void
  {
    $this->firstNode = null;
    $this->size = 0;
  }
}