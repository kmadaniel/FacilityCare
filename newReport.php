<?php include('backend/process_newReport.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Dashboard | Maintenance System</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="CSS/style.css">
</head>

<body>
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
                            <i class="fas fa-user-circle me-1"></i>
                            <?php echo isset($_SESSION['name']) ? htmlspecialchars($_SESSION['name']) : 'Staff User'; ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="profile.html"><i class="fas fa-user me-2"></i>My Profile</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item text-danger" href="logout.php"><i class="fas fa-sign-out-alt me-2"></i>Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-white">
                        <h4 class="mb-0"><i class="fas fa-plus-circle me-2 text-warning"></i>New Maintenance Report</h4>
                    </div>
                    <div class="card-body">
                        <form action="backend/process_newReport.php" method="POST" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="issueTitle" class="form-label">Issue Title*</label>
                                <input type="text" class="form-control" id="issueTitle" name="title" placeholder="E.g., Leaking pipe in restroom" required>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="location" class="form-label">Location*</label>
                                    <input type="text" class="form-control" id="location" name="location" placeholder="Building, Floor, Unit No, Room" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="category" class="form-label">Category*</label>
                                    <select class="form-select" name="category" id="category" required>
                                        <option value="" selected disabled>Select category</option>
                                        <?php foreach ($enumValues as $category): ?>
                                            <option value="<?= htmlspecialchars($category) ?>"><?= htmlspecialchars($category) ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="priority" class="form-label">Priority Level*</label>
                                <div class="d-flex gap-3">
                                    <?php foreach ($priorityValues as $value): ?>
                                        <?php
                                            $badgeClass = match (strtolower($value)) {
                                                'low' => 'bg-success',
                                                'medium' => 'bg-warning',
                                                'high' => 'bg-danger',
                                                default => 'bg-secondary',
                                            };
                                        ?>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="priority" id="<?= htmlspecialchars($value) ?>" value="<?= htmlspecialchars($value) ?>" <?= strtolower($value) === 'medium' ? 'checked' : '' ?>>
                                            <label class="form-check-label" for="<?= htmlspecialchars($value) ?>">
                                                <span class="badge <?= $badgeClass ?>"><?= ucfirst($value) ?></span>
                                            </label>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">Detailed Description*</label>
                                <textarea class="form-control" id="description" rows="4" name="description" placeholder="Describe the issue in detail..." required></textarea>
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Upload Evidence (Photos/Videos)</label>
                                <div class="border rounded p-3 text-center">
                                    <div id="previewArea" class="d-flex flex-wrap gap-2 mb-3"></div>
                                    <input type="file" id="fileUpload" name="media[]" class="d-none" accept="image/*,video/*" multiple>
                                    <button type="button" class="btn btn-outline-primary" onclick="document.getElementById('fileUpload').click()">
                                        <i class="fas fa-camera me-2"></i>Add Photos/Videos
                                    </button>
                                    <p class="small text-muted mt-2 mb-0">Max 5 files (JPEG, PNG, MP4 up to 10MB each)</p>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between">
                                <a href="index.php" class="btn btn-outline-secondary">
                                    <i class="fas fa-times me-2"></i>Cancel
                                </a>
                                <button type="submit" class="btn btn-warning">
                                    <i class="fas fa-paper-plane me-2"></i>Submit Report
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="mediaPreviewModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content bg-dark text-white">
                <div class="modal-header border-0">
                    <button type="button" class="btn-close btn-close-white ms-auto" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body text-center" id="mediaPreviewContent"></div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('fileUpload').addEventListener('change', function(e) {
            const previewArea = document.getElementById('previewArea');
            previewArea.innerHTML = '';

            if (this.files) {
                Array.from(this.files).forEach(file => {
                    const reader = new FileReader();

                    reader.onload = function(e) {
                        const previewDiv = document.createElement('div');
                        previewDiv.className = 'position-relative';
                        previewDiv.style.width = '100px';
                        previewDiv.style.height = '100px';
                        previewDiv.style.cursor = 'pointer';

                        if (file.type.startsWith('image/')) {
                            previewDiv.innerHTML = `
                                <img src="${e.target.result}" class="img-thumbnail h-100 w-100 object-fit-cover" onclick="previewMedia('image', '${e.target.result}')">
                                <button class="btn btn-danger btn-sm position-absolute top-0 end-0 p-1" onclick="this.parentElement.remove()">
                                    <i class="fas fa-times"></i>
                                </button>
                            `;
                        } else if (file.type.startsWith('video/')) {
                            previewDiv.innerHTML = `
                                <video class="img-thumbnail h-100 w-100 object-fit-cover" muted onclick="previewMedia('video', '${e.target.result}')">
                                    <source src="${e.target.result}" type="${file.type}">
                                </video>
                                <button class="btn btn-danger btn-sm position-absolute top-0 end-0 p-1" onclick="this.parentElement.remove()">
                                    <i class="fas fa-times"></i>
                                </button>
                            `;
                        }

                        previewArea.appendChild(previewDiv);
                    };

                    reader.readAsDataURL(file);
                });
            }
        });

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
                    </video>
                `;
            }

            const modal = new bootstrap.Modal(document.getElementById('mediaPreviewModal'));
            modal.show();
        }

        document.getElementById('fileInput').addEventListener('change', function () {
    const maxFiles = 5;
    const maxFileSize = 10 * 1024 * 1024; // 10MB in bytes
    const files = this.files;
    const errorMsg = document.getElementById('fileError');

    // Clear any previous error message
    errorMsg.textContent = '';

    if (files.length > maxFiles) {
        errorMsg.textContent = `You can only upload up to ${maxFiles} files.`;
        this.value = ''; // Reset file input
        return;
    }

    for (let i = 0; i < files.length; i++) {
        if (files[i].size > maxFileSize) {
            errorMsg.textContent = `Each file must be 10MB or smaller. File "${files[i].name}" is too large.`;
            this.value = ''; // Reset file input
            return;
        }
    }
});
    </script>

    <footer class="bg-light py-4 mt-5 border-top">
        <div class="container text-center text-muted">
            <p class="mb-0">&copy; 2025 FacilityCare. All rights reserved.</p>
        </div>
    </footer>
</body>

</html>
