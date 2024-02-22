<?php

require("./connection.php");

class Book {
    protected $contactsList = [];

    public function getContacts () {
        foreach ($this->contactsList as $contact) {
            echo <<<EOT
            
                Name: {$contact->getContactName()},
                Number: {$contact->getContactNumber()},
                ---------------------------------------- 
            EOT;
        }
    }

    public function addContact($name, $number) {
        $contact = new Contact($name, $number);
        $sqlAddContact = "INSERT INTO book (name, number)
                          VALUES  ('{$contact->contactName}','{$contact->contactNumber}')";
        mysqli_query($connection, $sqlAddContact);
        $this->message("{$contact->contactName} Written Successfully!");
    }

    public function deleteContact($contactId) {



        $isFounded = false;
        foreach ($this->contactsList as $key => $contact) {
            if ($contact->contactName == $contactId || $contact->contactNumber == $contactId) {
                unset($this->contactsList[$key]);
                $isFounded = true;
                $this->message("{$contact->contactName} Deleted Successfully!");
            }
        }

        if ($isFounded == false) {
            $this->message("Deleting failed... not Found!");
        }
    }

    private function message ($message) {
        echo <<<EOT
                
                   {$message}
                    
                EOT;
    }
}

class Contact {
    public $contactName;
    public $contactNumber;

    public function __construct($contactName, $contactNumber) {
        $this->contactName = $contactName;
        $this->contactNumber = $contactNumber;
    }

    public function setContactName ($newContactName) {
        $this->contactName = $newContactName;
    }

    public function setContactNumber ($newContactNumber) {
        $this->contactNumber = $newContactNumber;
    }

    public function getContactName () {
        return $this->contactName;
    }

    public function getContactNumber () {
        return $this->contactNumber;
    }
}

$alice = new Contact("Alice", "+79183116162");
$andrew = new Contact("Andrew", "+79298305848");
$book = new Book();


$book->addContact("Alice", "+79183116162");
$book->addContact("Andrew", "+79298305848");
$book->addContact("Lilith", "+79283339533");
$book->getContacts();
$book->deleteContact("Alice");
$book->getContacts();
$book->deleteContact("Alicess");