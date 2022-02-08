<?php

class Node {
  private int $data;
  public ?Node $leftChildren;
  public ?Node $rightChildren;

  public function __construct(int $data, ?Node $leftChildren = null, ?Node $rightChildren = null)
  {
    $this->data = $data;
    $this->leftChildren = $leftChildren;
    $this->rightChildren = $rightChildren;
  }

  public function getData()
  {
    return $this->data;
  }
}

class BinarySearchTree {
  // A legelső Node külön tárolásra kerül.
  private ?Node $rootNode;

  public function __construct()
  {
    $this->rootNode = null;
  }

  // Rekurzív keresés a node-ok között. A második paramétert
  // a search() metódus fogja használni, kezdőértékként a rootNode-ot
  // megadva, melyet aztán a rekurzív futások újabb és újabb node-okkal
  // cserél le.
  private function searchFromNode(int $data, ?Node $node): ?Node
  { 
    if ($node === null) return null;

    // Az adott node értékének tárolása. Mivel rekurzív metódus,
    // ezért ez az érték minden meghívásnál változik, és
    // a switch újra és újra lefut.
    $currentNodeData = $node->getData();
    switch (true) {
      // Legelsőként vizsgáljuk azt az eshetőséget, hogy az aktuális node
      // értéke megegyezik a keresettel. Ha igen, megspórolunk két felesleges
      // case futást.
      case $currentNodeData === $data:
        return $node;
        break;
      // Ha a keresett érték nagyobb, mint az éppen vizsgált node,
      // akkor máris tudjuk, hogy az adott node-tól jobbra kell keresnünk,
      // lévén, hogy ez a Binary Search Tree sajátossága: balra az aktuális node-nál
      // kisebb érték kerül tárolásra, jobbra a nagyobb. Ez a rootNode-tól kezdve
      // az összes parent node-ra érvényes.
      case $currentNodeData < $data:
        $node = $this->searchFromNode($data, $node->rightChildren);
        break;
      case $currentNodeData > $data:
        $node = $this->searchFromNode($data, $node->leftChildren);
        break;
    }

    return $node;
  }
  
  // rootNode-tól való keresés.
  public function search(int $data): ?Node
  {
    return $this->searchFromNode($data, $this->getRootNode());
  }

  // Rekurzív elem hozzáadás a meglévő BST-hez. 
  // Az insert() metódus használja, ugyancsak a rootNode-tól kezdve a rekurzív futtatást.
  // Elemről-elemre halad rekurzívan lefelé, felmérve minden elem bal illetve jobb leágazását, annak függvényében
  // hogy a keresett érték miként viszonyul a vizsgált elem értékéhez. (nagyobb e vagy kisebb)
  // A vizsgált elemnél felméri, hogy a kívánt pozició foglalt e már egy Node által vagy sem. Ha nem, a hozzáadás
  // megtörténik, ha igen, akkor a rekurzív futtatás folytatódik, és addig megy végig a Child Node-okon, míg
  // nem talál egy null értéket. 
  private function insertFromNode(int $data, ?Node $node): null | bool
  {
    if ($node === null) return null;

    switch(true) {
      // Ha a vizsgált elemnél nagyobb a keresett érték, akkor
      // a vizsgált elemtől jobbra kezdjük meg a szabad poziciók keresését.
      case $node->getData() < $data:
        // Ha elem értéke null, abban az esetben hozzáadhatjuk az új Node-ot a kívánt
        // értékkel.
        if ($node->rightChildren === null) {
          $node->rightChildren = new Node($data);
        } else {
          // Ha a vizsgált pozición már szerepel egy Node, akkor újra meghívjuk a rekurzív metódust,
          // ebben az esetben már a vizsgált elemtől kezdve a keresést eggyel lejjebb.
          $this->insertFromNode($data, $node->rightChildren);
        }
        break;
      
      // Ha a vizsgált elemnél kisebb a keresett érték, akkor a vizsgált elemtől
      // balra kezdjük meg a szabad poziciók (null) keresését.
      case $node->getData() > $data:
        if ($node->leftChildren === null) {
          $node->leftChildren = new Node($data);
        } else {
          $this->insertFromNode($data, $node->leftChildren);
        }
        break;
    }
    
    return true;
  }

  // rootNode-tól való vizsgálás, és hozzáadás.
  public function insert(int $data): null | bool
  {
    return $this->insertFromNode($data, $this->getRootNode());
  }

  // WIP
  // Rekurzív elem törlése a meglévő BST-ből.
  public function remove()
  {}

  // WIP
  // Az elemek bejárása az alábbi sorrend szerint:
  // leftTree --> rootNode --> rightTree
  public function traverseInOrder()
  {}

  // WIP
  // Az elemek bejárása az alábbi sorrend szerint:
  // rootNode --> leftTree --> rightTree
  public function traversePreOrder()
  {}

  // WIP
  // Az elemek bejárása az alábbi sorrend szerint: 
  // leftTree --> rightTree --> rootNode
  public function traversePostOrder()
  {}

  public function getRootNode(): ?Node
  {
    return $this->rootNode;
  }

  public function setRootNode(?Node $node)
  {
    $this->rootNode = $node;
  }
}