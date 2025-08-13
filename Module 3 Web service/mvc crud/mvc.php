<?php
class Comment
{
    private $conn;
    private $table = "comments";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Get all comments
    public function getAll()
    {
        $stmt = $this->conn->prepare("SELECT * FROM {$this->table} ORDER BY id DESC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Insert comment
    public function insert($user_name, $comment)
    {
        $stmt = $this->conn->prepare("INSERT INTO {$this->table} (user_name, comment) VALUES (:user_name, :comment)");
        return $stmt->execute([
            ':user_name' => $user_name,
            ':comment' => $comment
        ]);
    }

    // Update comment
    public function update($id, $user_name, $comment)
    {
        $stmt = $this->conn->prepare("UPDATE {$this->table} SET user_name = :user_name, comment = :comment WHERE id = :id");
        return $stmt->execute([
            ':id' => $id,
            ':user_name' => $user_name,
            ':comment' => $comment
        ]);
    }

    // Delete comment
    public function delete($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM {$this->table} WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }

    // Get single comment
    public function getById($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM {$this->table} WHERE id = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
