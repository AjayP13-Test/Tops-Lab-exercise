<?php
class Book {
    public $title;
    public $author;

    public function __construct($title, $author) {
        $this->title = $title;
        $this->author = $author;
    }
}

class Library {
    public $books = [];

    public function addBook(Book $book) {
        $this->books[] = $book;
    }

    public function showBooks() {
        foreach($this->books as $book) {
            echo $book->title . " by " . $book->author . "<br>";
        }
    }
}

$lib = new Library();
$lib->addBook(new Book("PHP Basics", "John Doe"));
$lib->addBook(new Book("OOP in PHP", "Jane Smith"));
$lib->showBooks();
?>
