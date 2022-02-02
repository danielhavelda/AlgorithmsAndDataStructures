# Adatszerkezetek

## Linked list (Láncolt lista)
Olyan adatszerkezet, amelyben az egyes elemek láncba vannak fűzve. A láncbafűzés azáltal
valósul meg, hogy minden elem tárolja a soron következő elem címét.

<br />

## Stack (Verem)
Olyan adatszerkezet, amely tetszőleges számú elemet tartalmazhat, de mindig csak a legutoljára hozzáadott eleme érhető el (peek metódus). 
A veremből az elemek a behelyezéssel (push metódus) ellentétes sorrendben emelhetőek ki (pop metódus). Ebből következik, hogy
ha a legelső elemhez akarunk hozzáférni, mely hozzáadásra került, akkor előtte az összes többi, utólag hozzáadott elemet ki kell
emelnünk az adatszerkezetből.