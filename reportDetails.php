<?php
include 'connection.php';
session_start();

$user_id = $_SESSION['user_id'] ?? null;

if (!$user_id) {
  header("Location: login.php");
  exit();
}

if (!isset($_GET['id'])) {
  die("Report ID not specified.");
}

$report_id = $_GET['id'];

// Fetch report info
$stmt = $pdo->prepare("SELECT * FROM Report WHERE report_id = :id");
$stmt->execute(['id' => $report_id]);
$report = $stmt->fetch();

if (!$report) {
  die("Report not found.");
}

// Fetch status
$statusStmt = $pdo->prepare("SELECT status FROM StatusLog WHERE report_id = :id ORDER BY timestamp DESC LIMIT 1");
$statusStmt->execute(['id' => $report_id]);
$status = $statusStmt->fetchColumn() ?? 'Pending';

// Fetch media
$mediaStmt = $pdo->prepare("SELECT file_path, media_type FROM Media WHERE report_id = :id");
$mediaStmt->execute(['id' => $report_id]);
$mediaFiles = $mediaStmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Report Details | Maintenance System</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="CSS/style.css">
  <style>
    .report-header {
      background-color: #f8f9fa;
      border-bottom: 1px solid #dee2e6;
      padding: 1rem;
      border-radius: 0.375rem 0.375rem 0 0;
    }

    .status-badge {
      font-size: 0.9rem;
      padding: 0.5rem 0.8rem;
    }

    .detail-item {
      margin-bottom: 1rem;
      padding-bottom: 1rem;
      border-bottom: 1px solid #eee;
    }

    .detail-item:last-child {
      border-bottom: none;
      margin-bottom: 0;
      padding-bottom: 0;
    }

    .update-log {
      border-left: 3px solid #95AEF1;
      padding-left: 1rem;
      margin-bottom: 1.5rem;
    }

    .update-log:last-child {
      margin-bottom: 0;
    }

    .img-thumbnail {
      transition: transform 0.2s;
      cursor: pointer;
    }

    .img-thumbnail:hover {
      transform: scale(1.02);
    }

    .media-preview {
      width: 100%;
      height: 250px;
      object-fit: cover;
      cursor: pointer;
    }
  </style>
</head>

