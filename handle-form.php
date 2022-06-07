<?php

require_once 'DBBlackbox.php';

// handle the submission of the form

require_once 'Comment.php';
require_once 'Session.php';


$id = $_GET['id'] ?? null;

if ($id) {
    // updating an existing album
    $comment = find($id, 'Comment');

} else {
    // inserting a new album
    $comment  = new Comment;
}

// validate!
$valid = true; // everything is ok
$errors = []; // error messages

if (empty($_POST['text'])) {
    $valid = false;
    $errors[] = 'The text field is mandatory';
}

if (empty($_POST['user'])) {
    $valid = false;
    $errors[] = 'The user field is mandatory';
}

 

if (!$valid) {
    // validation failed :-(

    // flash the error messages
    Session::instance()->flash('errors', $errors);

    // flash the (bad) request data
        Session::instance()->flashRequest();
    // redirect back
    if ($id) {
        header('Location: index.php?id=' . $id);
    } else {
        header('Location: index.php');
    }
    exit(); // stop execution of the script
}


// update the data from the request
$comment->text      = $_POST['text'] ?? $comment->text ;
$comment->user      = $_POST['user'] ?? $comment->user;
 

if ($id) {
    // update the existing record
    update($id, $comment);
} else {
    // insert a new record and get the ID
    $id = insert($comment);
}

Session::instance()->flash('success_message', 'Comment successfully added!');

header('Location: index.php?id=' . $id);