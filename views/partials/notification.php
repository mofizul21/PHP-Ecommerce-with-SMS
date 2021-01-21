<?php if (!empty($_SESSION['errors'])) : ?>
    <div class="alert alert-warning" style="width: 20rem;">
        <ul>
            <?php foreach ($_SESSION['errors'] as $error) : ?>
                <li><?= $error; ?></li>
            <?php endforeach; ?>
        </ul>
        <?php unset($_SESSION['errors']); ?>
    </div>
<?php endif; ?>

<?php if (isset($_SESSION['success'])) : ?>
    <div class="alert alert-success" style="width: 20rem;">
        <p><?php echo $_SESSION['success']; ?></p>
    </div>
    <?php unset($_SESSION['success']); ?>
<?php endif; ?>