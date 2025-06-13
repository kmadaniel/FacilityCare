<?php include("../backend/process_viewReport.php"); ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Report - Admin Panel</title>
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
                    <h1 class="h2">Maintenance Report Details</h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <a class="btn btn-sm btn-outline-secondary me-2" href="allReports.php">
                            <i class="bi bi-arrow-left me-1"></i> Back
                        </a>


                        <button class="btn btn-sm btn-danger me-2">
                            <i class="bi bi-trash me-1"></i> Delete
                        </button>
                        <button class="btn btn-sm btn-primary me-2">
                            <i class="bi bi-pencil me-1"></i> Edit
                        </button>
                    </div>
                </div>

                <div class="row">
                    <!-- Report Details Column -->
                    <div class="col-lg-8">
                        <div class="card admin-card mb-4">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start mb-4">
                                    <div>
                                        <h3 class="mb-1"><?= htmlspecialchars($report['title']) ?></h3>
                                        <div class="d-flex align-items-center mt-2">
                                            <span class="badge bg-primary me-2"><?= htmlspecialchars($report['category']) ?></span>
                                            <span class="badge urgency-<?= strtolower($report['priority']) ?> me-2"><?= ucfirst($report['priority']) ?> Priority</span>
                                            <span class="status-badge <?= match (strtolower($currentStatus['status'] ?? 'pending')) {
                                                                            'inprogress' => 'status-progress',
                                                                            'resolved' => 'status-resolved',
                                                                            'open' => 'status-open',
                                                                            default => 'status-open'
                                                                        } ?>">
                                                <?= ucfirst($currentStatus['status'] ?? 'Pending') ?>
                                            </span>
                                        </div>

                                    </div>
                                    <div class="text-end">
                                        <small class="text-muted">Report ID: #<?= $report['report_id'] ?></small><br>
                                        <small class="text-muted">Created: <?= date("d M Y, h:i A", strtotime($report['created_at'])) ?></small><br>
                                        <small class="text-muted">Last updated: <?= isset($currentStatus['timestamp']) ? date("d M Y, h:i A", strtotime($currentStatus['timestamp'])) : '-' ?></small>

                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <h6 class="mb-2"><i class="bi bi-geo-alt me-2"></i> Location</h6>
                                        <p><?= htmlspecialchars($report['facilities']) ?></p>
                                    </div>
                                    <div class="col-md-6">
                                        <h6 class="mb-2"><i class="bi bi-person me-2"></i> Reported By</h6>
                                        <div class="d-flex align-items-center">
                                            <img src="https://via.placeholder.com/40" class="rounded-circle me-2" width="40" height="40" hidden>
                                            <div>
                                                <p class="mb-0"><?= htmlspecialchars($report['reporter_name']) ?></p>
                                                <small class="text-muted"><?= htmlspecialchars($report['reporter_email']) ?></small>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <h6 class="mb-2"><i class="bi bi-card-text me-2"></i> Description</h6>
                                    <p><?= nl2br(htmlspecialchars($report['description'])) ?></p>
                                </div>

                                <div class="mb-4">
                                    <h6 class="mb-3"><i class="bi bi-images me-2"></i> Media Evidence</h6>
                                    <div class="media-gallery">
                                        <?php if (count($mediaFiles) > 0): ?>
                                            <div class="mt-4">
                                                <h6><i class="fas fa-image text-muted me-2"></i>Attached Media</h6>
                                                <div class="d-flex flex-wrap gap-3">
                                                    <?php foreach ($mediaFiles as $file): ?>
                                                        <?php
                                                        $relativePath = "/MultimediaDB/backend/" . htmlspecialchars($file['file_path']);
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
                                        <?php endif; ?>

                                    </div>
                                </div>

                            </div>
                        </div>

                        <!-- Update History -->
                        <div class="card admin-card">
                            <div class="card-body">
                                <h5 class="card-title mb-4"><i class="bi bi-clock-history me-2"></i> Update History</h5>

                                <?php foreach ($statusHistory as $log): ?>
                                    <div class="history-item mb-3">
                                        <div class="d-flex justify-content-between mb-2">
                                            <strong>Status changed to "<?= ucfirst($log['status']) ?>"</strong>
                                            <small class="text-muted"><?= date("d M Y, h:i A", strtotime($log['timestamp'])) ?></small>
                                        </div>
                                        <?php if ($log['notes']): ?>
                                            <div class="comment-bubble">
                                                <p class="mb-0"><?= nl2br(htmlspecialchars($log['notes'])) ?></p>
                                            </div>
                                        <?php endif; ?>
                                        <small class="text-muted">Updated by: <?= htmlspecialchars($log['changed_by']) ?></small>
                                    </div>
                                <?php endforeach; ?>

                            </div>
                        </div>
                    </div>

                    <!-- Status & Actions Column -->
                    <div class="col-lg-4">
                        <div class="card admin-card mb-4">
                            <div class="card-body">
                                <h5 class="card-title mb-3"><i class="bi bi-clipboard-check me-2"></i> Current Status</h5>

                                <div class="alert alert-warning">
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-hourglass-split me-2" style="font-size: 1.5rem;"></i>
                                        <div>
                                            <h6 class="alert-heading mb-1">
                                                <span <?= match (strtolower($currentStatus['status'] ?? 'pending')) {
                                                            'inprogress' => 'status-progress',
                                                            'resolved' => 'status-resolved',
                                                            'open' => 'status-open',
                                                            default => 'status-open'
                                                        } ?>">
                                                    <?= ucfirst($currentStatus['status'] ?? 'Pending') ?>
                                                </span>
                                            </h6>
                                            <p class="mb-0">Assigned to: Hamzah (Plumber)</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <h6 class="mb-3">Update Status</h6>
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

                                <div class="mb-4">
                                    <h6 class="mb-3">Add Comment</h6>
                                    <textarea class="form-control mb-2" rows="3" placeholder="Add a comment or update..."></textarea>
                                    <button class="btn btn-primary w-100">
                                        <i class="bi bi-send me-1"></i> Post Comment
                                    </button>
                                </div>

                                <hr>

                                <div>
                                    <h6 class="mb-3">Report Information</h6>
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item px-0 d-flex justify-content-between">
                                            <span>Priority:</span>
                                            <span class="badge urgency-<?= strtolower($report['priority']) ?> me-2"><?= ucfirst($report['priority']) ?></span>
                                        </li>
                                        <li class="list-group-item px-0 d-flex justify-content-between">
                                            <span>Assigned To:</span>
                                            <span>Hamzah (Plumber)</span>
                                        </li>
                                        <li class="list-group-item px-0 d-flex justify-content-between">
                                            <span>Contact Email:</span>
                                            <span>RoslanZulkifli@company.com</span>
                                        </li>
                                        <li class="list-group-item px-0 d-flex justify-content-between">
                                            <span>Created:</span>
                                            <span><?= date("d M Y, h:i A", strtotime($report['created_at'])) ?></span>
                                        </li>
                                        <li class="list-group-item px-0 d-flex justify-content-between">
                                            <span>Last Updated:</span>
                                            <span><?= isset($currentStatus['timestamp']) ? date("d M Y, h:i A", strtotime($currentStatus['timestamp'])) : '-' ?></span>
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
    <div class="modal fade" id="mediaModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Media Viewer</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <img id="modalMediaContent" src="" class="img-fluid" alt="Media content" style="max-height: 70vh;">
                    <video id="modalVideoContent" controls class="img-fluid" style="max-height: 70vh; display: none;">
                        Your browser does not support the video tag.
                    </video>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <a id="downloadBtn" class="btn btn-primary" href="#" download>
                        <i class="bi bi-download me-1"></i> Download
                    </a>
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
                const mediaUrl = button.getAttribute('data-media');
                const isVideo = button.classList.contains('video');

                const imgElement = document.getElementById('modalMediaContent');
                const videoElement = document.getElementById('modalVideoContent');

                if (isVideo) {
                    imgElement.style.display = 'none';
                    videoElement.style.display = 'block';
                    videoElement.src = mediaUrl;
                } else {
                    imgElement.style.display = 'block';
                    videoElement.style.display = 'none';
                    imgElement.src = mediaUrl;
                }
            });

            mediaModal.addEventListener('hidden.bs.modal', function() {
                const videoElement = document.getElementById('modalVideoContent');
                videoElement.pause();
            });
        }

        function previewMedia(type, src) {
            const img = document.getElementById('modalMediaContent');
            const video = document.getElementById('modalVideoContent');
            const downloadBtn = document.getElementById('downloadBtn');

            if (type === 'image') {
                img.src = src;
                img.style.display = 'block';
                video.style.display = 'none';
                video.pause();
            } else if (type === 'video') {
                video.src = src;
                video.style.display = 'block';
                img.style.display = 'none';
            }
            downloadBtn.href = src;
            // Show modal
            const modal = new bootstrap.Modal(document.getElementById('mediaModal'));
            modal.show();
        }
    </script>
</body>

</html>