<?php // Common HTML skeleton: every page is rendered inside this layout.?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php // $title is set by the controller; it comes from our own code or from the book/user name.?>
    <title><?= htmlspecialchars($title) ?></title>
    <link rel="stylesheet" href="css/style.css">
    <!-- Google Fonts: Inter (text) and Playfair Display (titles) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
</head>
<body>

<?php require_once __DIR__ . '/partials/header.php' ?>
    <?php // $content is the page already built by Controller::render(), inserted as is.?>
    <?= $content ?>
<?php require_once __DIR__ . '/partials/footer.php' ?>

</body>
</html>