<div class="wrap">
    <h1><?= esc_html(get_admin_page_title()); ?></h1>
    <form action="options.php" method="post">
        <?php
        settings_fields('codemirror_theme');
        do_settings_sections('codemirror_theme');
        submit_button('Save Settings');
        ?>
    </form>
</div>