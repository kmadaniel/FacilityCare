<?php session_start(); 
if (!isset($_SESSION['user_id'])) {
    header("Location: homepage.php"); 
    exit();
}?>

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
            <a class="navbar-brand fw-bold" href="index.php">
                <i class="fas fa-tools me-2 text-primary"></i>FacilityCare
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php"><i class="fas fa-home me-1"></i> Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="newReport.php"><i class="fas fa-plus-circle me-1"></i> New Report</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="reportListings.php"><i class="fas fa-list me-1"></i> My Reports</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-user-circle me-1"></i>
                            <?php echo isset($_SESSION['name']) ? htmlspecialchars($_SESSION['name']) : 'Staff User'; ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="profile.html"><i class="fas fa-user me-2"></i>My Profile</a></li>
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
                    <p class="mb-0">You have <strong>2 pending reports</strong> and <strong>1 report in progress</strong>.</p>
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
                        <p class="text-muted">Submit a new maintenance request with photos</p>
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
                        <a href="my-reports.html?status=resolved" class="btn btn-success w-100">View History</a>
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
                    <a href="report-detail.html?id=1005" class="list-group-item list-group-item-action">
                        <div class="d-flex w-100 justify-content-between">
                            <h6 class="mb-1">Leaking Pipe Report Updated</h6>
                            <small class="text-muted">2 hours ago</small>
                        </div>
                        <p class="mb-1">Technician Hamzah: "Parts ordered, will repair tomorrow"</p>
                        <small class="text-warning"><i class="fas fa-circle me-1"></i>In Progress</small>
                    </a>
                    <a href="report-detail.html?id=1004" class="list-group-item list-group-item-action">
                        <div class="d-flex w-100 justify-content-between">
                            <h6 class="mb-1">Broken AC Unit Assigned</h6>
                            <small class="text-muted">5 hours ago</small>
                        </div>
                        <p class="mb-1">Your report has been assigned to HVAC team</p>
                        <small class="text-primary"><i class="fas fa-circle me-1"></i>Pending</small>
                    </a>
                    <a href="report-detail.html?id=1001" class="list-group-item list-group-item-action">
                        <div class="d-flex w-100 justify-content-between">
                            <h6 class="mb-1">Elevator Issue Resolved</h6>
                            <small class="text-muted">3 days ago</small>
                        </div>
                        <p class="mb-1">Your elevator report has been completed</p>
                        <small class="text-success"><i class="fas fa-circle me-1"></i>Resolved</small>
                    </a>
                </div>
                <!-- <a href="notifications.html" class="btn btn-outline-secondary w-100 mt-3">View All Notifications</a> -->
            </div>
        </div>

        <!-- Quick Report Stats
        <div class="row">
            <div class="col-md-6 mb-4">
                <div class="card shadow-sm h-100">
                    <div class="card-header bg-white">
                        <h5 class="mb-0"><i class="fas fa-chart-pie me-2"></i>My Reports Summary</h5>
                    </div>
                    <div class="card-body">
                        <canvas id="myReportsChart" height="200"></canvas>
                        <div class="mt-3 text-center">
                            <span class="badge bg-primary me-2">Pending (2)</span>
                            <span class="badge bg-warning me-2">In Progress (1)</span>
                            <span class="badge bg-success">Resolved (5)</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="card shadow-sm h-100">
                    <div class="card-header bg-white">
                        <h5 class="mb-0"><i class="fas fa-fire-extinguisher me-2"></i>Urgent Issues</h5>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-danger">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-exclamation-triangle fa-2x me-3"></i>
                                <div>
                                    <h6 class="alert-heading mb-1">Water Leak (Floor 3)</h6>
                                    <p class="mb-0 small">High priority - Risk of property damage</p>
                                </div>
                            </div>
                        </div>
                        <div class="alert alert-warning">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-exclamation-circle fa-2x me-3"></i>
                                <div>
                                    <h6 class="alert-heading mb-1">Broken AC (Room 205)</h6>
                                    <p class="mb-0 small">Medium priority - Comfort issue</p>
                                </div>
                            </div>
                        </div>
                        <a href="new-report.html" class="btn btn-outline-danger w-100">
                            <i class="fas fa-plus me-2"></i>Report Urgent Issue
                        </a>
                    </div>
                </div>
            </div>
        </div> -->
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

    <!-- Footer -->
    <footer class="bg-light py-4 mt-5 border-top">
        <div class="container text-center text-muted">
            <p class="mb-0">&copy; 2025 FacilityCare. All rights reserved.</p>
        </div>
    </footer>
</body>

</html>