<?php
session_name("technician_session");
session_start();
require_once '../connection.php';

if (!isset($_SESSION['user_id']) || !isset($_SESSION['technician_id'])) {
    header("Location: ../login.php");
    exit();
}

$technicianId = $_SESSION['technician_id'];

// Fetch report yang assigned kepada technician ni
$stmt = $pdo->prepare("
    SELECT r.*, 
           (SELECT status FROM statuslog WHERE report_id = r.report_id ORDER BY timestamp DESC LIMIT 1) as current_status,
           (SELECT timestamp FROM statuslog WHERE report_id = r.report_id AND status IN ('assigned','in_progress') ORDER BY timestamp ASC LIMIT 1) as assigned_time
    FROM report r 
    WHERE r.technician_id = ?
    ORDER BY r.created_at DESC
");
$stmt->execute([$technicianId]);
$tasks = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Assignments - Technician Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../CSS/styleT.css">
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Technician Sidebar -->
            <div class="col-md-3 col-lg-2 d-md-block tech-sidebar p-0">
                <div class="d-flex flex-column p-3">
                    <div class="text-center mb-4">
                        <h4 class="text-white mb-0">
                            <i class="fas fa-tools me-2"></i>FacilityCare
                        </h4>
                        <small class="text-white-50">Technician Panel</small>
                    </div>
                    <hr class="text-white-50">
                    <ul class="nav nav-pills flex-column mb-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="dashboardTech.php">
                                <i class="fas fa-tachometer-alt me-2"></i> Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="allTasks.php">
                                <i class="fas fa-tasks me-2"></i> My Assignments
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="taskhistory.php">
                                <i class="fas fa-history me-2"></i> Work History
                            </a>
                        </li>
                    </ul>
                    <hr class="text-white-50">
                    <div class="dropdown">
                        <a href="#" class="d-flex justify-content-center align-items-center text-white text-decoration-none dropdown-toggle" data-bs-toggle="dropdown">
                            <strong> <?php echo isset($_SESSION['name']) ? htmlspecialchars($_SESSION['name']) : 'Technician User'; ?></strong>
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
                    <h1 class="h2">My Assignments</h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <div class="btn-group me-2">
                            <button class="btn btn-sm btn-outline-secondary">
                                <i class="fas fa-sync-alt me-1"></i> Refresh
                            </button>
                            <button class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-download me-1"></i> Export
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Filters -->
                <div class="card tech-card mb-4">
                    <div class="card-body">
                        <div class="d-flex flex-wrap align-items-center">
                            <div class="me-3 mb-2">
                                <div class="btn-group" role="group">
                                    <button type="button" class="btn btn-sm filter-btn active" data-filter="all">
                                        All Assignments
                                    </button>
                                    <button type="button" class="btn btn-sm filter-btn" data-filter="assigned">
                                        Assigned
                                    </button>
                                    <button type="button" class="btn btn-sm filter-btn" data-filter="inprogress">
                                        In Progress
                                    </button>
                                    <button type="button" class="btn btn-sm filter-btn" data-filter="completed">
                                        Completed
                                    </button>
                                </div>
                            </div>
                            <div class="me-3 mb-2">
                                <select class="form-select form-select-sm">
                                    <option>All Categories</option>
                                    <option>Plumbing</option>
                                    <option>Electrical</option>
                                    <option>HVAC</option>
                                    <option>Structural</option>
                                </select>
                            </div>
                            <div class="me-3 mb-2">
                                <select class="form-select form-select-sm">
                                    <option>All Priorities</option>
                                    <option>High</option>
                                    <option>Medium</option>
                                    <option>Low</option>
                                </select>
                            </div>
                            <div class="mb-2">
                                <div class="input-group input-group-sm">
                                    <input type="text" class="form-control" placeholder="Search assignments...">
                                    <button class="btn btn-outline-secondary" type="button">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Assignments List -->
                <div class="card tech-card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Current Assignments</h5>
                            <small class="text-muted">Showing 5 of 12 assignments</small>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="list-group list-group-flush">
                            <?php foreach ($tasks as $task): ?>
                                <?php
                                $status = $task['current_status'] ?? 'new';
                                if ($status !== 'in_progress') continue; // ← hanya teruskan jika status adalah in_progress

                                $priority = strtolower($task['priority']);
                                $statusBadge = match ($status) {
                                    'completed' => 'badge-completed',
                                    'in_progress' => 'badge-inprogress',
                                    'overdue' => 'badge-overdue',
                                    'assigned' => 'badge-assigned',
                                    default => 'badge-assigned'
                                };
                                $priorityClass = match ($priority) {
                                    'high' => 'priority-high',
                                    'medium' => 'priority-medium',
                                    'low' => 'priority-low',
                                    default => ''
                                };
                                $icon = match ($status) {
                                    'completed' => '<i class="fas fa-check-circle text-success me-2"></i>',
                                    'in_progress' => '<i class="fas fa-tools text-primary me-2"></i>',
                                    'overdue' => '<i class="fas fa-exclamation-triangle text-danger me-2"></i>',
                                    default => '<i class="fas fa-bell text-warning me-2"></i>'
                                };
                                $assignedDate = $task['assigned_time']
                                    ? date("F j, Y, g:i A", strtotime($task['assigned_time']))
                                    : 'N/A';
                                ?>
                                <a href="taskDetail.php?report_id=<?= $task['report_id'] ?>" class="list-group-item list-group-item-action assignment-card <?= $priorityClass ?>">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h6 class="mb-1"><?= $icon ?><?= htmlspecialchars($task['title']) ?></h6>
                                        <span class="badge badge-tech <?= $statusBadge ?>"><?= ucfirst(str_replace('_', ' ', $status)) ?></span>
                                    </div>
                                    <div class="d-flex flex-wrap mt-2">
                                        <div class="me-3 mb-1">
                                            <small class="text-muted">Location:</small>
                                            <p class="mb-0"><?= htmlspecialchars($task['facilities']) ?></p>
                                        </div>
                                        <div class="me-3 mb-1">
                                            <small class="text-muted">Category:</small>
                                            <p class="mb-0"><?= htmlspecialchars($task['category']) ?></p>
                                        </div>
                                        <div class="me-3 mb-1">
                                            <small class="text-muted">Assigned:</small>
                                            <p class="mb-0"><?= $assignedDate ?></p>
                                        </div>
                                        <div class="me-3 mb-1">
                                            <small class="text-muted">Priority:</small>
                                            <p class="mb-0 text-<?= $priority === 'high' ? 'danger' : ($priority === 'medium' ? 'warning' : 'success') ?>">
                                                <?= ucfirst($priority) ?>
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            <?php endforeach; ?>
                        </div>


                        <!-- Pagination -->
                        <nav aria-label="Assignments pagination" class="mt-4">
                            <ul class="pagination justify-content-center">
                                <li class="page-item disabled">
                                    <a class="page-link" href="#" tabindex="-1">Previous</a>
                                </li>
                                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#">Next</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Filter button functionality
        document.querySelectorAll('.filter-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
                this.classList.add('active');
                // Here you would add code to filter the assignments
            });
        });
    </script>
</body>

</html>