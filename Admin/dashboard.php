<?php
session_start();
require_once '../connection.php';

// Count total reports
$totalReportsStmt = $pdo->query("SELECT COUNT(*) FROM Report");
$totalReports = $totalReportsStmt->fetchColumn();

// Count reports with no status (Pending/Open)
$openReportsStmt = $pdo->query("
   SELECT COUNT(*) FROM Report r
    WHERE (
        SELECT status FROM StatusLog s
        WHERE s.report_id = r.report_id
        ORDER BY timestamp DESC LIMIT 1
    ) ='open'
");
$openReports = $openReportsStmt->fetchColumn();

// Count reports with latest status = 'inprogress'
$inProgressStmt = $pdo->query("
    SELECT COUNT(*) FROM Report r
    WHERE (
        SELECT status FROM StatusLog s
        WHERE s.report_id = r.report_id
        ORDER BY timestamp DESC LIMIT 1
    ) = 'inprogress'
");
$inProgress = $inProgressStmt->fetchColumn();

// Count reports with latest status = 'resolved'
$resolvedStmt = $pdo->query("
    SELECT COUNT(*) FROM Report r
    WHERE (
        SELECT status FROM StatusLog s
        WHERE s.report_id = r.report_id
        ORDER BY timestamp DESC LIMIT 1
    ) = 'resolved'
");
$resolved = $resolvedStmt->fetchColumn();

// Fetch recent reports with their latest status
$reportsStmt = $pdo->query("
 SELECT 
        r.report_id, 
        r.title, 
        r.category, 
        r.priority, 
        u.name AS reported_by, 
        DATE_FORMAT(r.created_at, '%d-%m-%Y') AS created_date,
        (
            SELECT status 
            FROM StatusLog s
            WHERE s.report_id = r.report_id
            ORDER BY timestamp DESC LIMIT 1
        ) AS status
    FROM Report r
    JOIN User u ON r.user_id = u.user_id
    ORDER BY r.created_at DESC
    LIMIT 10
");
$reports = $reportsStmt->fetchAll();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../CSS/styleAdmin.css">
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Admin Sidebar -->
            <div class="col-md-3 col-lg-2 d-md-block admin-sidebar p-0">
                <div class="d-flex flex-column p-3">
                    <div class="text-center mb-4">
                        <h4 class="text-white mb-0">
                            <i class="fas fa-tools me-2"></i>FacilityCare
                        </h4>
                        <small class="text-white-50">Admin Panel</small>
                    </div>
                    <hr class="text-white-50">
                    <ul class="nav nav-pills flex-column mb-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="dashboard.php">
                                <i class="bi bi-speedometer2"></i> Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="allReports.php">
                                <i class="bi bi-list-check"></i> All Reports
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="archived.php">
                                <i class="bi bi-archive"></i> Archived
                            </a>
                        </li>
                    </ul>
                    <hr class="text-white-50">
                    <div class="dropdown">
                        <a href="#" class="d-flex justify-content-center align-items-center text-white text-decoration-none dropdown-toggle" data-bs-toggle="dropdown">
                            <strong> <?php echo isset($_SESSION['name']) ? htmlspecialchars($_SESSION['name']) : 'Staff User'; ?></strong>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                            <li><a class="dropdown-item" href="#"><i class="bi bi-person me-2"></i>Profile</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="../logout.php"><i class="bi bi-box-arrow-left me-2"></i>Sign out</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Admin Dashboard</h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <!-- <div class="btn-group me-2">
                            <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
                        </div> -->
                        <button type="button" class="btn btn-sm btn-primary">
                            <i class="bi bi-funnel me-1"></i> Filters
                        </button>
                    </div>
                </div>

                <!-- Stats Cards -->
                <div class="row mb-4">
                    <div class="col-md-3 mb-3">
                        <div class="card admin-card h-100">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h6 class="text-muted mb-2">Total Reports</h6>
                                        <h3 class="mb-0"><?= $totalReports ?></h3>
                                    </div>
                                    <div class="text-primary">
                                        <i class="bi bi-clipboard2-pulse"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="card admin-card h-100">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h6 class="text-muted mb-2">Open</h6>
                                        <h3 class="mb-0"><?= $openReports ?></h3>
                                    </div>
                                    <div class="text-danger">
                                        <i class="bi bi-exclamation-triangle"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="card admin-card h-100">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h6 class="text-muted mb-2">In Progress</h6>
                                        <h3 class="mb-0"><?= $inProgress ?></h3>
                                    </div>
                                    <div class="text-warning">
                                        <i class="bi bi-hourglass-split"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="card admin-card h-100">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h6 class="text-muted mb-2">Resolved</h6>
                                        <h3 class="mb-0"><?= $resolved ?></h3>
                                    </div>
                                    <div class="text-success">
                                        <i class="bi bi-check-circle"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Charts Row -->
                <!-- <div class="row mb-4">
                    <div class="col-md-6 mb-3">
                        <div class="card admin-card h-100">
                            <div class="card-body">
                                <h6 class="card-title">Reports by Category</h6>
                                <div class="chart-container"> -->
                <!-- Chart would go here -->
                <!-- <div class="d-flex align-items-center justify-content-center h-100">
                                        <p class="text-muted">[Chart: Reports by Category]</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="card admin-card h-100">
                            <div class="card-body">
                                <h6 class="card-title">Resolution Time</h6>
                                <div class="chart-container"> -->
                <!-- Chart would go here -->
                <!-- <div class="d-flex align-items-center justify-content-center h-100">
                                        <p class="text-muted">[Chart: Resolution Time]</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->

                <!-- Recent Reports Table -->
                <div class="card admin-card">
                    <div class="card-header bg-white">
                        <h5 class="mb-0">Recent Reports</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Title</th>
                                        <th>Category</th>
                                        <th>Priority</th>
                                        <th>Status</th>
                                        <th>Reported By</th>
                                        <th>Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($reports as $report):
                                        $status = $report['status'] ?? 'pending';
                                        $badge = match (strtolower($status)) {
                                            'inprogress' => 'status-progress',
                                            'resolved'   => 'status-resolved',
                                            default      => 'status-open'
                                        };
                                        $badgeText = ucwords(str_replace('_', ' ', $status));
                                        $priorityClass = match (strtolower($report['priority'])) {
                                            'high'   => 'bg-danger',
                                            'medium' => 'bg-warning',
                                            'low'    => 'bg-success',
                                            default  => 'bg-secondary'
                                        };
                                    ?>
                                        <tr>
                                            <td>#<?= htmlspecialchars($report['report_id']) ?></td>
                                            <td><?= htmlspecialchars($report['title']) ?></td>
                                            <td><?= htmlspecialchars($report['category']) ?></td>
                                            <td><span class="badge <?= $priorityClass ?>"><?= ucfirst($report['priority']) ?></span></td>
                                            <td><span class="status-badge <?= $badge ?>"><?= $badgeText ?></span></td>
                                            <td><?= htmlspecialchars($report['reported_by']) ?></td>
                                            <td><?= $report['created_date'] ?></td>
                                            <td>
                                                <?php if (strtolower($report['status'] ?? '') === 'open' || strtolower($report['status'] ?? '') === 'inprogress' || strtolower($report['status'] ?? '') === 'resolved'|| strtolower($report['status'] ?? '') === 'archive'): ?>
                                                    <a href="viewReport.php?id=<?= $report['report_id'] ?>" class="btn btn-sm btn-outline-secondary">View</a>
                                                <?php else: ?>
                                                    <a href="viewReport.php?id=<?= $report['report_id'] ?>&open=1" class="btn btn-sm btn-outline-primary">Open</a>
                                                <?php endif; ?>
                                            </td>

                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
</body>

</html>