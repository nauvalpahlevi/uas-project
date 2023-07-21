<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tracer Study - Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/login.css">

</head>

<body>
    <div class="container">
        <div class="container d-flex justify-content-center align-items-center vh-100">
            <div class="col-lg-6 col-md-8">
                <div class="card mt-5">
                    <div class="card-body">
                        <h3 class="card-title text-center">Login</h3>
                        <?php if (session()->getFlashdata('error')) : ?>
                            <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
                        <?php endif; ?>
                        <form method="POST" action="<?= base_url('/study/auth') ?>">
                            <div class="form-group">
                                <label for="nis">NIS:</label>
                                <input type="text" class="form-control" id="nis" name="nis" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password:</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="form-group">
                                <label for="role">Role:</label>
                                <select class="form-control" id="role" name="role" required>
                                    <option value="user">User</option>
                                    <option value="admin">Admin</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>