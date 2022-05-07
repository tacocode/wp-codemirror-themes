<select id="<?php echo esc_attr($args['label_for']); ?>" name="codemirror_theme_settings[<?php echo esc_attr($args['label_for']); ?>]">
    <option value="default">Default</option>
    <?php
    if (!empty($themes)) {
        foreach ($themes as $theme) {
            ?>
            <option value="<?php echo $theme; ?>"<?php echo $theme == $selected_theme ? ' selected' : ''; ?>><?php echo $theme; ?></option>
            <?php
        }
    }
    ?>
</select>
<p class="description">
    <?php esc_html_e('Select the CodeMirror theme you want to use with the theme & plugin editor.', 'wp-codemirror-themes'); ?>
</p>

<div class="editor-preview">
    <label for="editorTextarea" style="display:inline-block;margin:12px 0;">Preview:</label>
    <textarea id="editorTextarea" rows="3"><?= file_get_contents(dirname(__DIR__, 1) . "/wp-codemirror-themes.php"); ?></textarea>
</div>
