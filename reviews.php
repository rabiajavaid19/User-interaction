<?php
// reviews.php
include 'db.php';

// Get filter and sort inputs
$business_id = $_GET['business_id'] ?? 0;
$min_rating = $_GET['min_rating'] ?? 1;
$sort_by = $_GET['sort_by'] ?? 'most_recent';

// Build query dynamically
$sql = "SELECT r.rating, r.review_text, r.helpful_votes, r.created_at, u.name AS user_name
        FROM reviews r
        JOIN users u ON r.user_id = u.id
        WHERE r.business_id = ? AND r.rating >= ?";

if ($sort_by == 'most_helpful') {
    $sql .= " ORDER BY r.helpful_votes DESC";
} else { // Default to most recent
    $sql .= " ORDER BY r.created_at DESC";
}

$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $business_id, $min_rating);
$stmt->execute();

$result = $stmt->get_result();

$reviews = [];
while ($row = $result->fetch_assoc()) {
    $reviews[] = $row;
}

$stmt->close();
$conn->close();

// Return JSON response
header('Content-Type: application/json');
echo json_encode($reviews);
?>
