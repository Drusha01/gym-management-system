<?php require_once '../includes/header.php'; ?>

<body>
<section class="header">
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" style="background-color: #A73535">
        <div class="container-fluid">
            <div class="d-flex flex-row">
                <a class="navbar-brand navbar" href="#">
                    <img src="../../images/logo.png" alt="" width="55">
                    <div class="d-flex flex-column p-2 pt-0 pb-0">
                    <h3 class="mb-1 fs-5 text-white"><strong>KE-NO</strong></h3>
                    <h6 class="mb-1 fs-10 text-white">Fitness Center</h6>
                    </div>
                </a>
                </div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="nav navbar-nav me-auto mb-2 mb-lg-0">
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li class="nav-item">
                        <button class="nav-link active text-white" aria-current="page"  data-bs-toggle="modal" data-bs-target="#exampleModal"><span class='bx bx-exit align-middle fs-4 pe-2'></span>Exit</button>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</section>
attendance

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Confirm Exit</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <div class="form-floating mb-3">
        <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
        <label for="floatingInput">Email address</label>
        </div>
        <div class="form-floating">
        <input type="password" class="form-control" id="floatingPassword" placeholder="Password">
        <label for="floatingPassword">Password</label>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <a type="button" class="btn btn-success" href="../admin_control_log_in.php">Confirm Exit</a>
      </div>
    </div>
  </div>
</div>



</body>
</html>