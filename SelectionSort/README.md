# Selection Sort

## Mi ez?
Egy egyszerű rendezési algoritmus, mely két részre osztja a vizsgált
tömböt: rendezettre és még nem rendezettre. A rendezett rész a tömb elején
foglal helyet, és eme résznek az utolsó elemét - első nekifutáskor a 0. indexű elem - 
hasonlítja össze a tömb többi elemével, egy kisebb értéket keresve. Ha talált a tömb
bejárása közben egy kisebb elemet, annak indexét lementi egy változóba. Az ezután talált kisebb
értékeknél a változót felülírja. A lista végighaladása után a mentett indexű elemet felcseréli a vizsgált elemmel.