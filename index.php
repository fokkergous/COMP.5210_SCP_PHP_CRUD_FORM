<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SCP Foundation - Database</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <style>
      @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');

      * { box-sizing: border-box; }

      body {
        margin: 0;
        min-height: 100vh;
        background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 100%);
        color: #ffffff;
        font-family: 'Inter', sans-serif;
      }

      .scp-header {
        background: #000000;
        padding: 14px 24px;
        display: flex;
        align-items: center;
        gap: 16px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        margin-bottom: 0;
        position: sticky;
        top: 0;
        z-index: 1000;
      }

      .btn-dark {
        background: rgba(255, 255, 255, 0.08);
        border: 1px solid rgba(255, 255, 255, 0.15) !important;
        color: #ffffff;
        text-decoration: none;
        padding: 8px 18px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.85rem;
        letter-spacing: 0.03rem;
        transition: all 0.25s ease;
        display: inline-block;
      }

      .btn-dark:hover {
        background: rgba(255, 255, 255, 0.14);
        border-color: rgba(255, 255, 255, 0.25) !important;
        color: #ffffff;
        transform: translateY(-1px);
      }

      .scp-header-title {
        color: #ffffff;
        font-size: 1.15rem;
        font-weight: 700;
        letter-spacing: 0.08rem;
        text-transform: uppercase;
        margin: 0;
      }

      .scp-header-divider {
        width: 2px;
        height: 26px;
        background: rgba(220, 53, 69, 0.65);
        border-radius: 2px;
      }

      .scp-header-subtitle {
        color: #aaaaaa;
        font-size: 0.78rem;
        letter-spacing: 0.14rem;
        text-transform: uppercase;
        margin: 0;
      }

      .page-content {
        max-width: 960px;
        margin: 0 auto;
        padding: 32px 20px 48px;
      }

      h1, h2, h3, h4, h5, h6 { color: #ffffff; }

      h1 { font-weight: 700; letter-spacing: 0.05rem; }
      h2 { font-weight: 600; letter-spacing: 0.05rem; }

      p { color: #e0e0e0; line-height: 1.7; }

      /* Nav pills */
      .nav-pills .nav-link {
        color: #e0e0e0;
        background: rgba(255, 255, 255, 0.05);
        border-radius: 8px;
        font-size: 0.9rem;
        font-weight: 500;
        letter-spacing: 0.03rem;
        transition: background 0.25s ease, color 0.25s ease, transform 0.2s ease;
      }

      .nav-pills .nav-link:hover {
        background: rgba(255, 255, 255, 0.1);
        color: #ffffff;
        transform: translateY(-1px);
      }

      /* Buttons */
      .btn {
        border-radius: 8px;
        font-weight: 600;
        letter-spacing: 0.03rem;
        transition: all 0.25s ease;
        border: none;
      }

      .btn:hover { transform: translateY(-2px); }

      .btn-success {
        background: linear-gradient(135deg, #dc3545 0%, #b02a37 100%);
        box-shadow: 0 4px 15px rgba(220, 53, 69, 0.3);
        color: #ffffff;
      }

      .btn-success:hover {
        background: linear-gradient(135deg, #b02a37 0%, #8b1f2a 100%);
        box-shadow: 0 6px 20px rgba(220, 53, 69, 0.4);
        color: #ffffff;
      }

      .btn-warning {
        background: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2) !important;
        color: #ffffff;
      }

      .btn-warning:hover {
        background: rgba(255, 255, 255, 0.18);
        color: #ffffff;
      }

      .btn-danger {
        background: linear-gradient(135deg, #dc3545, #8b1f2a);
        box-shadow: 0 4px 12px rgba(220, 53, 69, 0.25);
        color: #ffffff;
      }

      .btn-danger:hover {
        background: linear-gradient(135deg, #b02a37, #6a1520);
        box-shadow: 0 6px 16px rgba(220, 53, 69, 0.4);
        color: #ffffff;
      }

      /* Record card */
      .scp-record-card {
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.1) !important;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.4) !important;
        border-radius: 12px !important;
        padding: 24px !important;
      }

      /* Badge */
      .badge.bg-danger {
        background: linear-gradient(135deg, #dc3545, #b02a37) !important;
        font-size: 0.8rem;
        letter-spacing: 0.05rem;
        padding: 5px 10px;
        border-radius: 6px;
      }

      /* Images */
      .img-fluid.rounded {
        border: 1px solid rgba(255, 90, 90, 0.45);
        border-radius: 12px !important;
        background: linear-gradient(145deg, rgba(12, 12, 12, 0.96), rgba(30, 30, 30, 0.9));
        box-shadow: 0 14px 28px rgba(0, 0, 0, 0.38);
        padding: 8px;
        max-width: 520px;
      }

      /* Alerts */
      .alert { border-radius: 10px; font-weight: 500; }

      .alert-success {
        background: rgba(25, 135, 84, 0.18);
        border: 1px solid rgba(25, 135, 84, 0.35) !important;
        color: #75b798;
      }

      .alert-warning {
        background: rgba(255, 193, 7, 0.12);
        border: 1px solid rgba(255, 193, 7, 0.28) !important;
        color: #ffc107;
      }

      .alert-danger {
        background: rgba(220, 53, 69, 0.15);
        border: 1px solid rgba(220, 53, 69, 0.3) !important;
        color: #ea868f;
      }

      hr {
        border: none;
        height: 1px;
        background: linear-gradient(90deg, transparent, #555, transparent);
        margin: 32px 0;
      }
    </style>
  </head>
  <body>

    <header class="scp-header">
      <p class="scp-header-title">SCP Foundation</p>
      <div class="scp-header-divider"></div>
      <p class="scp-header-subtitle">Subject Database</p>
      <a href="index.php" class="btn btn-dark ms-auto">&larr; Back To Database</a>
    </header>

    <div class="page-content">

      <?php include "connection.php"; ?>

      <h1 class="mt-2 mb-3">SCP Foundation Subject Database</h1>

      <!-- Nav menu based on SCP subject -->
      <nav class="mb-4">
          <ul class="nav nav-pills flex-wrap gap-2">
              <?php foreach($result as $link): ?>

              <li class="nav-item">
                  <a href="index.php?link=<?php echo urlencode($link['subject']); ?>" class="nav-link">
                      <?php echo htmlspecialchars($link['subject']); ?>
                  </a>
              </li>

              <?php endforeach; ?>
          </ul>
      </nav>

      <hr>

      <!-- Add new record button -->
      <div class="mb-4">
          <a href="create.php" class="btn btn-success">+ Add New SCP Record</a>
      </div>

      <div>
          <?php

              // Delete record
              if(isset($_GET['delete']))
              {
                  $delID = $_GET['delete'];
                  $delete = $connection->prepare("delete from scp where id=?");
                  $delete->bind_param("i", $delID);

                  if($delete->execute())
                  {
                      echo "<div class='alert alert-warning'>SCP Record Deleted Successfully.</div>";
                  }
                  else
                  {
                      echo "<div class='alert alert-danger'>Error: {$delete->error}</div>";
                  }
              }

              if(isset($_GET['link']))
              {
                  $subject = $_GET['link'];

                  // Prepared statement to retrieve record based on get value
                  $stmt = $connection->prepare("select * from scp where subject = ?");

                  $stmt->bind_param("s", $subject);

                  if($stmt->execute())
                  {
                      $record = $stmt->get_result();
                      $array = $record->fetch_assoc();

                      if($array)
                      {
                          // Update and delete URLs based on record id
                          $update = "update.php?update=" . $array['id'];
                          $delete = "index.php?delete=" . $array['id'];

                          echo "

                              <div class='scp-record-card mb-3'>
                                  <h3>" . htmlspecialchars($array['subject']) . "</h3>
                                  <span class='badge bg-danger mb-3'>" . htmlspecialchars($array['class']) . "</span>";

                          if(!empty($array['image']))
                          {
                              echo "<p class='text-center'><img class='img-fluid rounded mb-2' src='" . htmlspecialchars($array['image']) . "' alt='" . htmlspecialchars($array['subject']) . "'></p>";
                          }

                          echo "
                                  <h5>Description</h5>
                                  <p>" . nl2br(htmlspecialchars($array['description'])) . "</p>
                                  <h5>Containment Procedures</h5>
                                  <p>" . nl2br(htmlspecialchars($array['containment'])) . "</p>
                              </div>
                              <p class='text-center'>
                                  <a href='{$update}' class='btn btn-warning'>Update Record</a>
                                  <a href='{$delete}' class='btn btn-danger' onclick=\"return confirm('Are you sure you want to delete this record?')\">Delete Record</a>
                              </p>

                          ";
                      }
                      else
                      {
                          echo "<p class='alert alert-danger'>No record found.</p>";
                      }
                  }
                  else
                  {
                      echo "<p class='alert alert-danger'>Error retrieving record.</p>";
                  }
              }
              else if(!isset($_GET['delete']))
              {
                  echo "

                      <div class='scp-record-card'>
                          <h2>Welcome to the SCP Foundation Subject Database</h2>
                          <p>Select a subject from the menu above to view its file, or add a new record using the button above.</p>
                          <p><strong>Secure. Contain. Protect.</strong></p>
                      </div>

                  ";
              }

          ?>
      </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  </body>
</html>
