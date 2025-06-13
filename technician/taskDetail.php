<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assignment Details</title>
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
                            <a class="nav-link active" href="dashboardT.php">
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
                     <h2 class="mb-0">Assignment Details</h2>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <button class="btn btn-sm btn-outline-secondary me-2">
                            <i class="fas fa-arrow-left me-1"></i> Back
                        </button>
                    </div>
                </div>
        
        <div class="row">
            <div class="col-lg-8">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-4">
                            <div>
                                <h4 class="mb-1">Leaking pipe in restroom</h4>
                                <div class="d-flex align-items-center mt-2">
                                    <span class="badge bg-primary me-2">Plumbing</span>
                                    <span class="badge bg-danger">High Priority</span>
                                </div>
                            </div>
                            <div class="text-end">
                                <small class="text-muted">Report ID: #1245</small><br>
                                <small class="text-muted">Assigned: Today, 10:30 AM</small>
                            </div>
                        </div>
                        
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <h6 class="mb-2"><i class="fas fa-map-marker-alt me-2"></i> Location</h6>
                                <p>Main Building, 2nd Floor, Women's Restroom (Room 205)</p>
                            </div>
                            <div class="col-md-6">
                                <h6 class="mb-2"><i class="fas fa-user me-2"></i> Reported By</h6>
                                <p>John Doe (Facilities Department)</p>
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <h6 class="mb-2"><i class="fas fa-align-left me-2"></i> Description</h6>
                            <p>There's a significant leak from the pipe under the sink in the 2nd floor women's restroom. Water is dripping continuously and has created a small puddle. The leak appears to be coming from a joint near the wall.</p>
                        </div>
                        
                        <div class="mb-4">
                            <h6 class="mb-3"><i class="fas fa-images me-2"></i> Evidence Photos</h6>
                            <div class="d-flex flex-wrap">
                                <div class="media-thumbnail">
                                    <img src="https://via.placeholder.com/300x200?text=Leak+Photo+1" alt="Leak photo">
                                </div>
                                <div class="media-thumbnail">
                                    <img src="https://via.placeholder.com/300x200?text=Leak+Photo+2" alt="Leak photo">
                                </div>
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <h6 class="mb-3"><i class="fas fa-comment me-2"></i> Admin Notes</h6>
                            <div class="card bg-light mb-3">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between mb-2">
                                        <strong>Admin User</strong>
                                        <small class="text-muted">Today, 10:45 AM</small>
                                    </div>
                                    <p class="mb-0">Plumber has been assigned and will arrive tomorrow morning. Temporary bucket placed to catch drips.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mb-4"><i class="fas fa-clock me-2"></i> Status History</h5>
                        
                        <div class="status-timeline">
                            <div class="timeline-item">
                                <div class="d-flex justify-content-between">
                                    <strong>Assigned to you</strong>
                                    <small class="text-muted">Today, 10:30 AM</small>
                                </div>
                                <p class="mb-0 text-muted">Task assigned by Admin User</p>
                            </div>
                            
                            <div class="timeline-item">
                                <div class="d-flex justify-content-between">
                                    <strong>Status changed to "In Progress"</strong>
                                    <small class="text-muted">Today, 10:45 AM</small>
                                </div>
                                <p class="mb-0 text-muted">Admin note: Temporary bucket placed to catch drips</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title mb-3"><i class="fas fa-tasks me-2"></i> Task Actions</h5>
                        
                        <div class="alert alert-warning mb-4">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-hourglass-half me-2" style="font-size: 1.5rem;"></i>
                                <div>
                                    <h6 class="alert-heading mb-1">In Progress</h6>
                                    <p class="mb-0">Started: Today, 10:45 AM</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <label class="form-label">Update Status</label>
                            <select class="form-select mb-3">
                                <option selected>In Progress</option>
                                <option>On Hold - Waiting for Parts</option>
                                <option>Completed</option>
                                <option>Cannot Complete - Needs Specialist</option>
                            </select>
                            
                            <label class="form-label">Add Note</label>
                            <textarea class="form-control mb-3" rows="3" placeholder="Describe your progress or any issues..."></textarea>
                            
                            <label class="form-label">Add Photos</label>
                            <input type="file" class="form-control mb-3" accept="image/*">
                            
                            <div class="d-grid gap-2">
                                <button class="btn btn-primary action-btn">
                                    <i class="fas fa-save me-1"></i> Save Update
                                </button>
                                <button class="btn btn-success action-btn">
                                    <i class="fas fa-check-circle me-1"></i> Mark Complete
                                </button>
                                <button class="btn btn-danger action-btn">
                                    <i class="fas fa-times-circle me-1"></i> Cancel Task
                                </button>
                            </div>
                        </div>
                        
                        <hr>
                        
                        <div>
                            <h6 class="mb-3"><i class="fas fa-info-circle me-2"></i> Task Details</h6>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item px-0 d-flex justify-content-between">
                                    <span>Priority:</span>
                                    <span class="text-danger">High</span>
                                </li>
                                <li class="list-group-item px-0 d-flex justify-content-between">
                                    <span>Due Date:</span>
                                    <span>Today, EOD</span>
                                </li>
                                <li class="list-group-item px-0 d-flex justify-content-between">
                                    <span>Time Spent:</span>
                                    <span>45 minutes</span>
                                </li>
                                <li class="list-group-item px-0 d-flex justify-content-between">
                                    <span>Created:</span>
                                    <span>15 Jul 2023, 10:45 AM</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                
                <!-- <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mb-3"><i class="fas fa-toolbox me-2"></i> Required Tools</h5>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item px-0 d-flex justify-content-between">
                                <span>Pipe Wrench</span>
                                <span class="badge bg-success">Available</span>
                            </li>
                            <li class="list-group-item px-0 d-flex justify-content-between">
                                <span>Teflon Tape</span>
                                <span class="badge bg-success">Available</span>
                            </li>
                            <li class="list-group-item px-0 d-flex justify-content-between">
                                <span>Replacement Washers</span>
                                <span class="badge bg-warning">Low Stock</span>
                            </li>
                        </ul>
                    </div>
                </div> -->
            </div>
        </div>
            </main>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>