<?php
global $fox_options;
                    if(isset($fox_options['theme']) && $fox_options['theme'] == 'Toplist') :
					get_template_part( 'template-parts/home');
					elseif (isset($fox_options['theme']) && $fox_options['theme'] == 'Blog') :
					get_template_part( 'template-parts/home-grid');
					elseif (isset($fox_options['theme']) && $fox_options['theme'] == 'Some') :
					get_template_part( 'template-parts/home-some');
					elseif (isset($fox_options['theme']) && $fox_options['theme'] == 'New') :
					get_template_part( 'template-parts/home-new');
					elseif (isset($fox_options['theme']) && $fox_options['theme'] == 'Time') :
					get_template_part( 'template-parts/home-time');
					elseif (isset($fox_options['theme']) && $fox_options['theme'] == 'Text') :
					get_template_part( 'template-parts/home-text');
					elseif (isset($fox_options['theme']) && $fox_options['theme'] == 'Fox') :
					get_template_part( 'template-parts/home-fox');
					elseif (isset($fox_options['theme']) && $fox_options['theme'] == 'Images') :
					get_template_part( 'template-parts/home-images');
					elseif (isset($fox_options['theme']) && $fox_options['theme'] == 'Story') :
					get_template_part( 'template-parts/home-story');
					elseif (isset($fox_options['theme']) && $fox_options['theme'] == 'Comic') :
					get_template_part( 'template-parts/home-comic');
					elseif (isset($fox_options['theme']) && $fox_options['theme'] == 'Land') :
					get_template_part( 'template-parts/home-land');
					elseif (isset($fox_options['theme']) && $fox_options['theme'] == 'Shop') :
					get_template_part( 'template-parts/home-shop');
					elseif (isset($fox_options['theme']) && $fox_options['theme'] == 'Codex') :
					get_template_part( 'template-parts/home-codex');
					elseif (isset($fox_options['theme']) && $fox_options['theme'] == 'Youtube') :
					get_template_part( 'template-parts/home-youtube');
					else :
					get_template_part( 'template-parts/home');
					endif;
