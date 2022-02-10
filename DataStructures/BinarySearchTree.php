<?php

class Node {
  private ?int $data;
  public ?Node $leftChildren;
  public ?Node $rightChildren;

  public function __construct(?int $data)
  {
    $this->data = $data;
    $this->leftChildren = $this->rightChildren = null;
  }

  public function getData()
  {
    return $this->data;
  }

  public function setData(?int $data)
  {
    $this->data = $data;
  }

  public function isLeaf(): bool
  {
    return $this->leftChildren === null && $this->rightChildren === null;
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
    if ($node === null) {
      return null;
    }

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

  // Az adott node-tól indulva végighaladunk annak leftChildren-jein mindaddig, míg el 
  // jutunk a legkisebb Node-ig, melynek már nincs leftChildren-je.
  public function getMinNodeValue(Node $node): Node
  {
    while ($node->leftChildren !== null) {
      $node = $node->leftChildren;
    }

    return $node;
  }

  // Rekurzív elem törlése a meglévő BST-ből
  public function removeRecursively(int $data, Node $node): ?Node
  {
    if ($node === null) {
      return $node;
      // Ha a törlendő érték kisebb, mint a megadott Node értéke, a baloldali fán indulunk el rekurzívan
    } else if ($data < $node->getData()) {
      $node->leftChildren = $this->removeRecursively($data, $node->leftChildren);
      // Ha a törlendő érték nagyobb, mint a megadott Node értéke, a jobboldali fán indulunk el rekurzívan
    } else if ($data > $node->getData()) {
      $node->rightChildren = $this->removeRecursively($data, $node->rightChildren);
    } else {
      // Ha a keresett Node-ot megtaláltuk, akkor kezdődik a vizsgálat, mely alapján
      // az algo eldönti miként törölje az adott Node-ot.
      // A vizsgálatnak három kimenetele lehet, annak függvényében, hogy a talált Node-ra mely állítás igaz:
      
      // 1) Leaf Node (nem rendelkezik se leftChildren-el, se rightChildren-el). Ebben az esetben a node-ot
      // nyugodtan lehet törölni, lévén, nincsenek child Node-jai, melyek elvesznének a törlés következtében.
      if ($node->leftChildren === null && $node->rightChildren === null) {
        $node = null;
      // 2) Egy gyermeke van a Node-nak. Ebben az esetben a meglévő gyermeket illesztjük a törlendő helyére,
      // ezzel nem csak az értékét átemelve, de a további elemekre mutató (leftChildren, rightChildren) "pointereket"
      // is - PHP-ben nincs pointer -, így elkerülve a child Node-ok elvesztését.
      } else if ($node->leftChildren === null) {
        $node = $node->rightChildren;
      } else if ($node->rightChildren === null) {
        $node = $node->leftChildren;
      // 3) Két gyermeke van a Node-nak. Ebben az esetben a vizsgált Node nagyobb gyermekétől(!) indulva megkeressük
      // a legkisebb található értéket - azt, aminek már nincs további leftChildrenje -, és beillesztjük a törlendő elem helyére, 
      // saját subtree-jével együtt.
      // Ezután az átemelt Node-ot töröljük rekurzívan.
      } else {
        $minNode = $this->getMinNodeValue($node->rightChildren);
        $node->setData($minNode->getData());
        $node->rightChildren = $this->removeRecursively($minNode->getData(), $node->rightChildren);
      }

    }

    return $node;
  }

  // rootNode-tól való vizsgálás, és törlés
  public function remove(int $data): Node
  {
    return $this->removeRecursively($data, $this->getRootNode());
  }

  // WIP
  // Az elemek bejárása az alábbi sorrend szerint:
  // leftTree --> rootNode --> rightTree
  public function printInOrder(?Node $node)
  {
    if ($node === null) return;

    $this->printInOrder($node->leftChildren);
    echo $node->getData()."\n\n";
    $this->printInOrder($node->rightChildren);
  }

  // WIP
  // Az elemek bejárása az alábbi sorrend szerint:
  // rootNode --> leftTree --> rightTree
  public function printPreOrder(?Node $node)
  {
    if ($node === null) return;

    echo $node->getData()."\n\n";
    $this->printPreOrder($node->leftChildren);
    $this->printPreOrder($node->rightChildren);
  }

  // WIP
  // Az elemek bejárása az alábbi sorrend szerint: 
  // leftTree --> rightTree --> rootNode
  public function printPostOrder(?Node $node)
  {
    if ($node === null) return;

    $this->printPostOrder($node->leftChildren);
    $this->printPostOrder($node->rightChildren);
    echo $node->getData()."\n\n";
  }

  public function getRootNode(): ?Node
  {
    return $this->rootNode;
  }

  public function setRootNode(?Node $node)
  {
    $this->rootNode = $node;
  }
}