<?php
session_start();
require_once '../connection.php';

$reportId = $_GET['id'] ?? null;

if (!$reportId) {
    die("Report ID not provided.");
}

// Fetch report data
$reportId = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM report WHERE report_id = ?");
$stmt->execute([$reportId]);
$report = $stmt->fetch();

if (!$report) {
    // If no report found, redirect to all reports page
    header("Location: allReports.php");
    exit();
}

// Ambil semua media berkaitan report
$mediaStmt = $pdo->prepare("SELECT * FROM media WHERE report_id = ?");
$mediaStmt->execute([$report['report_id']]);
$mediaFiles = $mediaStmt->fetchAll();

?>

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

                                <form action="processEditReport.php" method="POST">
                                    <input type="hidden" name="report_id" value="<?= $report['report_id'] ?>">

                                    <div class="row mb-3">
                                        <div class="col-md-8">
                                            <label for="reportTitle" class="form-label">Title</label>
                                            <input type="text" class="form-control" id="reportTitle" name="title"
                                                value="<?= htmlspecialchars($report['title']) ?>" readonly>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="reportId" class="form-label">Report ID</label>
                                            <input type="text" class="form-control" id="reportId" value="#<?= $report['report_id'] ?>" disabled>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="reportCategory" class="form-label">Category</label>
                                            <select class="form-select" id="reportCategory" name="category">
                                                <?php
                                                $categories = ['Plumbing', 'Electrical', 'HVAC', 'Structural', 'Cleaning', 'Other'];
                                                foreach ($categories as $cat) {
                                                    $selected = $report['category'] === $cat ? 'selected' : '';
                                                    echo "<option value=\"$cat\" $selected>$cat</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="reportUrgency" class="form-label">Priority</label>
                                            <select class="form-select" id="reportUrgency" name="priority">
                                                <?php
                                                $priorities = [
                                                    'low' => 'Low - Routine maintenance',
                                                    'medium' => 'Medium - Needs attention soon',
                                                    'high' => 'High - Immediate attention required'
                                                ];
                                                foreach ($priorities as $key => $label) {
                                                    $selected = $report['priority'] === $key ? 'selected' : '';
                                                    echo "<option value=\"$key\" $selected>$label</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="reportLocation" class="form-label">Location</label>
                                        <input type="text" class="form-control" id="reportLocation" name="facilities"
                                            value="<?= htmlspecialchars($report['facilities']) ?>">
                                    </div>

                                    <div class="mb-3">
                                        <label for="reportDescription" class="form-label">Description</label>
                                        <textarea class="form-control" id="reportDescription" name="description"
                                            rows="5"><?= htmlspecialchars($report['description']) ?></textarea>
                                    </div>

                                    <div class="mt-2">
    <h6 class="mb-2"><i class="bi bi-images me-2"></i> Media Evidence</h6>
    <div class="media-gallery">
        <?php if (count($mediaFiles) > 0): ?>
            <div class="mt-2">
                <div class="d-flex flex-wrap gap-3">
                    <?php foreach ($mediaFiles as $file): ?>
                        <?php
                        $relativePath = "../backend/" . htmlspecialchars($file['file_path']);
                        $mediaType = strtolower($file['media_type']);
                        ?>
                        <div style="width: 140px; height: 140px; cursor: pointer; position: relative;">
                            <?php if ($mediaType === 'image'): ?>
                                <img src="<?= $relativePath ?>"
                                     alt="Media Image"
                                     class="img-thumbnail object-fit-cover w-100 h-100"
                                     onclick="previewMedia('image', '<?= $relativePath ?>')">
                            <?php elseif ($mediaType === 'video'): ?>
                                <video muted
                                       class="img-thumbnail object-fit-cover w-100 h-100"
                                       onclick="previewMedia('video', '<?= $relativePath ?>')">
                                    <source src="<?= $relativePath ?>" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php else: ?>
            <p class="text-muted">No media uploaded.</p>
        <?php endif; ?>
    </div>
</div>

                                    <!-- <button class="btn btn-primary">Save Changes</button> -->
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
    
    <!-- Media Modal -->
    <div class="modal fade" id="mediaModal" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Preview</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body d-flex justify-content-center align-items-center" style="min-height: 300px;">
                    <img id="modalMediaContent"
                        style="max-width: 100%; max-height: 100%; object-fit: contain; display: none;" />

                    <video id="modalVideoContent"
                        controls muted
                        style="max-width: 100%; max-height: 100%; object-fit: contain; display: none;">
                        <source type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </div>
                <div class="modal-footer">
                    <a id="downloadBtn" href="#" class="btn btn-primary" download>Download</a>
                </div>
            </div>
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

    <script>
        const mediaModal = document.getElementById('mediaModal');

        if (mediaModal) {
            mediaModal.addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget;
                const mediaUrl = button.getAttribute('data-media');
                const isVideo = button.classList.contains('video');

                const imgElement = document.getElementById('modalMediaContent');
                const videoElement = document.getElementById('modalVideoContent');

                imgElement.style.display = isVideo ? 'none' : 'block';
                videoElement.style.display = isVideo ? 'block' : 'none';

                if (isVideo) {
                    videoElement.src = mediaUrl;
                    videoElement.load(); // make sure it's refreshed
                } else {
                    imgElement.src = mediaUrl;
                }

                const downloadBtn = document.getElementById('downloadBtn');
                downloadBtn.href = mediaUrl;
            });

            mediaModal.addEventListener('hidden.bs.modal', function() {
                const videoElement = document.getElementById('modalVideoContent');
                videoElement.pause();
                videoElement.src = '';
            });
        }

        function previewMedia(type, src) {
            const modal = new bootstrap.Modal(document.getElementById('mediaModal'));
            modal.show();

            setTimeout(() => {
                const img = document.getElementById('modalMediaContent');
                const video = document.getElementById('modalVideoContent');
                const downloadBtn = document.getElementById('downloadBtn');

                img.style.display = type === 'image' ? 'block' : 'none';
                video.style.display = type === 'video' ? 'block' : 'none';

                if (type === 'image') {
                    img.src = src;
                } else {
                    video.src = src;
                    video.load();
                }

                downloadBtn.href = src;
            }, 200);
        }
    </script>
    
</body>
</html>