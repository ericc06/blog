<?php

namespace EricCodron\Blog\Model;

require_once("../model/Manager.php");

class PostManager extends Manager
{
    public function getPosts()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT id, author_first_name, author_last_name, title, intro, content, DATE_FORMAT(last_update_date, \'%d/%m/%Y\') AS last_modif_date_fr FROM posts ORDER BY last_update_date DESC LIMIT 0, 5');

        return $req;
    }

    public function getPost($postId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, author_first_name, author_last_name, title, intro, content, DATE_FORMAT(last_update_date, \'%d/%m/%Y\') AS last_modif_date_fr FROM posts WHERE id = ?');
        $req->execute(array($postId));
        $post = $req->fetch();

        return $post;
    }
}