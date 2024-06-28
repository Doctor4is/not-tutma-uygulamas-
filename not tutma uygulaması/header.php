<header>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #333;
            color: #fff;
            padding: 10px 0;
            text-align: center;
            position: relative;
        }

        header nav {
            margin-top: 10px;
        }

        header nav a {
            color: #fff;
            margin: 0 10px;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        header nav a:hover {
            color: #bbb;
        }

        header .logo a {
            color: #fff;
            text-decoration: none;
        }

        header .logo a:hover {
            color: #bbb;
        }

        header .auth-buttons {
            position: absolute;
            top: 50%;
            right: 20px;
            transform: translateY(-50%);
        }

        header .auth-buttons a {
            color: #fff;
            background-color: #555;
            padding: 10px 20px;
            border-radius: 5px;
            margin-left: 10px;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        header .auth-buttons a:hover {
            background-color: #777;
        }

        footer {
            background-color: #333;
            color: #fff;
            padding: 10px 0;
            text-align: center;
            position: fixed;
            width: 100%;
            bottom: 0;
        }

        h1, h2 {
            margin: 20px 0;
        }

        form {
            margin: 20px;
        }

        form input, form textarea {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        form button {
            padding: 10px 20px;
            background-color: #333;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        form button:hover {
            background-color: #555;
        }

        a {
            color: #333;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        ul {
            list-style: none;
            padding: 0;
        }

        ul li {
            background-color: #fff;
            margin: 10px 0;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #333;
            color: #fff;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s ease;
            margin: 5px 0;
        }

        .btn:hover {
            background-color: #555;
        }

        .admin-btn {
            background-color: #007bff;
        }

        .admin-btn:hover {
            background-color: #0056b3;
        }

        .logout-btn {
            background-color: #dc3545;
        }

        .logout-btn:hover {
            background-color: #c82333;
        }
    </style>
    <link rel="stylesheet" href="styles.css">
    <div class="logo"><a href="index.php"><h1>Not Tutma Uygulaması</h1></a></div>
    <nav>
        <a href="index.php">Anasayfa</a> |
        <a href="hakkimizda.php">Hakkımızda</a> |
        <a href="neden.php">Neden</a> |
        <a href="tavsiyeler.php">Tavsiyeler</a> |
        <a href="iletisim.php">İletişim</a> |
        <a href="notlarim.php">Notlarım</a> |
        <a href="pano.php">Pano</a>
    </nav>
    <div class="auth-buttons">
        <?php if (!isset($_SESSION['user_id'])): ?>
            <a href="login.php" class="btn">Giriş Yap</a>
            <a href="register.php" class="btn">Kayıt Ol</a>
        <?php else: ?>
            <a href="logout.php" class="btn logout-btn">Çıkış Yap</a>
        <?php endif; ?>
    </div>
</header>
