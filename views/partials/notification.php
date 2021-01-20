<?php if (!empty($_SESSION['errors'])) : ?>
    <div class="alert alert-warning">
        <?php if (count($_SESSION['errors']) === 1) { ?>
            <p><?= $_SESSION['errors'][0]; ?></p>
        <?php } else { ?>
            <ul>
                <?php foreach ($_SESSION['errors'] as $error) : ?>
                    <li><?= $error; ?></li>
                <?php endforeach; ?>
            </ul>
        <?php } ?>
    </div>
    <?php unset($_SESSION['errors']); ?>
<?php endif; ?>

<?php if (isset($_SESSION['success'])) : ?>
    <div class="alert alert-success">
        <p><?php echo $_SESSION['success']; ?></p>
    </div>
    <?php unset($_SESSION['success']); ?>
<?php endif; ?>