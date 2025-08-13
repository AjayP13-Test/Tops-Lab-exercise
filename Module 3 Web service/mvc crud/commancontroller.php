<?php
class CommentController
{
    private $commentModel;

    public function __construct($db)
    {
        require_once __DIR__ . '/../models/Comment.php';
        $this->commentModel = new Comment($db);
    }

    // List comments
    public function index()
    {
        $comments = $this->commentModel->getAll();
        require_once __DIR__ . '/../views/comments/index.php';
    }

    // Add comment
    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->commentModel->insert($_POST['user_name'], $_POST['comment']);
            header('Location: index.php?controller=Comment&action=index');
        } else {
            require_once __DIR__ . '/../views/comments/form.php';
        }
    }

    // Edit comment
    public function edit()
    {
        $id = $_GET['id'];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->commentModel->update($id, $_POST['user_name'], $_POST['comment']);
            header('Location: index.php?controller=Comment&action=index');
        } else {
            $comment = $this->commentModel->getById($id);
            require_once __DIR__ . '/../views/comments/form.php';
        }
    }

    // Delete comment
    public function delete()
    {
        $id = $_GET['id'];
        $this->commentModel->delete($id);
        header('Location: index.php?controller=Comment&action=index');
    }
}
