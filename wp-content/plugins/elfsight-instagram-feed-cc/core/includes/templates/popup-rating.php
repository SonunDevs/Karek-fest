<?php

if (!defined('ABSPATH')) exit;

$productReviewLink = '<a href="'.$this->productReviewUrl.'" target="_blank" rel="nofollow">CodeCanyon</a>';
$facebookReviewLink = '<a href="https://www.facebook.com/pg/elfsight/reviews/" target="_blank" rel="nofollow">Facebook</a>';

?><div class="elfsight-admin-popup elfsight-admin-popup-rating" data-elfsight-admin-popup-id="rating">
    <div class="elfsight-admin-popup-inner">
        <form class="elfsight-admin-popup-form" data-nonce="<?php echo wp_create_nonce($this->getOptionName('rating_send')); ?>">
            <div class="elfsight-admin-popup-body">
                <div class="elfsight-admin-popup-title"><?php /* translators: %s: Plugin Name */ printf(esc_html__('Enjoying %s Plugin?', $this->textDomain), $this->pluginName); ?></div>
                <div class="elfsight-admin-popup-subtitle"><?php esc_html_e('Click a star to rate us', $this->textDomain); ?></div>

                <fieldset class="elfsight-admin-popup-stars">
                    <input type="radio" id="elfsight-admin-popup-rating-stars-star5" name="rating-popup" value="5"/>
                    <label class=""    for="elfsight-admin-popup-rating-stars-star5" title="5 <?php esc_html_e('stars', $this->textDomain); ?>"></label>

                    <input type="radio" id="elfsight-admin-popup-rating-stars-star4" name="rating-popup" value="4"/>
                    <label class=""    for="elfsight-admin-popup-rating-stars-star4" title="4 <?php esc_html_e('stars', $this->textDomain); ?>"></label>

                    <input type="radio" id="elfsight-admin-popup-rating-stars-star3" name="rating-popup" value="3"/>
                    <label class=""    for="elfsight-admin-popup-rating-stars-star3" title="3 <?php esc_html_e('stars', $this->textDomain); ?>"></label>

                    <input type="radio" id="elfsight-admin-popup-rating-stars-star2" name="rating-popup" value="2"/>
                    <label class=""    for="elfsight-admin-popup-rating-stars-star2" title="2 <?php esc_html_e('stars', $this->textDomain); ?>"></label>

                    <input type="radio" id="elfsight-admin-popup-rating-stars-star1" name="rating-popup" value="1"/>
                    <label class=""    for="elfsight-admin-popup-rating-stars-star1" title="1 <?php esc_html_e('star', $this->textDomain); ?> "></label>
                </fieldset>
                <div class="elfsight-admin-popup-textarea elfsight-admin-popup-textarea-hide">
                    <label for="elfsight-admin-popup-rating-textarea"><?php esc_html_e('Please, let us know how we can improve our plugin', $this->textDomain); ?></label>
                    <textarea id="elfsight-admin-popup-rating-textarea" name="message"></textarea>
                </div>
                <div class="elfsight-admin-popup-text elfsight-admin-popup-text-hide">
                    <span class="elfsight-admin-popup-activated"><?php /* translators: %s: product review link */ printf(esc_html__('Please, share this rating on %s', $this->textDomain), $productReviewLink); ?></span>
                    <span class="elfsight-admin-popup-deactivated"><?php /* translators: %s: facebook review link */ printf(esc_html__('Please, share this recommendation on %s', $this->textDomain), $facebookReviewLink); ?></span>
                </div>
            </div>

            <div class="elfsight-admin-popup-thanks">
                <div class="elfsight-admin-popup-title"><?php esc_html_e('Thanks for helping us improve!', $this->textDomain); ?></div>
                <div class="elfsight-admin-popup-subtitle"><?php esc_html_e('Your feedback is very important for us!', $this->textDomain); ?> ❤</div>
                <div class="elfsight-admin-popup-text elfsight-admin-popup-text-hide">
                    <span class="elfsight-admin-popup-activated"><?php
                        printf(
                            /* translators: %1$s: br, %2$s: product review link */
                            esc_html__('We are very grateful %1$s for your awesome review on %2$s', $this->textDomain),
                            '<br>', $productReviewLink
                        );
                    ?></span>
                    <span class="elfsight-admin-popup-deactivated"><?php
                        printf(
                            /* translators: %1$s: br, %2$s: facebook review link */
                            esc_html__('We are very grateful %1$s for your awesome recommendation on %2$s', $this->textDomain),
                            '<br>', $facebookReviewLink
                        );
                    ?></span>
                </div>
            </div>

            <div class="elfsight-admin-popup-footer">
                <a class="elfsight-admin-popup-footer-button elfsight-admin-popup-footer-button-close"><?php esc_html_e('No, thanks', $this->textDomain); ?></a>
                <a class="elfsight-admin-popup-activated elfsight-admin-popup-footer-button elfsight-admin-popup-footer-button-ok elfsight-admin-popup-footer-button-hide" href="<?php echo esc_html($this->productReviewUrl); ?>" target="_blank" rel="nofollow"><?php esc_html_e('Rate us', $this->textDomain); ?></a>
                <a class="elfsight-admin-popup-deactivated elfsight-admin-popup-footer-button elfsight-admin-popup-footer-button-ok elfsight-admin-popup-footer-button-hide" href="https://www.facebook.com/pg/elfsight/reviews/" target="_blank" rel="nofollow"><?php esc_html_e('Rate us', $this->textDomain); ?></a>
            </div>
        </form>
    </div>

    <div class="elfsight-admin-popup-loader elfsight-admin-loader"></div>
    <div class="elfsight-admin-popup-overlay"></div>
</div>
