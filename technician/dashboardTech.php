<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Technician Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
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
                            <a class="nav-link active" href="dashboardTech.php">
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
                            <strong>Technician User</strong>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                            <!-- <li><a class="dropdown-item" href="#"><i class="bi bi-person me-2"></i>Profile</a></li> -->
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#"><i class="bi bi-box-arrow-left me-2"></i>Sign out</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Technician Dashboard</h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <button type="button" class="btn btn-sm btn-outline-secondary">
                            <i class="fas fa-sync-alt me-1"></i> Refresh
                        </button>
                    </div>
                </div>

                <!-- Stats Cards -->
                <div class="row mb-4">
                    <div class="col-md-4 mb-3">
                        <div class="card tech-card h-100">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h6 class="text-muted mb-2">Assigned Tasks</h6>
                                        <h3 class="mb-0">5</h3>
                                    </div>
                                    <div style="color: var(--tech-secondary);">
                                        <i class="fas fa-clipboard-list fa-2x"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="card tech-card h-100">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h6 class="text-muted mb-2">In Progress</h6>
                                        <h3 class="mb-0">2</h3>
                                    </div>
                                    <div style="color: var(--tech-primary);">
                                        <i class="fas fa-tools fa-2x"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="card tech-card h-100">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h6 class="text-muted mb-2">Completed Today</h6>
                                        <h3 class="mb-0">3</h3>
                                    </div>
                                    <div style="color: var(--tech-accent);">
                                        <i class="fas fa-check-circle fa-2x"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Current Assignments -->
                <div class="card tech-card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">Current Assignments</h5>
                    </div>
                    <div class="card-body">
                        <div class="list-group list-group-flush">
                            <a href="taskDetail.php" class="list-group-item list-group-item-action">
                                <div class="d-flex w-100 justify-content-between">
                                    <h6 class="mb-1">Leaking pipe in restroom</h6>
                                    <span class="badge badge-tech badge-assigned">Assigned</span>
                                </div>
                                <div class="d-flex mt-2">
                                    <div class="me-3">
                                        <small class="text-muted">Location:</small>
                                        <p class="mb-0">Main Building, 2F Women's Restroom</p>
                                    </div>
                                    <div class="me-3">
                                        <small class="text-muted">Priority:</small>
                                        <p class="mb-0 text-danger">High</p>
                                    </div>
                                    <div>
                                        <small class="text-muted">Assigned:</small>
                                        <p class="mb-0">Today, 10:30 AM</p>
                                    </div>
                                </div>
                            </a>
                            <a href="#" class="list-group-item list-group-item-action">
                                <div class="d-flex w-100 justify-content-between">
                                    <h6 class="mb-1">AC not cooling in office 203</h6>
                                    <span class="badge badge-tech badge-inprogress">In Progress</span>
                                </div>
                                <div class="d-flex mt-2">
                                    <div class="me-3">
                                        <small class="text-muted">Location:</small>
                                        <p class="mb-0">East Wing, Office 203</p>
                                    </div>
                                    <div class="me-3">
                                        <small class="text-muted">Priority:</small>
                                        <p class="mb-0 text-warning">Medium</p>
                                    </div>
                                    <div>
                                        <small class="text-muted">Started:</small>
                                        <p class="mb-0">Yesterday, 2:15 PM</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="card tech-card">
                    <div class="card-header">
                        <h5 class="mb-0">Quick Actions</h5>
                    </div>
                    <div class="card-body">
                        <div class="row g-2">
                            <div class="col-md-4">
                                <button class="btn btn-outline-primary w-100 py-3">
                                    <i class="fas fa-clock me-2"></i> Start Shift
                                </button>
                            </div>
                            <div class="col-md-4">
                                <button class="btn btn-outline-success w-100 py-3">
                                    <i class="fas fa-check-circle me-2"></i> Complete Task
                                </button>
                            </div>
                            <div class="col-md-4">
                                <button class="btn btn-outline-warning w-100 py-3">
                                    <i class="fas fa-exclamation-triangle me-2"></i> Need Help
                                </button>
                            </div>
                            <div class="col-md-4">
                                <button class="btn btn-outline-info w-100 py-3">
                                    <i class="fas fa-notes-medical me-2"></i> Add Note
                                </button>
                            </div>
                            <div class="col-md-4">
                                <button class="btn btn-outline-secondary w-100 py-3">
                                    <i class="fas fa-camera me-2"></i> Add Photo
                                </button>
                            </div>
                            <div class="col-md-4">
                                <button class="btn btn-outline-danger w-100 py-3">
                                    <i class="fas fa-stopwatch me-2"></i> End Shift
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>