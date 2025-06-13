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
                            <a class="nav-link" href="#">
                                <i class="fas fa-history me-2"></i> Work History
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="fas fa-tools me-2"></i> Equipment
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
                            <!-- High Priority Assignment -->
                            <a href="#" class="list-group-item list-group-item-action assignment-card priority-high">
                                <div class="d-flex w-100 justify-content-between">
                                    <h6 class="mb-1">
                                        <i class="fas fa-exclamation-circle text-danger me-2"></i>
                                        Leaking pipe in restroom
                                    </h6>
                                    <span class="badge badge-tech badge-assigned">Assigned</span>
                                </div>
                                <div class="d-flex flex-wrap mt-2">
                                    <div class="me-3 mb-1">
                                        <small class="text-muted">Location:</small>
                                        <p class="mb-0">Main Building, 2F Women's Restroom</p>
                                    </div>
                                    <div class="me-3 mb-1">
                                        <small class="text-muted">Category:</small>
                                        <p class="mb-0">Plumbing</p>
                                    </div>
                                    <div class="me-3 mb-1">
                                        <small class="text-muted">Assigned:</small>
                                        <p class="mb-0">Today, 10:30 AM</p>
                                    </div>
                                    <div class="me-3 mb-1">
                                        <small class="text-muted">Due:</small>
                                        <p class="mb-0 text-danger">Today, EOD</p>
                                    </div>
                                </div>
                            </a>
                            
                            <!-- In Progress Assignment -->
                            <a href="#" class="list-group-item list-group-item-action assignment-card priority-medium">
                                <div class="d-flex w-100 justify-content-between">
                                    <h6 class="mb-1">
                                        <i class="fas fa-tools text-primary me-2"></i>
                                        AC not cooling in office 203
                                    </h6>
                                    <span class="badge badge-tech badge-inprogress">In Progress</span>
                                </div>
                                <div class="d-flex flex-wrap mt-2">
                                    <div class="me-3 mb-1">
                                        <small class="text-muted">Location:</small>
                                        <p class="mb-0">East Wing, Office 203</p>
                                    </div>
                                    <div class="me-3 mb-1">
                                        <small class="text-muted">Category:</small>
                                        <p class="mb-0">HVAC</p>
                                    </div>
                                    <div class="me-3 mb-1">
                                        <small class="text-muted">Started:</small>
                                        <p class="mb-0">Yesterday, 2:15 PM</p>
                                    </div>
                                    <div class="me-3 mb-1">
                                        <small class="text-muted">Time Spent:</small>
                                        <p class="mb-0">2 hours 15 mins</p>
                                    </div>
                                </div>
                            </a>
                            
                            <!-- Completed Assignment -->
                            <a href="#" class="list-group-item list-group-item-action assignment-card priority-low">
                                <div class="d-flex w-100 justify-content-between">
                                    <h6 class="mb-1">
                                        <i class="fas fa-check-circle text-success me-2"></i>
                                        Broken light fixture in hallway
                                    </h6>
                                    <span class="badge badge-tech badge-completed">Completed</span>
                                </div>
                                <div class="d-flex flex-wrap mt-2">
                                    <div class="me-3 mb-1">
                                        <small class="text-muted">Location:</small>
                                        <p class="mb-0">North Hallway, 1st Floor</p>
                                    </div>
                                    <div class="me-3 mb-1">
                                        <small class="text-muted">Category:</small>
                                        <p class="mb-0">Electrical</p>
                                    </div>
                                    <div class="me-3 mb-1">
                                        <small class="text-muted">Completed:</small>
                                        <p class="mb-0">Today, 9:15 AM</p>
                                    </div>
                                    <div class="me-3 mb-1">
                                        <small class="text-muted">Time Spent:</small>
                                        <p class="mb-0">45 mins</p>
                                    </div>
                                </div>
                            </a>
                            
                            <!-- Overdue Assignment -->
                            <a href="#" class="list-group-item list-group-item-action assignment-card priority-high">
                                <div class="d-flex w-100 justify-content-between">
                                    <h6 class="mb-1">
                                        <i class="fas fa-exclamation-triangle text-danger me-2"></i>
                                        Clogged drain in kitchen
                                    </h6>
                                    <span class="badge badge-tech badge-overdue">Overdue</span>
                                </div>
                                <div class="d-flex flex-wrap mt-2">
                                    <div class="me-3 mb-1">
                                        <small class="text-muted">Location:</small>
                                        <p class="mb-0">Main Kitchen</p>
                                    </div>
                                    <div class="me-3 mb-1">
                                        <small class="text-muted">Category:</small>
                                        <p class="mb-0">Plumbing</p>
                                    </div>
                                    <div class="me-3 mb-1">
                                        <small class="text-muted">Assigned:</small>
                                        <p class="mb-0">2 days ago</p>
                                    </div>
                                    <div class="me-3 mb-1">
                                        <small class="text-muted">Due:</small>
                                        <p class="mb-0 text-danger">Yesterday, EOD</p>
                                    </div>
                                </div>
                            </a>
                            
                            <!-- New Assignment -->
                            <a href="#" class="list-group-item list-group-item-action assignment-card priority-medium">
                                <div class="d-flex w-100 justify-content-between">
                                    <h6 class="mb-1">
                                        <i class="fas fa-bell text-warning me-2"></i>
                                        Squeaky door in conference room
                                    </h6>
                                    <span class="badge badge-tech badge-assigned">New</span>
                                </div>
                                <div class="d-flex flex-wrap mt-2">
                                    <div class="me-3 mb-1">
                                        <small class="text-muted">Location:</small>
                                        <p class="mb-0">Executive Conference Room</p>
                                    </div>
                                    <div class="me-3 mb-1">
                                        <small class="text-muted">Category:</small>
                                        <p class="mb-0">Structural</p>
                                    </div>
                                    <div class="me-3 mb-1">
                                        <small class="text-muted">Assigned:</small>
                                        <p class="mb-0">30 mins ago</p>
                                    </div>
                                    <div class="me-3 mb-1">
                                        <small class="text-muted">Due:</small>
                                        <p class="mb-0">Tomorrow, EOD</p>
                                    </div>
                                </div>
                            </a>
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