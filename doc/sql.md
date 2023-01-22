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
