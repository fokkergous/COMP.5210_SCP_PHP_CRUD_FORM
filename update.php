<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Update SCP Record</title>
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
        position: sticky;
        top: 0;
        z-index: 1000;
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
        max-width: 720px;
        margin: 0 auto;
        padding: 32px 20px 48px;
      }

      h1, h2, h3, h4, h5, h6 { color: #ffffff; }
      h1 { font-weight: 700; letter-spacing: 0.05rem; }

      label {
        color: #e0e0e0;
        font-weight: 500;
        margin-bottom: 6px;
        display: block;
        font-size: 0.95rem;
      }

      /* Form inputs */
      .form-control {
        background: rgba(255, 255, 255, 0.06);
        border: 1px solid rgba(255, 255, 255, 0.15);
        border-radius: 8px;
        color: #ffffff;
        padding: 10px 14px;
        transition: border-color 0.25s ease, background 0.25s ease, box-shadow 0.25s ease;
      }

      .form-control:focus {
        background: rgba(255, 255, 255, 0.1);
        border-color: rgba(220, 53, 69, 0.5);
        box-shadow: 0 0 0 3px rgba(220, 53, 69, 0.15);
        color: #ffffff;
        outline: none;
      }

      .form-control::placeholder { color: rgba(255, 255, 255, 0.3); }

      /* Buttons */
      .btn {
        border-radius: 8px;
        font-weight: 600;
        letter-spacing: 0.03rem;
        transition: all 0.25s ease;
        border: none;
      }

      .btn:hover { transform: translateY(-2px); }

      .btn-primary {
        background: linear-gradient(135deg, #dc3545 0%, #b02a37 100%);
        box-shadow: 0 4px 15px rgba(220, 53, 69, 0.3);
        color: #ffffff;
        padding: 10px 28px;
      }

      .btn-primary:hover {
        background: linear-gradient(135deg, #b02a37 0%, #8b1f2a 100%);
        box-shadow: 0 6px 20px rgba(220, 53, 69, 0.4);
        color: #ffffff;
      }

      .btn-dark {
        background: rgba(255, 255, 255, 0.08);
        border: 1px solid rgba(255, 255, 255, 0.15) !important;
        color: #ffffff;
        text-decoration: none;
        padding: 8px 18px;
        font-size: 0.85rem;
      }

      .btn-dark:hover {
        background: rgba(255, 255, 255, 0.14);
        border-color: rgba(255, 255, 255, 0.25) !important;
        color: #ffffff;
      }

      /* Alerts */
      .alert { border-radius: 10px; font-weight: 500; }

      .alert-success {
        background: rgba(25, 135, 84, 0.18);
        border: 1px solid rgba(25, 135, 84, 0.35) !important;
        color: #75b798;
      }

      .alert-danger {
        background: rgba(220, 53, 69, 0.15);
        border: 1px solid rgba(220, 53, 69, 0.3) !important;
        color: #ea868f;
      }

      .scp-form-card {
        background: rgba(255, 255, 255, 0.04);
        border: 1px solid rgba(255, 255, 255, 0.08);
        border-radius: 12px;
        padding: 28px;
        box-shadow: 0 4px 24px rgba(0, 0, 0, 0.4);
      }

      .form-row { margin-bottom: 20px; }

      hr {
        border: none;
        height: 1px;
        background: linear-gradient(90deg, transparent, #555, transparent);
        margin: 24px 0;
      }
    </style>
  </head>
  <body>

    <header class="scp-header">
      <p class="scp-header-title">SCP Foundation</p>
      <div class="scp-header-divider"></div>
      <p class="scp-header-subtitle">Edit Record</p>
      <a href="index.php" class="btn btn-dark ms-auto">&larr; Back To Database</a>
    </header>

    <div class="page-content">

      <?php
        // Enable error reporting
        error_reporting(E_ALL);
        ini_set('display_errors', 1);

        include "connection.php";

        // Setup empty array called $row
        $row = [];

        // Redirected from index page with update get value
        if(isset($_GET['update']))
        {
            $id = $_GET['update'];

            // Retrieve the appropriate SCP record from the table
            $recordID = $connection->prepare("select * from scp where id = ?");

            if(!$recordID)
            {
                echo "<div class='alert alert-danger'>Error retrieving record for editing</div>";
                exit;
            }

            $recordID->bind_param("i", $id);

            if($recordID->execute())
            {
                echo "<div class='alert alert-success'>Record ready for editing</div>";
                $temp = $recordID->get_result();
                $row = $temp->fetch_assoc();
            }
        }

        if(isset($_POST['update']))
        {
            // Prepared statement to save edits from form submission
            $update = $connection->prepare("update scp set subject=?, class=?, description=?, containment=?, image=? where id=?");
            $update->bind_param("sssssi", $_POST['subject'], $_POST['class'], $_POST['description'], $_POST['containment'], $_POST['image'], $_POST['id']);

            if($update->execute())
            {
                echo "<div class='alert alert-success'>SCP Record Updated Successfully</div>";
            }
            else
            {
               echo "<div class='alert alert-danger'>Error: {$update->error}</div>";
            }
        }

      ?>

      <h1 class="mb-4">Update / Edit SCP Record</h1>

      <div class="scp-form-card">
        <form method="post" action="update.php">
          <input type="hidden" name="id" value="<?php echo isset($row['id']) ? $row['id'] : '' ?>">

          <div class="form-row">
            <label>SCP Subject:</label>
            <input type="text" name="subject" class="form-control" value="<?php echo isset($row['subject']) ? htmlspecialchars($row['subject']) : '' ?>">
          </div>

          <div class="form-row">
            <label>Object Class:</label>
            <input type="text" name="class" class="form-control" value="<?php echo isset($row['class']) ? htmlspecialchars($row['class']) : '' ?>">
          </div>

          <hr>

          <div class="form-row">
            <label>Description:</label>
            <textarea name="description" class="form-control" rows="5"><?php echo isset($row['description']) ? htmlspecialchars($row['description']) : '' ?></textarea>
          </div>

          <div class="form-row">
            <label>Containment Procedures:</label>
            <textarea name="containment" class="form-control" rows="5"><?php echo isset($row['containment']) ? htmlspecialchars($row['containment']) : '' ?></textarea>
          </div>

          <hr>

          <div class="form-row">
            <label>Image (URL or file path):</label>
            <input type="text" name="image" class="form-control" value="<?php echo isset($row['image']) ? htmlspecialchars($row['image']) : '' ?>">
          </div>

          <div class="mt-4">
            <input type="submit" name="update" value="Save Changes" class="btn btn-primary">
          </div>
        </form>
      </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  </body>
</html>
