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
                        <h2 class="text-center mb-4">Tracer Study</h2>
                        <form action="#" method="POST">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="d-grid">
                                <!-- <button type="submit" class="btn btn-primary mb-2">Login</button> -->
                                <a type="submit" class="btn btn-primary mb-2" href="<?php echo base_url("study/dashboard"); ?>">Login</a>
                                <a type="submit" class="btn btn-secondary" href="<?php echo base_url("study/home"); ?>">Back</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>