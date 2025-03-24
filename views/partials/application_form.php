<form id="application-form" class="regular-form" onsubmit="submitForm('application-form');" method="POST" action="<?= route('/admin/applications') ?>">
    <?php if(array_key_exists('summary', $errors)) : ?>
        <span class="form-response form-response--bad"><?= $show_raw_errors && array_key_exists('raw', $errors) ? $errors['raw'] : $errors['summary'] ?></span>
    <?php endif; ?>
    
    <?php if(!empty($status)) : ?>
        <span class="form-response form-response--ok"><?= $status ?></span>
    <?php endif; ?>

    <div class="form-content">
        <span id="group-signup-error-message" class="error-message"></span>
        
        <div class="form-row">
            <div class="form-section">
                <span class="input-tag"><?= __('form.first_name') ?> <span class="highlight">*</span></span>
                <input type="text" name="first_name" value="<?= old('first_name') ?>" maxlength="50" required>
                <?php if(array_key_exists('first_name', $errors)) : ?>
					<span class="input-error"><?= $errors['first_name'] ?></span>
				<?php endif; ?>
            </div>

            <div class="form-section">
                <span class="input-tag"><?= __('form.last_name') ?> <span class="highlight">*</span></span>
                <input type="text" name="last_name" value="<?= old('last_name') ?>" maxlength="50" required>
                <?php if(array_key_exists('last_name', $errors)) : ?>
					<span class="input-error"><?= $errors['last_name'] ?></span>
				<?php endif; ?>
            </div>
        </div>

        <div class="form-section">
            <span class="input-tag"><?= __('form.email') ?> <span class="highlight">*</span></span>
            <input type="email" name="email" value="<?= old('email') ?>" maxlength="50" required>
            <?php if(array_key_exists('email', $errors)) : ?>
                <span class="input-error"><?= $errors['email'] ?></span>
            <?php endif; ?>
        </div>

        <div class="form-section">
            <span class="input-tag"><?= __('form.prefecture') ?> <span class="highlight">*</span></span>
            <select name="prefecture" required>
                <option disabled selected value><?= __('form.select_prefecture') ?></option>
                <?php foreach(__('prefecture') as $key => $item) : ?>
                    <?php if(old('prefecture') === $key) : ?>
                    
                        <option value="<?= $key ?>" selected><?= $item ?></option>
                        
                    <?php else: ?>
                    
                        <option value="<?= $key ?>"><?= $item ?></option>
                        
                    <?php endif; ?>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-section">
            <span class="input-tag"><?= __('form.city') ?> <span class="highlight">*</span></span>
            <span class="hint"><?= __('form.city_hint') ?></span>
            <input type="text" name="city" value="<?= old('city') ?>" maxlength="50" required>
            <?php if(array_key_exists('city', $errors)) : ?>
                <span class="input-error"><?= $errors['city'] ?></span>
            <?php endif; ?>
        </div>

        <div class="form-section">
            <span class="input-tag"><?= __('form.how_find_website') ?></span>
            <textarea name="question_1" maxlength="500"><?= old('question_1') ?></textarea>
            <?php if(array_key_exists('question_1', $errors)) : ?>
                <span class="input-error"><?= $errors['question_1'] ?></span>
            <?php endif; ?>
        </div>

        <div class="form-section">
            <span class="input-tag"><?= __('form.introduce_yourself') ?> <span class="highlight">*</span></span>
            <span class="hint"><?= __('form.introduce_yourself_hint') ?></span>
            <textarea name="question_2" maxlength="500" required><?= old('question_2') ?></textarea>
            <?php if(array_key_exists('question_2', $errors)) : ?>
                <span class="input-error"><?= $errors['question_2'] ?></span>
            <?php endif; ?>
        </div>

        <div class="form-section">
            <span class="input-tag"><?= __('form.outreach_experience') ?> <span class="highlight">*</span></span>
            <span class="hint"><?= __('form.outreach_experience_hint') ?></span>
            <textarea name="question_3" maxlength="500" required><?= old('question_3') ?></textarea>
            <?php if(array_key_exists('question_3', $errors)) : ?>
                <span class="input-error"><?= $errors['question_3'] ?></span>
            <?php endif; ?>
        </div>
        
        <div class="form-section">
            <button id="new-group-submit" class="btn cta-btn" type="submit">
                <span class="btn-value"><?= __('button.send') ?></span>
                <span class="btn-spinner"><i class="fa fa-refresh fa-spin"></i></span>
            </button>
            <div class="privacy-disclaimer"><?= insertLinks(__('global.newsletter_privacy'), route('/privacy')) ?></div>
        </div>
    </div>
</form>