<?php

/**
 * Permet de savoir si une publication a déjà été liké par l'utilisateur connecté
 * 
 * @param INT $post_id l'ID du post
 * @return boolean $like Vrai si liké par l'utilisateur connecté
 * 
 */
function toutlesLikes($post_id, $pdo)
{

    $sql = "SELECT * FROM 76_likes
        WHERE user_id = " . $_SESSION["user_id"] . " AND post_id = " . $post_id;

    $stmt = $pdo->query($sql);

    if ($stmt->fetch(PDO::FETCH_ASSOC)) {
        $like = true;
    } else {
        $like = false;
    }

    $pdo = '';
    return $like;
}