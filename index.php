<?php

require("connection.php");

class Book
{
    protected $connection;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    public function getContacts()
    {
        $sqlSelectContact = "SELECT name, number FROM book";
        $contactsList = mysqli_query($this->connection, $sqlSelectContact);

        while ($contact = mysqli_fetch_assoc($contactsList)) {
            echo <<<EOT
            
                Name: {$contact["name"]},
                Number: {$contact["number"]},
                ---------------------------------------- 
            EOT;
        }

    }

    public function addContact($name, $number)
    {
        $contact = new Contact($name, $number);

        //Проверка на существование контакта в записной книжке

        if (!$this->isContactExist($contact->contactName, $contact->contactNumber)) {
            $sqlAddContact = "INSERT INTO book (name, number)
                          VALUES  ('{$contact->contactName}','{$contact->contactNumber}')";
            mysqli_query($this->connection, $sqlAddContact);
            $this->message("{$contact->contactName} Written Successfully!");
        } else {

            $this->message("Contact already in book!");
        }

    }

    public function deleteContact($contactId)
    {

        //Проверка на существование контакта в записной книжке

        $sqlSelectContact = "SELECT * FROM book WHERE name = '$contactId' or number = '$contactId'";
        $isContactExist = mysqli_query($this->connection, $sqlSelectContact);

        //Если контакт существует, он будет удален
        if ($this->isContactExist($contactId, $contactId)) {
            $sqlDeleteContact = "DELETE FROM book WHERE name = '$contactId' or number = '$contactId'";
            mysqli_query($this->connection, $sqlDeleteContact);
            $this->message("Deleted Successfully");
        } else {
            $this->message("Failed to delete. Contact not found");
        }
    }

    private function message($message)
    {
        echo <<<EOT
                
                   {$message}
                    
                EOT;
    }

    private function isContactExist($name, $number)
    {
        $sqlSelectContact = "SELECT * FROM book WHERE name = '$name' or number = '$number'";
        $isContactExist = mysqli_query($this->connection, $sqlSelectContact);
        if (mysqli_num_rows($isContactExist) > 0) {
            return true;
        } else {
            return false;
        }
    }
}

class Contact
{
    public $contactName;
    public $contactNumber;

    public function __construct($contactName, $contactNumber)
    {
        $this->contactName = $contactName;
        $this->contactNumber = $contactNumber;
    }

    public function setContactName($newContactName)
    {
        $this->contactName = $newContactName;
    }

    public function setContactNumber($newContactNumber)
    {
        $this->contactNumber = $newContactNumber;
    }

    public function getContactName()
    {
        return $this->contactName;
    }

    public function getContactNumber()
    {
        return $this->contactNumber;
    }
}

$alice = new Contact("Alice", "+79183116162");
$andrew = new Contact("Andrew", "+79298305848");
$book = new Book($connection);


$book->addContact("Alice", "+79183116162");
$book->addContact("Andrew", "+79298305848");
$book->addContact("Lilith", "+79283339533");
$book->addContact("PihPoh", "+79283339533");
$book->addContact("Lilith", "+79285556669");
$book->getContacts();
$book->getContacts();
$book->deleteContact("+79183116162");
$book->deleteContact("Bob");