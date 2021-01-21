<?php partial_view('dash_header'); ?>

<div class="container-fluid">
    <div class="row">

        <?php partial_view('dash_sidebar'); ?>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Dashboard</h1>
            </div>

            <?php partial_view('notification'); ?>

            <div class="card" style="width: 20rem;">
                <img class="card-img-top" src="/media/profile_photo/<?= $_SESSION['user']['profile_photo']; ?>" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title"><?= $_SESSION['user']['username']; ?></h5>
                    <h6 class="card-subtitle mb-2 text-muted"><?= $_SESSION['user']['email']; ?></h6>
                    <p class="card-text">You can put here your bio or other information.</p>
                    <a href="#" class="btn btn-success">Edit Profile</a>
                    <a href="#" class="btn btn-danger">Delete Profile</a>
                </div>
            </div>
        </main>
    </div>
</div>

<?php partial_view('dash_footer') ?>