<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
    <div class="container">
      <a class="navbar-brand fw-bold" href="index.php">
        <i class="fas fa-tools me-2 text-primary"></i>FacilityCare
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link" href="index.php"><i class="fas fa-home me-1"></i> Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="newReport.php"><i class="fas fa-plus-circle me-1"></i> New Report</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="reportListings.php"><i class="fas fa-list me-1"></i> My Reports</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
              <i class="fas fa-user-circle me-1"></i> <?php echo isset($_SESSION['name']) ? htmlspecialchars($_SESSION['name']) : 'Staff User'; ?>
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
              <li><a class="dropdown-item" href="profile.html"><i class="fas fa-user me-2"></i>My Profile</a></li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li><a class="dropdown-item text-danger" href="logout.php"><i class="fas fa-sign-out-alt me-2"></i>Logout</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Report Detail -->
  <div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h2 class="mb-0"><i class="fas fa-file-alt text-primary me-2"></i>Report Details</h2>
      <a href="reportListings.php" class="btn btn-outline-secondary">
        <i class="fas fa-arrow-left me-1"></i>Back to My Reports
      </a>
    </div>

    <div class="card shadow-sm mb-4">
      <div class="report-header d-flex justify-content-between align-items-center">
        <h4 class="mb-0"><?= htmlspecialchars($report['title']) ?></h4>
        <?php
        // Set $status to 'pending' if it is null, empty, or not set
        if (empty($status)) {
          $status = 'pending';
        }

        $badgeClass = match (strtolower($status)) {
          'inprogress' => 'bg-warning text-dark',
          'resolved'   => 'bg-success',
          'pending'    => 'bg-primary',
          default      => 'bg-secondary', // fallback if an unknown status appears
        };
        ?>
        <span class="status-badge badge <?= $badgeClass ?>">
          <i class="fas fa-circle-notch me-1"></i><?= ucwords(str_replace('_', ' ', $status)) ?>
        </span>

      </div>

      <div class="card-body">
        <div class="row">
          <div class="col-md-6">
            <div class="detail-item">
              <h6><i class="fas fa-calendar-alt text-muted me-2"></i>Date Submitted</h6>
              <p class="mb-0"><?= date("d M Y", strtotime($report['created_at'])) ?></p>
            </div>
            <div class="detail-item">
              <h6><i class="fas fa-map-marker-alt text-muted me-2"></i>Location</h6>
              <p class="mb-0"><?= htmlspecialchars($report['facilities']) ?></p>
            </div>
            <div class="detail-item">
              <h6><i class="fas fa-tag text-muted me-2"></i>Category</h6>
              <p class="mb-0"><?= htmlspecialchars($report['category']) ?></p>
            </div>
          </div>

          <div class="col-md-6">
            <div class="detail-item">
              <h6><i class="fas fa-user-tie text-muted me-2"></i>Assigned Technician</h6>
              <p class="mb-0">Hamzah</p> <!-- Hardcoded for now -->
            </div>
            <div class="detail-item">
              <h6><i class="fas fa-phone text-muted me-2"></i>Technician Contact</h6>
              <p class="mb-0">013123456</p> <!-- Hardcoded for now -->
            </div>
            <div class="detail-item">
              <h6><i class="fas fa-clock text-muted me-2"></i>Last Updated</h6>
              <p class="mb-0">28 May 2025 - 10:00 AM</p> <!-- Hardcoded -->
            </div>
          </div>
        </div>

        <div class="mt-4">
          <h6><i class="fas fa-align-left text-muted me-2"></i>Description</h6>
          <div class="alert alert-light bg-light">
            <?= nl2br(htmlspecialchars($report['description'])) ?>
          </div>
        </div>

        <?php if (count($mediaFiles) > 0): ?>
          <div class="mt-4">
            <h6><i class="fas fa-image text-muted me-2"></i>Attached Media</h6>
            <div class="d-flex flex-wrap gap-3">
              <?php foreach ($mediaFiles as $file): ?>
                <?php $fullPath = "/multimediaDB/backend/" . htmlspecialchars($file['file_path']); ?>
                <div style="width: 140px; height: 140px; cursor: pointer; position: relative;">
                  <?php if ($file['media_type'] === 'image'): ?>
                    <img src="<?= $fullPath ?>"
                      alt="Media"
                      class="img-thumbnail object-fit-cover w-100 h-100"
                      onclick="previewMedia('image', '<?= $fullPath ?>')">
                  <?php elseif ($file['media_type'] === 'video'): ?>
                    <video muted class="img-thumbnail object-fit-cover w-100 h-100"
                      onclick="previewMedia('video', '<?= $fullPath ?>')">
                      <source src="<?= $fullPath ?>" type="video/mp4">
                    </video>
                  <?php endif; ?>
                </div>
              <?php endforeach; ?>
            </div>
          </div>
        <?php endif; ?>
      </div>
    </div>

    <!-- Update Log -->
    <div class="card shadow-sm">
      <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="fas fa-history text-primary me-2"></i>Log</h5>
      </div>
      <div class="card-body">
        <div class="update-log">
          <div class="d-flex justify-content-between">
            <h6 class="text-primary">Technician Update</h6>
            <small class="text-muted">28 May 2025 - 10:00 AM</small>
          </div>
          <p class="mb-2">"Parts have been ordered. Will complete the repair tomorrow morning."</p>
          <p class="text-muted small mb-0"><i class="fas fa-user-tie me-1"></i>Hamzah</p>
        </div>

        <div class="update-log">
          <div class="d-flex justify-content-between">
            <h6 class="text-primary">Status Changed</h6>
            <small class="text-muted">27 May 2025 - 4:30 PM</small>
          </div>
          <p class="mb-2">Report assigned to plumbing team</p>
          <p class="text-muted small mb-0"><i class="fas fa-user-cog me-1"></i>System</p>
        </div>

        <div class="update-log">
          <div class="d-flex justify-content-between">
            <h6 class="text-primary">Report Submitted</h6>
            <small class="text-muted">27 May 2025 - 4:00 PM</small>
          </div>
          <p class="mb-2">Initial report created</p>
          <p class="text-muted small mb-0"><i class="fas fa-user me-1"></i>Staff User</p>
        </div>
      </div>
    </div>
  </div>

  <!-- Add Update Modal -->
  <div class="modal fade" id="addUpdateModal" tabindex="-1" aria-labelledby="addUpdateModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addUpdateModalLabel">Add Update</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form>
            <div class="mb-3">
              <label for="updateType" class="form-label">Update Type</label>
              <select class="form-select" id="updateType">
                <option selected>Status Update</option>
                <option>Technician Note</option>
                <option>Additional Information</option>
              </select>
            </div>
            <div class="mb-3">
              <label for="updateDetails" class="form-label">Details</label>
              <textarea class="form-control" id="updateDetails" rows="3"></textarea>
            </div>
            <div class="mb-3">
              <label for="updateImages" class="form-label">Add Images (Optional)</label>
              <input type="file" class="form-control" id="updateImages" multiple accept="image/*">
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="button" class="btn btn-primary">Submit Update</button>
        </div>
      </div>
    </div>
  </div>

  <footer class="bg-light py-4 mt-5 border-top">
    <div class="container text-center text-muted">
      <p class="mb-0">&copy; 2025 FacilityCare. All rights reserved.</p>
    </div>
  </footer>

  <!-- Bootstrap Preview Modal -->
  <div class="modal fade" id="mediaPreviewModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content bg-dark text-white">
        <div class="modal-header border-0">
          <button type="button" class="btn-close btn-close-white ms-auto" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body text-center" id="mediaPreviewContent">
          <!-- Media preview will be injected here -->
        </div>
      </div>
    </div>
  </div>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    function previewMedia(type, src) {
      const container = document.getElementById("mediaPreviewContent");
      container.innerHTML = '';

      if (type === 'image') {
        container.innerHTML = `<img src="${src}" class="img-fluid rounded">`;
      } else if (type === 'video') {
        container.innerHTML = `
        <video class="w-100" controls autoplay>
          <source src="${src}">
          Your browser does not support the video tag.
        </video>`;
      }

      const modal = new bootstrap.Modal(document.getElementById('mediaPreviewModal'));
      modal.show();
    }
  </script>

</body>

</html>