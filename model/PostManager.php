<?php

namespace EricCodron\Blog\Model;
require_once("model/Manager.php");

require_once("vendor/ezyang/htmlpurifier/library/HTMLPurifier.auto.php");

use HTMLPurifier;

class PostManager extends Manager
{
    // Return all blog posts from the database, from most recent to less recent
    public function getPosts()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT id, author_first_name, author_last_name, title, intro, content, DATE_FORMAT(last_update_date, \'%d/%m/%Y à %Hh%i\') AS last_modif_date_fr FROM post ORDER BY last_update_date DESC');

        return $req;
    }

    // Return the last 2 blog posts from the database, from most recent to less recent
    public function getTwoPosts()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT id, author_first_name, author_last_name, title, intro, content, DATE_FORMAT(last_update_date, \'%d/%m/%Y à %Hh%i\') AS last_modif_date_fr FROM post ORDER BY last_update_date DESC LIMIT 0, 2');

        return $req;
    }

    // Return the last 5 blog posts from the database, from most recent to less recent
    public function getFivePosts()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT id, author_first_name, author_last_name, title, intro, content, DATE_FORMAT(last_update_date, \'%d/%m/%Y à %Hh%i\') AS last_modif_date_fr FROM post ORDER BY last_update_date DESC LIMIT 0, 5');

        return $req;
    }

    // Return a certain number (given by $limit) of blog posts from the database, starting from $start, from most recent to less recent
    public function getPostsRange($start, $limit)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, author_first_name, author_last_name, title, intro, content, DATE_FORMAT(last_update_date, \'%d/%m/%Y à %Hh%i\') AS last_modif_date_fr FROM post ORDER BY last_update_date DESC LIMIT :start , :limit'); // ?, ?');
        $req->bindParam(':start', $start, \PDO::PARAM_INT);
        $req->bindParam(':limit', $limit, \PDO::PARAM_INT);
        $req->execute();
        $postsRange = $req->fetchAll();

        return $postsRange;
    }

    // Return a single blog post given by its id
    public function getPost($postId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, author_first_name, author_last_name, title, intro, content, DATE_FORMAT(last_update_date, \'%d/%m/%Y à %Hh%i\') AS last_modif_date_fr FROM post WHERE id = ?');
        $req->execute(array($postId));
        $post = $req->fetch();

        return $post;
    }

    // Return the total number of blog posts
    public function getPostsNumber()
    {
        $posts = $this->getPosts();
        $postsNumber = $posts->rowCount();

        return $postsNumber;
    }

    // Insert a new blog post into the database
    public function postNewPost($title, $author_first_name, $author_last_name, $intro, $content)
    {
        // Initializing HTMLPurifier with default configuration
        $purifier = new HTMLPurifier();

        $db = $this->dbConnect();
        $posts = $db->prepare('INSERT INTO post (author_first_name, author_last_name, title, intro, content, last_update_date) VALUES (?, ?, ?, ?, ?, NOW())');
        $affectedLines = $posts->execute(array($purifier->purify($author_first_name), $purifier->purify($author_last_name), $purifier->purify($title), $purifier->purify($intro), $purifier->purify($content)));

        if($affectedLines === true) {
            return $db->lastInsertId();
        }
        else {
            return false;
        }
    }

    // Update a modified blog post into the database
    public function postModifiedPost($postId, $title, $author_first_name, $author_last_name, $intro, $content)
    {
        // Initializing HTMLPurifier with default configuration
        $purifier = new HTMLPurifier();

        $db = $this->dbConnect();
        $posts = $db->prepare('UPDATE post SET author_first_name = ?, author_last_name = ?, title = ?, intro = ?, content = ?, last_update_date = NOW() WHERE id = ?');
        $affectedLines = $posts->execute(array($purifier->purify($author_first_name), $purifier->purify($author_last_name), $purifier->purify($title),
            $purifier->purify($intro), $purifier->purify($content), $postId));

        return $affectedLines;
    }

    // Delete a blog post from the database
    public function postDeletedPost($postId)
    {
        $db = $this->dbConnect();
        $posts = $db->prepare('DELETE FROM post WHERE id = ?');
        $affectedLines = $posts->execute(array($postId));

        return $affectedLines;
    }

}