<?php

class Book {
    protected $contactsList = [];

//    public function __construct($contactsList) {
//        $this->contactsList =$contactsList;
//    }

    public function getContacts () {
        foreach ($this->contactsList as $contact) {
            echo <<<EOT
            
                Name: {$contact->getContactName()},
                Number: {$contact->getContactNumber()},
                ---------------------------------------- 
            EOT;
        }
    }

    public function addContact(Contact $contact) {
        array_push($this->contactsList, $contact);
    }

    public function deleteContact ($contactId) {

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

$book->addContact($alice);
$book->addContact($andrew);
$book->getContacts();