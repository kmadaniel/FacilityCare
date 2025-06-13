<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Report - Admin Panel</title>
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
                        <li class="nav-item">
                            <a class="nav-link" href="allTechnician.php">
                                <i class="bi bi-people"></i> Technicians
                            </a>
                        </li>
                    </ul>
                    <hr class="text-white-50">
                    <div class="dropdown">
                        <a href="#" class="d-flex justify-content-center align-items-center text-white text-decoration-none dropdown-toggle" data-bs-toggle="dropdown">
                            <strong>Admin User</strong>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                            <li><a class="dropdown-item" href="#"><i class="bi bi-person me-2"></i>Profile</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#"><i class="bi bi-box-arrow-left me-2"></i>Sign out</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Edit Maintenance Report</h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <button class="btn btn-sm btn-outline-secondary me-2">
                            <i class="bi bi-arrow-left me-1"></i> Back
                        </button>
                        <button class="btn btn-sm btn-danger me-2">
                            <i class="bi bi-trash me-1"></i> Delete
                        </button>
                        <button class="btn btn-sm btn-primary">
                            <i class="bi bi-save me-1"></i> Save Changes
                        </button>
                    </div>
                </div>

                <div class="row">
                    <!-- Report Details Column -->
                    <div class="col-lg-8">
                        <div class="card admin-card mb-4">
                            <div class="card-body">
                                <h5 class="card-title mb-4">Report Details</h5>
                                
                                <form>
                                    <div class="row mb-3">
                                        <div class="col-md-8">
                                            <label for="reportTitle" class="form-label">Title</label>
                                            <input type="text" class="form-control" id="reportTitle" value="Leaking pipe in restroom" readonly>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="reportId" class="form-label">Report ID</label>
                                            <input type="text" class="form-control" id="reportId" value="#1245" disabled>
                                        </div>
                                    </div>
                                    
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="reportCategory" class="form-label">Category</label>
                                            <select class="form-select" id="reportCategory">
                                                <option selected>Plumbing</option>
                                                <option>Electrical</option>
                                                <option>HVAC</option>
                                                <option>Structural</option>
                                                <option>Cleaning</option>
                                                <option>Other</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="reportUrgency" class="form-label">Priority</label>
                                            <select class="form-select" id="reportUrgency">
                                                <option>Low - Routine maintenance</option>
                                                <option>Medium - Needs attention soon</option>
                                                <option selected>High - Immediate attention required</option>
                                                <!-- <option>Emergency - Safety hazard</option> -->
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="reportLocation" class="form-label">Location</label>
                                        <input type="text" class="form-control" id="reportLocation" value="Main Building, 2nd Floor, Women's Restroom (Room 205)">
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="reportDescription" class="form-label">Description</label>
                                        <textarea class="form-control" id="reportDescription" rows="5">There's a significant leak from the pipe under the sink in the 2nd floor women's restroom. Water is dripping continuously and has created a small puddle. The leak appears to be coming from a joint near the wall.</textarea>
                                    </div>
                                    
                                    <div class="mb-4">
                                        <label class="form-label">Media Evidence</label>
                                        <div class="d-flex flex-wrap mb-3">
                                            <div class="media-thumbnail">
                                                <img src="https://via.placeholder.com/300x200?text=Leak+Photo+1" alt="Evidence photo">
                                                <div class="remove-btn" title="Remove this media">
                                                    <i class="bi bi-x"></i>
                                                </div>
                                            </div>
                                            <div class="media-thumbnail">
                                                <img src="https://via.placeholder.com/300x200?text=Leak+Photo+2" alt="Evidence photo">
                                                <div class="remove-btn" title="Remove this media">
                                                    <i class="bi bi-x"></i>
                                                </div>
                                            </div>
                                            <div class="media-thumbnail">
                                                <div class="ratio ratio-1x1 bg-light d-flex align-items-center justify-content-center">
                                                    <i class="bi bi-play-circle-fill text-primary" style="font-size: 1.5rem;"></i>
                                                </div>
                                                <div class="remove-btn" title="Remove this media">
                                                    <i class="bi bi-x"></i>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <!-- <div class="media-upload-area" id="mediaUploadArea">
                                            <div class="media-upload-icon">
                                                <i class="bi bi-cloud-arrow-up"></i>
                                            </div>
                                            <p class="mb-1">Drag & drop files here or click to browse</p>
                                            <p class="small text-muted mb-0">Supports JPG, PNG, MP4 (max 10MB each)</p>
                                            <input type="file" id="mediaUploadInput" class="d-none" multiple accept="image/*,video/*">
                                        </div> -->
                                    </div>
                                </form>
                            </div>
                        </div>
                        
                        <!-- Update History -->
                        <div class="card admin-card">
                            <div class="card-body">
                                <h5 class="card-title mb-4">Update History</h5>
                                
                                <div class="history-item">
                                    <div class="d-flex justify-content-between mb-2">
                                        <strong>Status changed to "In Progress"</strong>
                                        <small class="text-muted">16 Jul 2025, 02:30 PM</small>
                                    </div>
                                    <p class="mb-1">Assigned to: Hamzah (Plumber)</p>
                                    <p class="mb-0 text-muted">Admin note: Plumber has been assigned and will arrive tomorrow morning. Temporary bucket placed to catch drips.</p>
                                </div>
                                
                                <div class="history-item">
                                    <div class="d-flex justify-content-between mb-2">
                                        <strong>Status changed to "Open"</strong>
                                        <small class="text-muted">15 Jul 2025, 03:15 PM</small>
                                    </div>
                                    <p class="mb-0 text-muted">Admin note: Initial assessment: Needs professional plumber. Contacting vendor.</p>
                                </div>
                                
                                <div class="history-item">
                                    <div class="d-flex justify-content-between mb-2">
                                        <strong>Report created</strong>
                                        <small class="text-muted">15 Jul 2025, 10:45 AM</small>
                                    </div>
                                    <p class="mb-0 text-muted">Reported by: Roslan Zulkifli (Facilities)</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Status & Actions Column -->
                    <div class="col-lg-4">
                        <div class="card admin-card mb-4">
                            <div class="card-body">
                                <h5 class="card-title mb-3">Report Status</h5>
                                
                                <div class="mb-4">
                                    <label class="form-label">Current Status</label>
                                    <select class="form-select mb-3">
                                        <option>Open</option>
                                        <option selected>In Progress</option>
                                        <option>Resolved</option>
                                    </select>
                                    
                                    <div class="mb-3">
                                        <label class="form-label">Assigned To</label>
                                        <select class="form-select">
                                            <option selected>Hamzah (Plumber)</option>
                                            <option>Plumbing Team</option>
                                            <option>Electrical Team</option>
                                            <option>HVAC Team</option>
                                            <option>Other Technician</option>
                                        </select>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="statusNote" class="form-label">Add Note</label>
                                        <textarea class="form-control" id="statusNote" rows="3" placeholder="Add a note about this status change..."></textarea>
                                    </div>
                                    
                                    <button class="btn btn-primary w-100">
                                        <i class="bi bi-save me-1"></i> Update Status
                                    </button>
                                </div>
                                
                                <hr>
                                
                                <div class="mb-4">
                                    <h6 class="mb-3">Quick Actions</h6>
                                    <div class="d-grid gap-2">
                                        <button class="btn btn-success">
                                            <i class="bi bi-check-circle me-1"></i> Mark as Resolved
                                        </button>
                                        <button class="btn btn-outline-secondary">
                                            <i class="bi bi-archive me-1"></i> Archive Report
                                        </button>
                                    </div>
                                </div>
                                
                                <hr>
                                
                                <div>
                                    <h6 class="mb-3">Report Information</h6>
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item px-0 d-flex justify-content-between">
                                            <span>Reported By:</span>
                                            <span>Roslan Zulkifli</span>
                                        </li>
                                        <li class="list-group-item px-0 d-flex justify-content-between">
                                            <span>Department:</span>
                                            <span>Facilities</span>
                                        </li>
                                        <li class="list-group-item px-0 d-flex justify-content-between">
                                            <span>Contact:</span>
                                            <span>RoslanZulkifli@company.com</span>
                                        </li>
                                        <li class="list-group-item px-0 d-flex justify-content-between">
                                            <span>Created:</span>
                                            <span>15 Jul 2025, 10:45 AM</span>
                                        </li>
                                        <li class="list-group-item px-0 d-flex justify-content-between">
                                            <span>Last Updated:</span>
                                            <span>16 Jul 2025, 02:30 PM</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Media upload functionality
        document.getElementById('mediaUploadArea').addEventListener('click', function() {
            document.getElementById('mediaUploadInput').click();
        });
        
        // Drag and drop functionality
        const mediaUploadArea = document.getElementById('mediaUploadArea');
        
        mediaUploadArea.addEventListener('dragover', (e) => {
            e.preventDefault();
            mediaUploadArea.style.borderColor = '#85A1EF';
            mediaUploadArea.style.backgroundColor = 'rgba(133, 161, 239, 0.1)';
        });
        
        mediaUploadArea.addEventListener('dragleave', () => {
            mediaUploadArea.style.borderColor = '#dee2e6';
            mediaUploadArea.style.backgroundColor = '';
        });
        
        mediaUploadArea.addEventListener('drop', (e) => {
            e.preventDefault();
            mediaUploadArea.style.borderColor = '#dee2e6';
            mediaUploadArea.style.backgroundColor = '';
            // Handle dropped files here
            console.log('Files dropped:', e.dataTransfer.files);
        });
    </script>
</body>
</html>