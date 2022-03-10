<?php

require_once __DIR__.'/User.php';
require_once __DIR__.'/Comment.php';

for ($i = 0; $i < 10; ++$i) {
    $user = new User("1234$i", 'Valeria', 'valeriya@mail.ru', 'a54uyVg454hh4');
    $comments[$i] = new Comment($user, "message num$i");
    sleep($i + 1);
}

$dateTime = $_POST['date'];
echo "Enter: $dateTime".'<br>';


foreach ($comments as $comment) {
    $comment_user_date = $comment->getUser()->getDateTime();
    if (strtotime($comment_user_date) > strtotime($dateTime)) {
        echo $comment->getMessage() . ' user time: ' . $comment->getUser()->getDateTime() . '<br>';
    }
}
