<?php

require_once __DIR__.'/User.php';


$user1 = new User("12345", 'Valeria', 'valeriya@mail.ru', 'a54uyVg454hh4');
$user1->print();
echo $user1->getDateTime().'<br>';


$user2 = new User("25455", 'Dmitry', 'vdimka65@mail.ru', 'hfghHhgdy4563');
$user2->print();
echo $user2->getDateTime().'<br>';

//error
$user3 = new User("25h55", 'Dmit2ry', 'vdimka65@mail.ru', 'hfghH=hgdy4563');
$user3->print();
echo $user3->getDateTime().'<br>';
