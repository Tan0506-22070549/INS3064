<?php
include "connection.php";

$id = $_GET["id"] ?? null;
$deleted = false;

if ($id && isset($_GET["confirm"]) && $_GET["confirm"] === "yes") {
    $delete_query = "DELETE FROM table1 WHERE id='$id'";
    if (mysqli_query($link, $delete_query)) {
        $deleted = true;
    } else {
        die(mysqli_error($link));
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Delete Confirmation</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
body {
    font-family: 'Inter', 'Segoe UI', sans-serif;
    background: linear-gradient(135deg, #ecf0f3, #e5ebf0);
    height: 100vh; display:flex; justify-content:center; align-items:center;
    margin:0; overflow:hidden; transition: background 0.8s ease;
}
body.success-bg { /* xanh lá khi redirect */
    background: linear-gradient(135deg, #00b09b, #96c93d);
}
.overlay {
    position: fixed; inset: 0;
    background: rgba(0,0,0,0.45);
    backdrop-filter: blur(6px);
    animation: fadeIn 0.4s ease-in;
}
.modal-box, .success-box {
    background: rgba(255,255,255,0.85);
    backdrop-filter: blur(15px);
    border-radius: 22px;
    padding: 50px 40px; width: 420px; text-align:center;
    box-shadow: 0 12px 30px rgba(0,0,0,0.15);
    animation: scaleIn 0.4s ease-out; transform-origin: center;
}
.icon { font-size: 70px; color:#e74c3c; margin-bottom:20px; animation:pulse 1.5s infinite; }
h3 { font-weight:600; color:#2c3e50; margin-bottom:10px; }
p { color:#555; }

/* Buttons */
.btn { min-width:120px; border-radius:12px; font-weight:500; padding:10px 0; transition:0.3s ease; }
.btn-yes { background: linear-gradient(135deg,#00b09b,#96c93d); color:#fff; }
.btn-yes:hover { filter:brightness(1.1); transform:scale(1.05); box-shadow:0 0 12px rgba(0,176,155,0.4); }
.btn-no  { background: linear-gradient(135deg,#f85032,#e73827); color:#fff; }
.btn-no:hover  { filter:brightness(1.1); transform:scale(1.05); box-shadow:0 0 12px rgba(232,56,39,0.4); }

/* Success visual: spinner circle + drawing circle + check */
.success-box { background: rgba(0,0,0,0.15); border: 1px solid rgba(255,255,255,0.2); }
.success-svg { width: 110px; height:110px; display:block; margin:0 auto 20px; }
.spinner { /* vòng tròn xoay quanh dấu tick */
    transform-origin: 50% 50%;
    animation: spin 1.2s linear infinite;
    opacity: 0.9;
}
.spinner-circle {
    stroke: rgba(255,255,255,0.85);
    stroke-width: 3;
    fill: none;
    stroke-linecap: round;
    stroke-dasharray: 120 40; /* tạo gap để nhìn rõ hiệu ứng xoay */
}
.circle { /* vòng tròn vẽ dần */
    stroke-dasharray: 166; stroke-dashoffset:166;
    stroke-width: 2; stroke-miterlimit:10;
    stroke: #ffffff; fill:none;
    animation: stroke 0.6s ease-out forwards;
}
.check { /* dấu tick vẽ dần */
    stroke-dasharray: 48; stroke-dashoffset:48;
    stroke-width: 3; stroke: #ffffff; fill:none;
    animation: stroke 0.4s ease-out 0.6s forwards;
}

/* Animations */
@keyframes fadeIn { from {opacity:0;} to {opacity:1;} }
@keyframes scaleIn { 0%{ transform:scale(0.8); opacity:0;} 100%{ transform:scale(1); opacity:1;} }
@keyframes pulse { 0%,100%{transform:scale(1);opacity:1;} 50%{transform:scale(1.08);opacity:0.85;} }
@keyframes stroke { 100% { stroke-dashoffset: 0; } }
@keyframes spin { 100% { transform: rotate(360deg); } }
</style>
</head>
<body class="<?php echo $deleted ? 'success-bg' : ''; ?>">

<?php if (!$deleted): ?>
<div class="overlay">
  <div class="modal-box mx-auto">
      <div class="icon">⚠️</div>
      <h3>Confirm Deletion</h3>
      <p>Are you sure you want to delete item <strong>#<?php echo htmlspecialchars($id); ?></strong>?</p>
      <div class="mt-4">
          <a href="delete.php?id=<?php echo $id; ?>&confirm=yes" class="btn btn-yes me-3">Yes</a>
          <a href="index.php" class="btn btn-no">No</a>
      </div>
  </div>
</div>

<?php else: ?>
<div class="overlay">
  <div class="success-box mx-auto">
      <svg class="success-svg" viewBox="0 0 52 52">
          <!-- vòng tròn xoay ngoài -->
          <g class="spinner">
              <circle class="spinner-circle" cx="26" cy="26" r="25"/>
          </g>
          <!-- vòng tròn vẽ dần -->
          <circle class="circle" cx="26" cy="26" r="25"/>
          <!-- dấu tick -->
          <path class="check" d="M14 27l7 7 16-16"/>
      </svg>
      <h3 style="color:#ffffff;">Deleted Successfully</h3>
      <p style="color:#ffffff;">Item #<?php echo htmlspecialchars($id); ?> has been removed.</p>
      <p class="mt-3" style="color:rgba(255,255,255,0.9)">Redirecting to home page...</p>
  </div>
</div>

<script>
  document.body.classList.add('success-bg'); // xanh lá khi redirect
  setTimeout(()=>{ window.location.href="index.php"; }, 2500);
</script>
<?php endif; ?>

</body>
</html>
