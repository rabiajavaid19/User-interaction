<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review Enhancements</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Filter Reviews</h1>
        <form action="reviews.php" method="get" class="row g-3">
            <div class="col-md-6">
                <label for="min_rating" class="form-label">Minimum Rating:</label>
                <select class="form-select" name="min_rating" id="min_rating">
                    <option value="1">1 Star</option>
                    <option value="2">2 Stars</option>
                    <option value="3">3 Stars</option>
                    <option value="4">4 Stars</option>
                    <option value="5">5 Stars</option>
                </select>
            </div>
            <div class="col-md-6">
                <label for="sort_by" class="form-label">Sort By:</label>
                <select class="form-select" name="sort_by" id="sort_by">
                    <option value="most_recent">Most Recent</option>
                    <option value="most_helpful">Most Helpful</option>
                </select>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary">Apply Filters</button>
            </div>
        </form>
    </div>
</body>
</html>
