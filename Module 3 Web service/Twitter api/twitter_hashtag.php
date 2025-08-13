<?php
// Your Twitter API Bearer Token
$bearer_token = "YOUR_TWITTER_BEARER_TOKEN";

$tweets = [];
$error = null;

if (isset($_POST['hashtag'])) {
    $hashtag = urlencode("#" . trim($_POST['hashtag'])); // Encode hashtag
    $url = "https://api.twitter.com/2/tweets/search/recent?query={$hashtag}&max_results=10&tweet.fields=author_id,created_at,text";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Authorization: Bearer {$bearer_token}"
    ]);
    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($http_code == 200) {
        $data = json_decode($response, true);
        $tweets = $data['data'] ?? [];
    } else {
        $error = "Failed to fetch tweets. Check your API key or query.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Twitter Hashtag Search</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
<div class="container py-5">
    <h2 class="text-center mb-4">🐦 Twitter Hashtag Search</h2>

    <form method="POST" class="d-flex justify-content-center mb-4">
        <input type="text" name="hashtag" class="form-control w-50" placeholder="Enter hashtag (without #)" required>
        <button type="submit" class="btn btn-primary ms-2">Search</button>
    </form>

    <?php if ($error): ?>
        <div class="alert alert-danger text-center"><?= $error ?></div>
    <?php endif; ?>

    <?php if (!empty($tweets)): ?>
        <div class="list-group">
            <?php foreach ($tweets as $tweet): ?>
                <div class="list-group-item">
                    <p><?= htmlspecialchars($tweet['text']) ?></p>
                    <small class="text-muted">Posted on <?= date("d M Y, H:i", strtotime($tweet['created_at'])) ?></small>
                </div>
            <?php endforeach; ?>
        </div>
    <?php elseif ($_SERVER["REQUEST_METHOD"] == "POST" && empty($tweets)): ?>
        <div class="alert alert-warning text-center">No tweets found for this hashtag.</div>
    <?php endif; ?>
</div>
</body>
</html>
