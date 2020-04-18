<?php
if (!defined('FW'))
    die('Forbidden');

/**
 * @var array $option
 * @var array $data
 * @var string $id
 * @var array $set
 */
$wrapper_attr = array(
    'class' => $option['attr']['class'],
    'id' => $option['attr']['id'],
);
unset($option['attr']['class'], $option['attr']['id']);

$icons = &$set['icons'];

// build $groups array based on $icons
$groups = array();
foreach ($icons as $icon_tab) {
    $group_id = $icon_tab['group'];
    $groups[$group_id] = $set['groups'][$group_id];
}

ksort($icons);
ksort($groups);
?>
<div <?php echo fw_attr_to_html($wrapper_attr) ?>>

    <input <?php echo fw_attr_to_html($option['attr']) ?> type="hidden" />

    <div class="js-option-type-new-icon-container">

        <?php if (count($groups) > 1): ?>
            <div class="fw-backend-option-fixed-width">
                <select class="js-option-type-new-icon-dropdown">
                    <?php
                    echo fw_html_tag('option', array('value' => 'all'), htmlspecialchars(esc_html__('All Categories', 'exhibz')));
                    foreach ($groups as $group_id => $group_title) {
                        $selected = (isset($set['icons'][$data['value']]['group']) && $set['icons'][$data['value']]['group'] === $group_id);
                        echo fw_html_tag('option', array('value' => $group_id, 'selected' => $selected), htmlspecialchars($group_title));
                    }
                    ?>
                </select>
                <div class="fw-icon-search-holder">
                    <input type="text" class="fw-icon-search" placeholder="<?php esc_attr_e('icon search','exhibz');?>">
                    <div class="fw-current-icon"><i class="fw-show-current"></i></div>
                </div>
            </div>
        <?php endif; ?>

        <div class="option-type-new-icon-list js-option-type-new-icon-list <?php echo esc_attr($set['container-class']) ?>">
            <?php
            foreach ($icons as $icon_id => $icon_tab) {
                $active = ($data['value'] == $icon_id) ? 'active' : '';
                echo fw_html_tag('i', array(
                    'class' => "$icon_id js-option-type-new-icon-item $active",
                    'data-value' => $icon_id,
                    'data-group' => $icon_tab['group']
                        ), true);
            }
            ?>
        </div>

    </div>

</div>