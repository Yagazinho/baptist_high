<?php if($app_config['prompt']): ?>
<div class="alert alert-<?= $app_config['promptType'] ?>">
    <div class="d-inline-flex">
        <div>
            <p><?= $app_config['promptMsg'] ?></p>
            <form action="" method="post">
                <button type="submit" name="doPrompt" class="btn btn-sm btn-success">Proceed</button>
                <a href="<?= $pageURL ?>" class="btn btn-sm btn-dark">Cancel</a>
            </form>
        </div>
    </div>
</div>

<?php endif ?>
