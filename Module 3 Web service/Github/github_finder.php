<?php
$userData = null;
$repos = [];
$error = null;

if (isset($_POST['username'])) {
    $username = trim($_POST['username']);
    
    // GitHub API URLs
    $userUrl = "https://api.github.com/users/" . $username;
    $repoUrl = "https://api.github.com/users/" . $username . "/repos";

    // Function to fetch GitHub API data
    function fetchFromGithub($url) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERAGENT, 'PHP-App'); // Required by GitHub
        $response = curl_exec($ch);
        curl_close($ch);
        return json_decode($response, true);
    }

    $userData = fetchFromGithub($userUrl);

    if (isset($userData['message']) && $userData['message'] == "Not Found") {
        $error = "User not found!";
        $userData = null;
    } else {
        $repos = fetchFromGithub($repoUrl);
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>GitHub User Finder</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
<div class="container my-5">
    <h2 class="text-center mb-4">🔍 GitHub User & Repository Finder</h2>

    <form method="POST" class="d-flex justify-content-center mb-4">
        <input type="text" name="username" class="form-control w-50" placeholder="Enter GitHub username" required>
        <button type="submit" class="btn btn-dark ms-2">Search</button>
    </form>

    <?php if ($error): ?>
        <div class="alert alert-danger text-center"><?= $error ?></div>
    <?php endif; ?>

    <?php if ($userData): ?>
        <div class="card shadow-sm p-3 mb-4">
            <div class="d-flex align-items-center">
                <img src="<?= $userData['avatar_url'] ?>" alt="Avatar" class="rounded-circle me-3" width="80" height="80">
                <div>
                    <h5><?= $userData['name'] ?? $userData['login'] ?></h5>
                    <p><?= $userData['bio'] ?? 'No bio available' ?></p>
                    <p>
                        <a href="<?= $userData['html_url'] ?>" target="_blank" class="btn btn-sm btn-primary">View Profile</a>
                    </p>
                </div>
            </div>
        </div>

        <h4>📂 Public Repositories (<?= count($repos) ?>)</h4>
        <ul class="list-group">
            <?php foreach ($repos as $repo): ?>
                <li class="list-group-item">
                    <a href="<?= $repo['html_url'] ?>" target="_blank">
                        <?= $repo['name'] ?>
                    </a> - ⭐ <?= $repo['stargazers_count'] ?> | 🍴 <?= $repo['forks_count'] ?>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</div>
</body>
</html>
