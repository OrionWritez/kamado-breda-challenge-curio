<?php
$current_page = basename($_SERVER['PHP_SELF'], '.php');
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($page_title) ? $page_title . ' | ' : ''; ?>Kamado Breda</title>
    <link rel="icon" type="image/png" href="img/logo.png">
    <link rel="stylesheet" href="css/style.css?v=<?php echo filemtime(__DIR__ . '/css/style.css'); ?>">
</head>
<body>
    <header class="header">
        <div class="header-inner">
            <a href="index.php" class="logo"><img src="img/logo.png" alt="Kamado Breda"></a>
            
            <button class="mobile-menu-btn" id="menuBtn" aria-label="Menu">☰</button>
            
            <nav class="nav" id="mainNav">
                <a href="index.php" class="<?php echo $current_page === 'index' ? 'active' : ''; ?>">HOME</a>
                <a href="producten.php" class="<?php echo $current_page === 'producten' ? 'active' : ''; ?>">Producten</a>
                <a href="masterclasses.php" class="<?php echo $current_page === 'masterclasses' ? 'active' : ''; ?>">Master Classes</a>
                <a href="contact.php" class="<?php echo $current_page === 'contact' ? 'active' : ''; ?>">Contact</a>
            </nav>
            

        </div>
    </header>
    <main class="main">