<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <title>User Login and Registration</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
        crossorigin="anonymous" />
  <link rel="stylesheet" href="style.css" />
</head>

<body>
  <div class="container mt-5">
    <div class="login-box border p-4 rounded shadow-sm bg-light">
      <div class="row">
        <!-- LOGIN FORM -->
        <div class="col-md-6">
          <h2 class="mb-3">Login</h2>
          <form action="validation.php" method="post">
            <div class="form-group">
              <label for="login_user">Username</label>
              <input type="text" id="login_user" name="user" class="form-control" required />
            </div>

            <div class="form-group">
              <label for="login_password">Password</label>
              <input type="password" id="login_password" name="password" class="form-control" required />
            </div>

            <button type="submit" class="btn btn-primary w-100">Login</button>
          </form>
        </div>

        <!-- REGISTRATION FORM -->
        <div class="col-md-6">
          <h2 class="mb-3">Register</h2>
          <form action="registration.php" method="post">
            <div class="form-group">
              <label for="reg_user">Username</label>
              <input type="text" id="reg_user" name="user" class="form-control" required />
            </div>

            <div class="form-group">
              <label for="reg_password">Password</label>
              <input type="password" id="reg_password" name="password" class="form-control" required />
            </div>

            <button type="submit" class="btn btn-success w-100">Register</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
