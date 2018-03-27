<div class="wrap">
    <h2>Modules</h2>
    <ol>
        <?php foreach (getEddBkCore()->getModuleConfig()['modules'] as $_module) : ?>
            <li>
                <code><?= $_module->getKey() ?></code>
            </li>
        <?php endforeach; ?>
    </ol>
</div>
