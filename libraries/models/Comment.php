<?php

require_once('libraries/database.php');


class Comment
{
    /**
     * Retourne la liste des commentaires d'un article
     * 
     * @param int $id L'id de l'article
     * 
     * @return array
     */
    public function findAllWithArticle(int $id): array
    {
        $pdo = getPdo();
        $query = $pdo->prepare("SELECT * FROM comments WHERE article_id = :article_id");
        $query->execute(['article_id' => $id]);
        $commentaires = $query->fetchAll();

        return $commentaires;
    }

    /**
     * Retourne un commentaire avec son identifiant
     * 
     * @param int $id
     * 
     * @return array
     */
    public function find(int $id)
    {
        $pdo = getPdo();
        $query = $pdo->prepare('SELECT * FROM comments WHERE id = :id');
        $query->execute(['id' => $id]);
        $comment = $query->fetch();

        return $comment;
    }

    /**
     * Supprime un commentaire donné
     * 
     * @param int $id
     * 
     * @return void
     */
    public function delete(int $id): void
    {
        $pdo = getPdo();
        $query = $pdo->prepare('DELETE FROM comments WHERE id = :id');
        $query->execute(['id' => $id]);
    }


    /**
     * Insere un commentaire dans la base de données
     * 
     * @param string $author
     * @param string $content
     * @param int $article_id
     * 
     * @return void
     */
    public function insert(string $author, string $content, int $article_id): void
    {
        $pdo = getPdo();
        $query = $pdo->prepare('INSERT INTO comments SET author = :author, content = :content, article_id = :article_id, created_at = NOW()');
        $query->execute(compact('author', 'content', 'article_id'));
    }
}