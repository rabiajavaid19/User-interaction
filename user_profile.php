<?php
// user_profile.php
include 'db.php';

$user_id = $_GET['user_id'] ?? 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $favorite_categories = $_POST['favorite_categories'];
    $budget_preferences = $_POST['budget_preferences'];

    $stmt = $conn->prepare("UPDATE users SET favorite_categories = ?, budget_preferences = ? WHERE id = ?");
    $stmt->bind_param("ssi", $favorite_categories, $budget_preferences, $user_id);

    if ($stmt->execute()) {
        echo "Profile updated successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
} else {
    $stmt = $conn->prepare("SELECT favorite_categories, budget_preferences FROM users WHERE id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();

    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>User Profile</h1>
        <form action="user_profile.php?user_id=<?= $user_id ?>" method="post">
            <div class="mb-3">
                <label for="favorite_categories" class="form-label">Favorite Categories:</label>
                <input type="text" class="form-control" id="favorite_categories" name="favorite_categories" 
                       value="<?= htmlspecialchars($user['favorite_categories'] ?? '') ?>" required>
            </div>
            <div class="mb-3">
                <label for="budget_preferences" class="form-label">Budget Preferences:</label>
                <input type="text" class="form-control" id="budget_preferences" name="budget_preferences" 
                       value="<?= htmlspecialchars($user['budget_preferences'] ?? '') ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Update Profile</button>
        </form>
    </div>
</body>
</html>
