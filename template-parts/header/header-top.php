<?php
/**
 * Top Header
 *
 * @package WordFlex
 * @subpackage Header
 * @since 1.0
 * @version 1.0
 */

?>
<!-- Strat top Header -->
<div class="top-header" itemscope itemtype="http://schema.org/Organization">
    <div class="container">
        <div class="d-flex flex-column flex-md-row small">
            <?php if( _wf_get_option('opt-header-quick-contacts') ) _wf_header_contacts(); ?>
            <?php  if( _wf_get_option('opt-header-quick-socials') ) _wf_header_socials(); ?>
        </div>
    </div>
</div>
<!-- End top Header -->