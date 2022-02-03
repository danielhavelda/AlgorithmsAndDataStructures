# Adatszerkezetek

## Linked list (Láncolt lista)
Olyan adatszerkezet, amelyben az egyes elemek láncba vannak fűzve. A láncbafűzés azáltal
valósul meg, hogy minden elem tárolja a soron következő elem címét.

<br />

## Stack (Verem)
Olyan adatszerkezet, amely tetszőleges számú elemet tartalmazhat, de mindig csak a legutoljára hozzáadott eleme érhető el (peek metódus). 
A veremből az elemek a behelyezéssel (push metódus) ellentétes sorrendben emelhetőek ki (pop metódus), ezt pedig LIFO (Last in, First Out) 
módszernek nevezzük. Ebből következik, hogy ha a legelső elemhez akarunk hozzáférni, akkor előtte az összes többi, utólag hozzáadott elemet 
ki kell emelnünk az adatszerkezetből. Implementálható array-ként, és Linked listként egyaránt.

<br />

## Queue (Sor)
Olyan adatszerkezet, amelyben az elemek FIFO (First In, First Out) módon viselkednek, tehát az először hozzáadott elem kerül legelőször
eltávolításra. Akárcsak a Stack, a Queue is implementálható array-ként, illetve Linked listként.