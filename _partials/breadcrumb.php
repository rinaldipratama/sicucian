<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<h1>
    <?=$content_title;?>
    <small>
        <?=$content_title2;?>
    </small>
</h1>

<ol class="breadcrumb">
	<?php foreach ($this->uri->segments as $segment): ?>
        <?php 
        $url = substr($this->uri->uri_string, 0, strpos($this->uri->uri_string, $segment)) . $segment;
        $is_active =  $url == $this->uri->uri_string;
        ?>
    
    <li class="breadcrumb-item <?=$is_active ? 'active': '' ?>">
        <?php if($is_active): ?>
            <?=ucfirst($segment);?>
                <?php else: ?>
        <a href="<?=site_url($url);?>"><?=ucfirst($segment);?></a>
            <?php endif; ?>
    </li>
        <?php endforeach; ?>
</ol>