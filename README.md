# 2022-4gin-php-intro

## Docs

https://learnxinyminutes.com/docs/php/

## Zadanie 1

1. wygeneruj tekst Lorem ipsum (możesz skorzystać ze strony internetowej i ręcznie skopiować wynik do zmiennej) - tekst ma mieć co najmniej 100 słów
1. napisz skrypt php, który pobrany tekst wrzuca do tablicy (array) - każde słowo to ma być kolejny element tablicy
1. wyświetl na ekranie zawartość tablicy


## Zadanie 2

1. wyświetl tylko elementy, która zawierają literę e
1. stwórz funkcję, która: 
    - przyjmuje parametry: tablica oraz wyszukiwany ciąg znaków
    - sortuje elementy zgodnie z porządkiem alfabetycznym
    - zwraca tablicę zawierającą słowa zawierające podany ciąg znaków
1. zmień funkcję tak, aby działała również przy braku podanego ciągu znaków - ma zwrócić wtedy tablicę, oczywiście posortowaną

## Zadanie 3

1. wyświetl tabelę HTML, która ma 4 kolumny i tyle wierszy, ile elementów ma tablica
1. pierwszy wiersz musi być wyrenderowany nagłówkami
    >Format wygenerowanej tabeli (w polach umieszczam indeksy elementów tablicy):
    >
    >| 0 | 1 | 2 | 3 |
    >|---|---|---|----|
    >| 4 | 5 | 6 | 7 |
    >| 8 | 9 | 10 | 11 |
    >| 12 | 13 | itd. |  |
1. stwórz funkcję renderHTMLTable, która:
    - przyjmuje parametry: tablica oraz liczba kolumn
    - zwraca tabelę HTML z elementami

## Zadanie 4

1. Korzystając z kodu napisanego w funkcji renderHTMLTable:
    - utwórz funkcję renderCSV, która renderuje dane do postaci CSV (Comma Separated Values), którą można otworzyć np. w Excelu
    - utwórz funkcję renderMD, która wygeneruje tabelkę w formacie markdown
    
## Zadanie 5

1. Uporządkuj swój kod na zajęcia we wtorek, 27 września - korzystając z dotychczas wydevelopowanego kodu będziemy tworzyć klasę Tablica z odpowiednimi właściwościami i medotami
