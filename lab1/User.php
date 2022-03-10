<?php

require_once __DIR__.'/vendor/autoload.php';

use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Regex;
class User
{
    private string $id;
    private string $name;
    private string $password;
    private string $email;
    private $dateTime;

    public function __construct(string $id, string $name, string $email, string $password)
    {
        $this->dateTime = date('Y-m-d H:i:s');

        $violations = $this->validateId($id);
        $this->printViolations($violations, "Invalid user id $id");

        $violations = $this->validateName($name);
        $this->printViolations($violations, "Invalid username $name");

        $violations = $this->validateEmail($email);
        $this->printViolations($violations, "Invalid email $email");

        $violations = $this->validatePassword($password);
        $this->printViolations($violations, "Invalid user password $password");

        //if the data is incorrect, then don't write it 
        if (count($violations)==0) {
            $this->id = $id;
            $this->name = $name;
            $this->email = $email;
            $this->password = $password;
        } else {
            $this->id = "No id";
            $this->name = "No name";
            $this->email = "No email";
            $this->password = "No password";
        }
    }
    public function getDateTime()
    {
        return $this->dateTime;
    }
    private function validateId(string $id): ConstraintViolationListInterface
    {
        $validator = Validation::createValidator();
        return $validator->validate($id, [
            new NotBlank(),
            new Regex(['pattern' => '/^\d{5}$/',]),
        ]);
    }

    private function validateName(string $name): ConstraintViolationListInterface
    {
        $validator = Validation::createValidator();
        return $validator->validate($name, [
            new NotBlank(),
            new Regex(['pattern' => '/^([А-Я]{1}[а-яё]{1,23}|[A-Z]{1}[a-z]{1,23})$/',]),
        ]);
    }

    private function validateEmail(string $email): ConstraintViolationListInterface
    {
        $validator = Validation::createValidator();
        return $validator->validate($email, [
            new Length(['min' => 7]),
            new NotBlank(),
            new Email(),
        ]);
    }
    private function validatePassword(string $password): ConstraintViolationListInterface
    {
        $validator = Validation::createValidator();
        return $validator->validate($password, [
            new NotBlank(),
            new Regex(['pattern' => '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{12,25}$/',]),
        ]);
    }
    public function print(): void
    {
        echo '<br>'."User:".'<br>';
        echo "Id: $this->id".'<br>';
        echo "Name: $this->name".'<br>';
        echo "Email: $this->email".'<br>';
        echo "Password: $this->password".'<br>';
    }

    private function printViolations(ConstraintViolationListInterface $violations, string $title): void
    {
        if (count($violations) == 0) {
            return;
        }
        echo  '<br>'.$title.'<br>';
        foreach ($violations as $violation) {
            echo $violation->getMessage() . '<br>';
        }
    }
}
