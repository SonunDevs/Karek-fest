<?php

if (!defined('ABSPATH')) exit;

?><article class="elfsight-admin-page-error elfsight-admin-page" data-elfsight-admin-page-id="error">
    <h1><?php esc_html_e('Oops, something went wrong', $this->textDomain); ?></h1>

    <p class="elfsight-admin-page-error-message">
        <?php esc_html_e('Unfortunately, there is no such page.', $this->textDomain); ?>
    </p>

    <a class="elfsight-admin-page-error-button elfsight-admin-button-large elfsight-admin-button-green elfsight-admin-button" href="#/widgets/" data-elfsight-admin-page="widgets"><?php esc_html_e('Back to Home', $this->textDomain); ?></a>
</article>