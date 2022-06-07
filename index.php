<?php

require_once 'DBBlackbox.php';
require_once 'Comment.php';
require_once "Session.php";
require_once "helpers.php";

// your code here

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Disney buys Star Wars maker Lucasfilm from George Lucas | BBC News</title>

    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <article>

        <div class="img">
            <img src="img/article.jpg" alt="Disney buys Star Wars maker Lucasfilm from George Lucas">
        </div>

        <h1>Disney buys Star Wars maker Lucasfilm from George Lucas</h1>

        <p class="story">Disney is buying Lucasfilm, the company behind the Star Wars films, from its chairman and founder George Lucas for $4.05bn (£2.5bn).</p>

        <p>Mr Lucas said: "It's now time for me to pass Star Wars on to a new generation of film-makers."</p>

        <p>In a statement announcing the purchase, Disney said it planned to release a new Star Wars film, episode seven, in 2015.</p>

        <p>That will be followed by episodes eight and nine and then one new movie every two or three years, the company said.</p>

    </article>

    <div class="comments">
            <h2>Comment below:</h2>
            <div>
                <?php 
                $comments = select(null, null, 'Comment');         
                 
                    // do smth to show the comments!
                    foreach ($comments as $key => $comment_object) :?> 
                      
                        <?php foreach ($comment_object as $key => $text) :?> 
                            <?php if ($key === 'user') : ?>
                                <p class='comments__name'><b>User:</b> <?= $text?>.</p>
                            <?php elseif ($key === 'text') : ?>
                                <p class='comments__text'><b>Comment:</b> <?= $text?>.</p>
                                <hr>
                            </br>
                            <?php endif; ?>
                        <?php endforeach;?>
                    <?php endforeach;?>
            </div>

            <!-- your code here -->
        <?php 
        $success_message = Session::instance()->get('success_message');
        $errors          = Session::instance()->get('errors', []);


        $id = $_GET['id'] ?? null;

        if ($id) {
            // edit existing album
            $comment = find($id, 'Comment');

        } else {
            // create a new album
            $comment = new Comment;
        }


        ?>

        <?php if ($success_message) : ?>
            <div class="message message_success">
                <?= $success_message ?>
            </div>
        <?php endif; ?>

        <?php foreach ($errors as $error) : ?>
            <div class="message message_error">
                <?= $error ?>
            </div>
        <?php endforeach; ?>

        <?php if ($id) : ?>
            <form action="handle-form.php?id=<?= $id ?>" method="post">
        <?php else : ?>
            <form action="handle-form.php" method="post">
        <?php endif; ?>

            Your comment:<br>
            <input type="text" name="text" value="<?= old('text', $comment->text) ?>">
            <br>
            <br>

            User name:<br>
            <input type="text" name="user" value="<?= old('user', $comment->user) ?>">
            <br>
            <br>       
            <button>Add comment</button>

        </form>
    </div>
</body>
</html>