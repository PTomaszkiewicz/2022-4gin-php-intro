# 2022-4gin-php-intro

## Docs

- https://learnxinyminutes.com/docs/php/
- https://learnxinyminutes.com/docs/javascript/
- https://www.w3schools.com/Js/js_intro.asp
- https://getbootstrap.com/

## I. PHP

### Zadanie 1

1. wygeneruj tekst Lorem ipsum (możesz skorzystać ze strony internetowej i ręcznie skopiować wynik do zmiennej) - tekst ma mieć co najmniej 100 słów
1. napisz skrypt php, który pobrany tekst wrzuca do tablicy (array) - każde słowo to ma być kolejny element tablicy
1. wyświetl na ekranie zawartość tablicy


### Zadanie 2

1. wyświetl tylko elementy, która zawierają literę e
1. stwórz funkcję, która: 
    - przyjmuje parametry: tablica oraz wyszukiwany ciąg znaków
    - sortuje elementy zgodnie z porządkiem alfabetycznym
    - zwraca tablicę zawierającą słowa zawierające podany ciąg znaków
1. zmień funkcję tak, aby działała również przy braku podanego ciągu znaków - ma zwrócić wtedy tablicę, oczywiście posortowaną

### Zadanie 3

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

### Zadanie 4

1. Korzystając z kodu napisanego w funkcji renderHTMLTable:
    - utwórz funkcję renderCSV, która renderuje dane do postaci CSV (Comma Separated Values), którą można otworzyć np. w Excelu
    - utwórz funkcję renderMD, która wygeneruje tabelkę w formacie markdown
    
### Zadanie 5

1. Uporządkuj swój kod na zajęcia we wtorek, 27 września - korzystając z dotychczas wydevelopowanego kodu będziemy tworzyć klasę Tablica z odpowiednimi właściwościami i medotami

## II. Javascript

### Zadanie 1

1. Utwórz plik interactiveTable.php
1. Po uruchomieniu w przeglądarce tego pliku ma pojawić się HTML z tabelą, którą generuje napisana przez Was klasa i metoda renderHTML()
1. Podłącz biliotekę Bootstrap i ostyluj tabelę zgodnie z dokumentacją

### Zadanie 2

1. Napisz skrypt JS (Javascipt), który po najechaniu na wiersz zmieni jego kolor, a dodatkowo pogrubi tekst w komórce nad którą aktualnie jest użytkownik
1. Do każdego wiersza dodaj przy użyciu JS dodatkową kolumnę z przyciskiem Kasuj wiersz - po jego naciśnięciu wybrany wiersz jest usuwany

### Zadanie 3

1. Dodaj przycisk Dodaj wiersz, który ma pokazać formularz z tyloma polami, ile aktualnie kolumn na tabela
1. Po wypełnieniu przez użytkownika tych pól treścią i naciśnięciu przycisku Zapisz w tabeli ma pojawić się kolejny wiersz z wprowadzonymi treściami, a formularz dodawania za zostać ukryty
1. Czynność dodawania i usuwania wierszy może być powtórzona dowolną liczbę razy

### Zadanie 4

1. Obok przycisku kasuj dodaj przyciski Wyżej oraz Niżej
1. Po kliknięciu tych przycisków dany wiersz ma być przestawiany o jeden wiersz w górę lub w dół
1. Pierwszy wiersz powinien mieć nieaktywny przycisk Wyżej, ostatni - nieaktywny przycisk niżej

### Zadanie 5

1. wykorzystaj bibliotekę https://animate.style aby dodać animacje podczas:
    - kasowanego rekordu
    - dodawanego rekordu
    - zmiany kolejności rekordu
1. ostyluj aplikację, aby była przyjemna dla oka, dodaj jakiś tytuł, autora, itd.
