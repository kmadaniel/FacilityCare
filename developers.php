<?php session_start();?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Maintenance System</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../CSS/style.css">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">
                <i class="fas fa-tools me-2 text-warning"></i>MaintenanceSys
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="dashboard.html"><i class="fas fa-home me-1"></i> Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="new-report.html"><i class="fas fa-plus-circle me-1"></i> New Report</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="reports.html"><i class="fas fa-list me-1"></i> All Reports</a>
                    </li>
                    <li class="nav-item dropdown">
                         <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-user-circle me-1"></i>
                            <?php echo isset($_SESSION['name']) ? htmlspecialchars($_SESSION['name']) : 'Staff User'; ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="profile.html"><i class="fas fa-user me-2"></i>Profile</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item text-danger" href="logout.php"><i class="fas fa-sign-out-alt me-2"></i>Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container py-5">
        <div class="row">
            <div class="col-md-8">
                <h2 class="fw-bold mb-4"><i class="fas fa-tachometer-alt me-2 text-warning"></i>Dashboard</h2>
                
                <!-- Quick Stats -->
                <div class="row mb-4">
                    <div class="col-md-4 mb-3">
                        <div class="card border-start border-5 border-primary h-100">
                            <div class="card-body">
                                <h5 class="text-muted">Pending</h5>
                                <h2 class="fw-bold">12</h2>
                                <a href="#" class="small">View all</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="card border-start border-5 border-warning h-100">
                            <div class="card-body">
                                <h5 class="text-muted">In Progress</h5>
                                <h2 class="fw-bold">5</h2>
                                <a href="#" class="small">View all</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="card border-start border-5 border-success h-100">
                            <div class="card-body">
                                <h5 class="text-muted">Resolved</h5>
                                <h2 class="fw-bold">24</h2>
                                <a href="#" class="small">View all</a>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Recent Reports -->
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-white">
                        <h5 class="mb-0"><i class="fas fa-history me-2"></i>Recent Reports</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Issue</th>
                                        <th>Location</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>#MR-1005</td>
                                        <td>Leaking Pipe</td>
                                        <td>Floor 3 - Restroom</td>
                                        <td><span class="badge bg-warning">In Progress</span></td>
                                        <td>2 hours ago</td>
                                    </tr>
                                    <tr>
                                        <td>#MR-1004</td>
                                        <td>Broken AC</td>
                                        <td>Floor 2 - Room 205</td>
                                        <td><span class="badge bg-primary">Pending</span></td>
                                        <td>5 hours ago</td>
                                    </tr>
                                    <tr>
                                        <td>#MR-1003</td>
                                        <td>Faulty Wiring</td>
                                        <td>Floor 1 - Lobby</td>
                                        <td><span class="badge bg-success">Resolved</span></td>
                                        <td>1 day ago</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <a href="reports.html" class="btn btn-outline-primary mt-3">View All Reports</a>
                    </div>
                </div>
            </div>
            
            <!-- Sidebar -->
            <div class="col-md-4">
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-white">
                        <h5 class="mb-0"><i class="fas fa-bolt me-2"></i>Quick Actions</h5>
                    </div>
                    <div class="card-body">
                        <a href="new-report.html" class="btn btn-warning w-100 mb-3">
                            <i class="fas fa-plus me-2"></i>Create New Report
                        </a>
                        <a href="#" class="btn btn-outline-secondary w-100 mb-3">
                            <i class="fas fa-search me-2"></i>Search Reports
                        </a>
                        <a href="#" class="btn btn-outline-secondary w-100">
                            <i class="fas fa-filter me-2"></i>Filter Reports
                        </a>
                    </div>
                </div>
                
                <div class="card shadow-sm">
                    <div class="card-header bg-white">
                        <h5 class="mb-0"><i class="fas fa-chart-pie me-2"></i>Statistics</h5>
                    </div>
                    <div class="card-body">
                        <canvas id="statusChart" height="200"></canvas>
                        <div class="mt-3">
                            <span class="badge bg-primary me-2">Pending (12)</span>
                            <span class="badge bg-warning me-2">In Progress (5)</span>
                            <span class="badge bg-success">Resolved (24)</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- <script>
        // Simple chart for demonstration
        const ctx = document.getElementById('statusChart').getContext('2d');
        const statusChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Pending', 'In Progress', 'Resolved'],
                datasets: [{
                    data: [12, 5, 24],
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
                maintainAspectRatio: false
            }
        });
    </script> -->
    <footer class="bg-light py-4 mt-5 border-top">
    <div class="container text-center text-muted">
      <p class="mb-0">&copy; 2025 FacilityCare. All rights reserved.</p>
    </div>
  </footer>
</body>
</html>