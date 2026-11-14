<?php

// Base class for all controllers: view rendering and access control.
abstract class Controller
{
    protected function render(string $view, array $data = [])
    {
        // Turns array keys into variables usable in the view ($user, $errors...).
        extract($data);

        // Capture the view output so the layout can insert it as $content.
        ob_start();
        require __DIR__ . '/../View/' . $view . '.php';
        $content = ob_get_clean();

        require __DIR__ . '/../View/layout.php';
    }

    // Redirects to the login page when nobody is logged in.
    // exit stops the script so the protected code never runs.
    protected function requireLogin()
    {
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?controller=auth&action=login');
            exit;
        }
    }
}
