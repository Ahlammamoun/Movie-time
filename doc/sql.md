# sql

récupérer tous les films

```sql
SELECT * movie
```

récupérer  les acteurs et leur role pour un film donné

```sql
SELECT person.*, casting.* FROM casting
INNER JOIN person ON person.id = casting.person_id
WHERE movie_id = 1
```

récupérer les genres associés à un film

```sql
SELECT genre.*
FROM genre
INNER JOIN movie_genre
ON genre.id = movie_genre.genre_id
WHERE movie.id = 2
```

récupérer les saisons associées à un film ou serie donné

```sql
SELECT season.*
FROM season
INNER JOIN movie
ON movie.id = season.movie_id
WHERE movie.id = 1
```

récupérer tous les reviews associées à un film ou série

```sql
SELECT review.content, user.nickname
FROM review
INNER JOIN movie
ON movie.id = review.movie_id
WHERE movie.id = 1
```

calculer pour chaque film , la moyenne des critiques par film (en une seule requete)

```sql
SELECT AVG(review.rating), review.movie_id FROM review
GROUP BY review.movie_id
```

idem pour un film donné

```sql
SELECT AVG(review.rating), review.movie_id FROM review
WHERE movie.id = 1

SET NAMES utf8mb4;

INSERT INTO `movie` (`id`, `title`, `release_date`, `duration`, `type`, `synopsis`, `summary`, `rating`, `poster`) VALUES
(1,'pêche xxl','1989-07-13',120,'film','il était une fois Cyril choquet passionné de pêche , qui a traverser la planète pour pêcher les poissons les plus mystiques et ancien....','durant une de ses aventure de pêche en 1988 Cyril a rencontré dans les abysses l\'Oxynotus centrina , le plus rare poisson au monde ',9,'https://media.sudouest.fr/5883461/1000x500/poisson-cochon.jpg?v=1631711941'),
(2,'les comptes de la crypte','1989-06-03',150,'Série','Il fait peur , il est mort mais il bouge encore , il nous raconte les histoires les plus horribles possible, dans le sang , la chair et ça le fait rire','un jour une famille tombe dans un ravin et reste bloqué , ils finissent par goûter .......l\'autre ',	10,'https://i.ytimg.com/vi/SOesms3MdP8/hqdefault.jpg'),
(3,'au delà du réel ','0199-10-10',110,'Série','Nous contrôlons tous ce que vous allez voir et entendre, n\'essayez dont pas de changer l\'image','Nous contrôlons les verticales et les horizontales , nous pouvons noyer une image jusqu\'à lui donner la clarté du Crystal',10,'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR0LV800uZ1tk2ZT0_7am72sR2HrmfkZvT2Ew&usqp=CAU');
