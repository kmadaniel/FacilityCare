<?php include("backend/process_index.php");
if (!isset($_SESSION['user_id'])) {
    header("Location: homepage.php");
    exit();
}

// Get success message if it exists
$successMessage = $_SESSION['success_message'] ?? null;
// Clear it immediately after retrieving
if (isset($_SESSION['success_message'])) {
    unset($_SESSION['success_message']);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Dashboard | Maintenance System</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="CSS/style.css">
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="homepagestaff.php">
                <i class="fas fa-tools me-2 text-primary"></i>FacilityCare
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="homepagestaff.php"><i class="fas fa-home me-1"></i> Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="newReport.php"><i class="fas fa-plus-circle me-1"></i> New Report</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="reportListings.php"><i class="fas fa-list me-1"></i> My Reports</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="developers.php"><i class="fas fa-user-cog me-1"></i> About Us</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-user-circle me-1"></i>
                            <?php echo isset($_SESSION['name']) ? htmlspecialchars($_SESSION['name']) : 'Staff User'; ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="profile.php"><i class="fas fa-user me-2"></i>My Profile</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item text-danger" href="logout.php"><i class="fas fa-sign-out-alt me-2"></i>Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container py-5">
        <!-- Welcome Banner -->
        <div class="alert alert-warning bg-light-warning border-0 mb-4">
            <div class="d-flex align-items-center">
                <div class="flex-shrink-0">
                    <i class="fas fa-info-circle fa-2x text-warning"></i>
                </div>
                <div class="flex-grow-1 ms-3">
                    <h5 class="alert-heading">Welcome back, <?php echo htmlspecialchars($_SESSION['name'] ?? 'Staff User'); ?>!</h5>
                    <p class="mb-0">
                        You have <strong><?php echo $pending; ?></strong> pending report(s)
                        and <strong><?php echo $inProgress; ?></strong> report(s) in progress.
                    </p>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="row mb-4">
            <div class="col-md-4 mb-3">
                <div class="card h-100 border-start border-5 border-primary">
                    <div class="card-body text-center">
                        <i class="fas fa-plus-circle fa-3x text-primary mb-3"></i>
                        <h5>Create New Report</h5>
                        <p class="text-muted">Submit a new maintenance request</p>
                        <a href="newReport.php" class="btn btn-primary w-100">Report Issue</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card h-100 border-start border-5 border-warning">
                    <div class="card-body text-center">
                        <i class="fas fa-tools fa-3x text-warning mb-3"></i>
                        <h5>My Active Reports</h5>
                        <p class="text-muted">Track your submitted maintenance requests</p>
                        <a href="reportListings.php" class="btn btn-warning w-100">View Reports</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card h-100 border-start border-5 border-success">
                    <div class="card-body text-center">
                        <i class="fas fa-check-circle fa-3x text-success mb-3"></i>
                        <h5>Resolved Issues</h5>
                        <p class="text-muted">View your completed maintenance reports</p>
                        <a href="reportListings.php?status=resolved" class="btn btn-success w-100">View History</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Activity Section -->
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-white">
                <h5 class="mb-0"><i class="fas fa-clock-rotate-left me-2"></i>Recent Activity</h5>
            </div>
            <div class="card-body">
                <div class="list-group list-group-flush">
                    <?php foreach ($recentActivities as $row): ?>
                        <?php
                        // Set status color
                        $statusColor = match (strtolower($row['status'])) {
                            'resolved' => 'text-success',
                            'in progress' => 'text-warning',
                            'open' => 'text-primary',
                            default => 'text-secondary'
                        };

                        // Format time ago
                        $updated = new DateTime($row['time']);
                        $now = new DateTime();
                        $interval = $now->diff($updated);

                        if ($interval->d > 0) {
                            $timeAgo = $interval->d . ' day' . ($interval->d > 1 ? 's' : '') . ' ago';
                        } elseif ($interval->h > 0) {
                            $timeAgo = $interval->h . ' hour' . ($interval->h > 1 ? 's' : '') . ' ago';
                        } elseif ($interval->i > 0) {
                            $timeAgo = $interval->i . ' minute' . ($interval->i > 1 ? 's' : '') . ' ago';
                        } else {
                            $timeAgo = 'Just now';
                        }

                        $technician = $row['technician'] ? " {$row['technician']}: " : '';
                        ?>
                        <a href="reportDetails.php?id=<?= htmlspecialchars($row['report_id']) ?>" class="list-group-item list-group-item-action">
                            <div class="d-flex w-100 justify-content-between">
                                <h6 class="mb-1"><b><?= htmlspecialchars("{$row['title']} Updated") ?></b></h6>
                                <small class="text-muted"><?= $timeAgo ?></small>
                            </div>
                            <p class="mb-1"><?= htmlspecialchars(($row['notes'] ?: 'No comment provided.')) ?></p>
                            <small class="<?= $statusColor ?>"><i class="fas fa-circle me-1"></i><?= htmlspecialchars($row['status']) ?></small>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Success Modal -->
    <div class="modal fade" id="successModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content border-success">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title">Login Successful</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Akan diisi guna JavaScript -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Staff Reports Chart
        const ctx = document.getElementById('myReportsChart').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Pending', 'In Progress', 'Resolved'],
                datasets: [{
                    data: [2, 1, 5],
                    backgroundColor: [
                        '#0d6efd',
                        '#ffc107',
                        '#198754'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            <?php if (!empty($successMessage)): ?>
                // Create modal instance
                var successModal = new bootstrap.Modal(document.getElementById('successModal'), {
                    keyboard: false
                });

                // Set message content
                document.querySelector('#successModal .modal-body').textContent = <?= json_encode($successMessage) ?>;

                // Show modal
                successModal.show();

                // Optional: Auto-close after 3 seconds
                setTimeout(function() {
                    successModal.hide();
                }, 3000);
            <?php endif; ?>
        });
    </script>
    
    <!-- Footer -->
    <footer class="bg-light py-4 mt-5 border-top">
        <div class="container text-center text-muted">
            <p class="mb-0">&copy; 2025 FacilityCare. All rights reserved.</p>
        </div>
    </footer>
</body>

</html>