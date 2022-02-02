# Algoritmusok

## Insertion sort (Beszúró rendezés)
Egy egyszerű rendezési algoritmus, mely a rendezést elemről-elemre hajtja végre.
Ebből következően minél nagyobb a tömb mérete, annál kevésbé hatékony.

<br/>

## Bubble sort (Buborékrendezés)
Egy olyan rendezési algoritmus, amely ismételten végigmegy az adott listán, összehasonlítja
a szomszédos elemeket, és felcseréli őket, ha rossz sorrendben vannak. A lista átjárása
annyiszor kezdődik újra, míg a lista rendezett nem lesz. Az ismétlődő bejárások során
a vizsgált elemek száma csökken, mivel a lista végén lévő elemek már az előző
bejárások során rendezve lettek.

<br/>

## Selection Sort (Kiválasztó rendezés)
Egy egyszerű rendezési algoritmus, mely két részre osztja a vizsgált
tömböt: rendezettre és még nem rendezettre. A rendezett rész a tömb elején
foglal helyet, és eme résznek az utolsó elemét - első nekifutáskor a 0. indexű elem - 
hasonlítja össze a tömb többi elemével, egy kisebb értéket keresve. Ha talált a tömb
bejárása közben egy kisebb elemet, annak indexét lementi egy változóba. Az ezután talált kisebb
értékeknél a változót felülírja. A lista végighaladása után a mentett indexű elemet felcseréli a vizsgált elemmel.

<br />

## Merge Sort (Összefésülő rendezés)
Egy rendezési algoritmus, ami a "Divide and Conquer" - oszd meg és uralkodj - paradigmára épül. A paradigma
az alábbi szerint jellemzi az algoritmus működését: az adott problémát rekurzívan bontsuk kisebb szeletekre - ezesetben
a tömböt magát - addig, amíg elég egyszerűvé nem válik a megoldása - azaz az összehasonlítása a többi elemmel. 
A kapott rész-megoldásokat végül kombináljuk.