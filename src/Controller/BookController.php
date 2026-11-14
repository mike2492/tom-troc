<?php

// Book pages: list with search, detail, edit (text and photo) and delete.
class BookController extends Controller
{
    public function edit()
    {
        $this->requireLogin();
        $id = (int) ($_GET['id'] ?? 0);

        $bookManager = new BookManager();
        $book = $bookManager->findById($id);

        // Ownership check: nobody can edit a book that belongs to someone else.
        if ($book === null || $book->getUserId() !== $_SESSION['user_id']) {
            header('Location: index.php?controller=account&action=index');
            exit;
        }

        $errors = [];


        // The form has two parts: the photo form is the only one sending $_FILES['image'].
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['image'])) {
            $file = $_FILES['image'];

            if ($file['error'] !== UPLOAD_ERR_OK) {
                $errors['image'] = "Erreur lors de l'envoi de l'image";
            } elseif ($file['size'] > 2 * 1024 * 1024) {
                $errors['image'] = "Image trop lourde (2 Mo Maximum)";
            } else {
                // Whitelist of accepted types, each mapped to a safe extension.
                $allowed = ['image/jpeg' => 'jpg', 'image/png' => 'png', 'image/webp' => 'webp'];
                // Real type read from the file content, not from the extension.
                $mime = mime_content_type($file['tmp_name']);

                if (!isset($allowed[$mime])) {
                    $errors['image'] = "Format non autorisé (jpg, png, webp)";
                } else {
                    // Random name: the original file name is never used.
                    $newName = bin2hex(random_bytes(16)) . '.' . $allowed[$mime];
                    move_uploaded_file($file['tmp_name'], __DIR__ . '/../../public/uploads/books/' . $newName);

                    // Delete the previous photo to avoid unused files.
                    if ($book->getImage() !== null) {
                        $oldFile = __DIR__ . '/../../public/uploads/books/' . $book->getImage();

                        if (is_file($oldFile)) {
                            unlink($oldFile);
                        }
                    }

                    $book->setImage($newName);
                    $bookManager->update($book);
                    header('Location: index.php?controller=account&action=index');
                    exit;
                }
            }
        }

        // Text form: only handled when no photo file was sent.
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !isset($_FILES['image'])) {

            if (isset($_POST['title'], $_POST['author'], $_POST['description'], $_POST['status']) && is_string($_POST['title']) && is_string($_POST['author']) && is_string($_POST['description']) && is_string($_POST['status'])) {

                $title = trim($_POST['title']);
                $author = trim($_POST['author']);
                $description = $_POST['description'];
                $status = $_POST['status'];

                if ($title === '') {
                    $errors['title'] = "Titre requis";
                }

                if ($author === '') {
                    $errors['author'] = "Auteur requis";
                }

                if ($description === '') {
                    $errors['description'] = "Description requise";
                }

                // Strict check: status must be exactly one of the two allowed values.
                if (!in_array($status, ['available', 'unavailable'], true)) {
                    $errors['status'] = "Disponibilité non valide";
                }

                if (empty($errors)) {
                    $book->setTitle($title);
                    $book->setAuthor($author);
                    $book->setDescription($description);
                    $book->setStatus($status);

                    $bookManager->update($book);
                    header('Location: index.php?controller=account&action=index');
                    exit;
                }

            } else {
                $errors['form'] = "Formulaire invalide";
            }
        }

        $this->render('book/form', ['title' => 'Modifier les informations', 'book' => $book, 'errors' => $errors]);
    }

    public function delete()
    {
        $this->requireLogin();
        $id = (int) ($_GET['id'] ?? 0);

        $bookManager = new BookManager();
        $book = $bookManager->findById($id);

        // Same ownership check as edit().
        if ($book === null || $book->getUserId() !== $_SESSION['user_id']) {
            header('Location: index.php?controller=account&action=index');
            exit;
        }

        $bookManager->delete($id);
        header('Location: index.php?controller=account&action=index');
        exit;
    }

    // Public list of all books, with an optional search on the title.
    public function index()
    {
        $bookManager = new BookManager();
        $search = $_GET['search'] ?? '';

        // ?search[]=x would be an array: treat it as an empty search.
        if (!is_string($search)) {
            $search = '';
        }

        // Limit the length of the search text.
        $search = mb_substr(trim($search), 0, 100);

        if ($search === '') {
            $books = $bookManager->findAll();
        } else {
            $books = $bookManager->searchByTitle($search);
        }

        $userManager = new UserManager();
        // Owner names indexed by book id, so the view can display "Vendu par".
        $owners = [];

        foreach ($books as $book) {
            $owner = $userManager->findById($book->getUserId());
            $owners[$book->getId()] = $owner->getUsername();
        }

        $this->render('book/index', ['title' => 'Nos livres à l\'échange', 'books' => $books, 'owners' => $owners, 'search' => $search]);
    }

    // Detail page of one book (no login required).
    public function show()
    {
        $id = (int) ($_GET['id'] ?? 0);
        $bookManager = new BookManager();

        $book = $bookManager->findById($id);
        if ($book === null) {
            header('Location: index.php?controller=book&action=index');
            exit;
        }

        $userManager = new UserManager();
        $owner = $userManager->findById($book->getUserId());

        $this->render('book/show', ['title' => $book->getTitle(), 'book' => $book, 'owner' => $owner]);
    }
}
