<!-- profile.html -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>My Profile | Maintenance System</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet"/>
</head>
<body>
<nav class="navbar navbar-light bg-white shadow-sm">
  <div class="container">
    <a class="navbar-brand fw-bold" href="dashboard.html"><i class="fas fa-tools text-warning me-2"></i>MaintenanceSys</a>
  </div>
</nav>

<section class="py-5">
  <div class="container">
    <h3 class="fw-bold mb-4">My Profile</h3>

    <form>
      <div class="mb-3">
        <label for="fullName" class="form-label">Full Name</label>
        <input type="text" class="form-control" id="fullName" value="Roslan Zulkifli" required>
      </div>

      <div class="mb-3">
        <label for="email" class="form-label">Email Address</label>
        <input type="email" class="form-control" id="email" value="RoslanZulkifli@example.com" required>
      </div>

      <div class="mb-3">
        <label for="phone" class="form-label">Phone Number</label>
        <input type="text" class="form-control" id="phone" value="012-3456789">
      </div>

      <div class="mb-3">
        <label for="password" class="form-label">Change Password</label>
        <input type="password" class="form-control" id="password" placeholder="Leave blank to keep current password">
      </div>

      <button type="submit" class="btn btn-success">Save Changes</button>
    </form>
  </div>
</section>
</body>
</html>
