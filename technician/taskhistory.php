<?php
session_name("technician_session");
session_start();
require_once '../connection.php';

if (!isset($_SESSION['user_id']) || !isset($_SESSION['technician_id'])) {
    header("Location: ../login.php");
    exit();
}
$technicianId = $_SESSION['technician_id'];

$stmt = $pdo->prepare("
    SELECT r.*, s.status, s.timestamp 
    FROM report r
    JOIN (
        SELECT report_id, MAX(timestamp) AS latest_time
        FROM statuslog
        GROUP BY report_id
    ) latest ON r.report_id = latest.report_id
    JOIN statuslog s ON s.report_id = latest.report_id AND s.timestamp = latest.latest_time
    WHERE s.status = 'resolved' AND r.technician_id = ?
    ORDER BY s.timestamp DESC
");
$stmt->execute([$technicianId]);
$resolvedTasks = $stmt->fetchAll();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Work History - Technician Panel</title>
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
                            <a class="nav-link active" href="taskhistory.php">
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
                            <li><a class="dropdown-item" href="profileTech.php"><i class="bi bi-person me-2"></i>Profile</a></li>
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
                    <h1 class="h2">Work History</h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <div class="btn-group me-2">
                        </div>
                    </div>
                </div>

                <!-- Filters -->
                <div class="card mb-4">
                    <div class="card-body">
                        <form class="row g-3">
                            <div class="col-md-3">
                                <label class="form-label">Date Range</label>
                                <select class="form-select">
                                    <option selected>Last 30 Days</option>
                                    <option>This Week</option>
                                    <option>This Month</option>
                                    <option>Last Month</option>
                                    <option>Custom Range</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Status</label>
                                <select class="form-select">
                                    <option selected>All Statuses</option>
                                    <option>Completed</option>
                                    <option>Cancelled</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Category</label>
                                <select class="form-select">
                                    <option selected>All Categories</option>
                                    <option>Plumbing</option>
                                    <option>Electrical</option>
                                    <option>HVAC</option>
                                    <option>Structural</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <div class="d-flex justify-content-end">
                                    <button type="button" class="btn btn-outline-secondary me-2">
                                        <i class="fas fa-undo me-1"></i> Reset
                                    </button>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-filter me-1"></i> Apply Filters
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Work History List -->
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Completed Work Orders</h5>
                    </div>
                    <div class="card-body">
                        <div class="list-group list-group-flush">
                            <?php foreach ($resolvedTasks as $task): ?>
                                <a href="#" class="list-group-item list-group-item-action history-card mb-3">
                                    <div class="d-flex w-100 justify-content-between">
                                        <div>
                                            <h6 class="mb-1"><?= htmlspecialchars($task['title']) ?></h6>
                                            <div class="d-flex align-items-center mt-2">
                                                <span class="badge bg-primary me-2"><?= htmlspecialchars($task['category']) ?></span>
                                                <span class="badge badge-completed me-2">Resolved</span>
                                                <span class="badge time-badge me-2">
                                                    <i class="fas fa-clock me-1"></i> <?= /* kira masa dari log? */ "2h 15m" ?>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="text-end">
                                            <small class="text-muted">Resolved: <?= date('F j, Y, g:i A', strtotime($task['timestamp'])) ?></small>
                                        </div>
                                    </div>
                                    <div class="d-flex mt-3">
                                        <div class="me-3">
                                            <small class="text-muted">Location:</small>
                                            <p class="mb-0"><?= htmlspecialchars($task['facilities']) ?></p>
                                        </div>
                                        <div class="ms-auto">
                                            <img src="https://via.placeholder.com/300x200?text=<?= urlencode($task['title']) ?>" class="media-preview" data-bs-toggle="modal" data-bs-target="#mediaModal">
                                        </div>
                                    </div>
                                </a>
                            <?php endforeach; ?>
                        </div>

                        <!-- Pagination -->
                        <nav aria-label="Work history pagination" class="mt-4">
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

    <!-- Media Modal -->
    <div class="modal fade" id="mediaModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Work Documentation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <img id="modalMedia" src="" class="img-fluid" alt="Work documentation" style="max-height: 70vh;">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">
                        <i class="fas fa-download me-1"></i> Download
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Media modal functionality
        const mediaModal = document.getElementById('mediaModal');
        if (mediaModal) {
            mediaModal.addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget;
                const imgSrc = button.getAttribute('src');
                document.getElementById('modalMedia').src = imgSrc;
            });
        }
    </script>
</body>

</html>