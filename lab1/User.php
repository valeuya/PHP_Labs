<?php
 
 require_once __DIR__.'/../vendor/autoload.php';

 use Symfony\Component\Validator\Validation;
 use Symfony\Component\Validator\ConstraintViolationListInterface;
 use Symfony\Component\Validator\Constraints\{Length, NotBlank, Email, Regex};
 

 class User{

    private string $id;
    private string $name;
    private string $password;
    private string $email;
    private $constructTime;


    public function __construct(string $id, string $name,string $email, string $password)
    {
        $this->_constructTime = date("F j, Y, g:i a");

        $violations = $this->validateName($name);
        $this->printViolations($violations, 'Invalid username');


        $violations = $this->validateId($id);
        $this->printViolations($violations, 'Invalid user id');


        $violations = $this->validatePass($password);
        $this->printViolations($violations, 'Invalid user password');


        $this->id = $id;
        $this->name = $name;
        $this->password = $password;
    }
    public function getCunstructDate()
    {
        return $this->_constructTime;
    }

    public function echoPrint(): void
    {
        echo "<br>User:<br>";
        echo "Id: $this->id<br>";
        echo "Name: $this->name<br>";
        echo "Password: $this->password<br>";
    }

    private function printViolations(ConstraintViolationListInterface $violations, string $title): void
    {
        if (count($violations) == 0)
            return;
        echo '<h3>' . $title . '</h3>';
        foreach ($violations as $violation) {
            echo $violation->getMessage() . '<br>';
        }
    }

    private function validateName(string $name):ConstraintViolationListInterface
    {
        $validator = Validation::createValidator();
        return $validator->validate($name, [
            new Length(['min' => 7]),
            new NotBlank(),
            new Email(),
        ]);
    }

    private function validateId(string $id): ConstraintViolationListInterface
    {
        $validator = Validation::createValidator();
        return $validator->validate($id, [
            new NotBlank(),
            new Regex(['pattern' => '/^\d{5}$/',]),
        ]);
    }

    private function validatePass(string $password): ConstraintViolationListInterface
    {
        $validator = Validation::createValidator();
        return $validator->validate($password, [
            new NotBlank(),
            new Regex(['pattern' => '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{12,25}$/',]),
        ]);
    }


 }
