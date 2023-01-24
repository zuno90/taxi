<div class="box-card author-box">
<div><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>"><img width="150" height="150" class="lazyload" <?php global $fox_options; if(isset($fox_options['speed1']) && isset($fox_options['speed2'])){echo 'src="'.get_template_directory_uri().'/images/anh-dai-dien.png" data-';} ?>src="<?php echo esc_url( get_avatar_url( get_the_author_meta( 'ID' ), ['size' => '150'])); ?>" /></a></div>
<?php if(!empty(get_the_author_meta('first_name')) || !empty(get_the_author_meta('last_name'))){ ?>
<div class="author-name"><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>"><?php echo get_the_author_meta('last_name') .' '. get_the_author_meta('first_name'); ?></a></div>
<?php } ?>
<?php if(!empty(get_the_author_meta('slogan'))) {echo '<div class="author-slogan">' . get_the_author_meta('slogan') .'</div>';} ?>
<?php 
if(!empty(get_the_author_meta('description'))){ ?>
<div>
<?php the_author_meta( 'description'); ?>
</div>
<?php } 
if(!empty(get_the_author_meta( 'facebook')) || !empty(get_the_author_meta( 'twitter')) || !empty(get_the_author_meta( 'tiktok')) || !empty(get_the_author_meta( 'zalo')) || !empty(get_the_author_meta( 'phone')) || !empty(get_the_author_meta( 'telegram'))){ ?>
<div class="author-icon">
<?php if(!empty(get_the_author_meta( 'facebook'))){ ?><button title="Facebook" onclick="window.open('https://facebook.com/<?php the_author_meta( 'facebook'); ?>','_blank')"><i class="fa-brands fa-facebook"></i></button><?php } ?>
<?php if(!empty(get_the_author_meta( 'twitter'))){ ?><button title="Twiiter" onclick="window.open('https://twitter.com/<?php the_author_meta( 'twitter'); ?>','_blank')"><i class="fa-brands fa-twitter"></i></button><?php } ?>
<?php if(!empty(get_the_author_meta( 'telegram'))){ ?><button title="Telegram" onclick="window.open('https://telegram.me/<?php the_author_meta( 'telegram'); ?>','_blank')"><i class="fa-brands fa-telegram"></i></button><?php } ?>
<?php if(!empty(get_the_author_meta( 'tiktok'))){ ?><button title="Tiktok" onclick="window.open('https://tiktok.com/@<?php the_author_meta( 'tiktok'); ?>','_blank')"><i class="fa-brands fa-tiktok"></i></button><?php } ?>
<?php if(!empty(get_the_author_meta( 'zalo')) && get_locale() == 'vi' ){ ?><button title="Zalo" onclick="window.open('https://zalo.me/<?php the_author_meta( 'zalo'); ?>','_blank')"><i class="fa-solid fa-message-dots"></i></button><?php } ?>
<?php if(!empty(get_the_author_meta( 'phone'))){ ?><button title="Phone" onclick='window.location.href = "tel:<?php the_author_meta( 'phone'); ?>"'><i class="fa-solid fa-circle-phone"></i></button><?php } ?>
</div>
<?php } ?>
</div>
