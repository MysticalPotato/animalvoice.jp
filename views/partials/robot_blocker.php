<?php
    /*
    * Sets the form start time for time validation.
    * Adds a honeypot with fake field "website".
    * Has the option for adding a captcha (set $enable_captcha to true in the controller to enable).
    * 
    * Added to:
    * - views/contact.view.php
    * - views/partials/newsletter_form.php
    * - views/partials/application_form.php
    */

    $_SESSION['form_start'] = time();
?>

<div style="display:none;">
    <label for="website">Website:</label>
    <input name="website">
</div>

<?php if (isset($enable_captcha) && $enable_captcha): ?>
    <div class="form-section">
        <label for="captcha">Enter CAPTCHA:</label><br>
        <img src="<?= route('/captcha') ?>" alt="CAPTCHA"><br>
        <input name="captcha" required>
    </div>
<?php endif; ?>