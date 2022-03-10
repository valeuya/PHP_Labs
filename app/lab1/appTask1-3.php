<?php

require_once __DIR__.'/vendor/autoload.php';

use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Validation;

$s="a";
for ($i=0;$i<3;$i++) {
    $s=$s."a";
    $validator = Validation::createValidator();
    $violations = $validator->validate("Bernard$s", [
    new Length(['min' => 10]),
    new NotBlank(),
]);
    echo "Bernard$s"."\n";
    if (0 !== count($violations)) {
        foreach ($violations as $violation) {
            echo $violation->getMessage().'<br>';
        }
    } else {
        echo "Good".'<br>';
    }
}
