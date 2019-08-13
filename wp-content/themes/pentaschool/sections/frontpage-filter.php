    <div class="course-filter">
        <ul id="pentafilter-napszak">
            <li>Válassz feltételt!</li>
            <li class="pentafilter" termName="tanf">Összes</li>
            <li class="pentafilter" termName="nappali">Nappali</li>
            <li class="pentafilter" termName="esti">Esti</li>
        </ul>
        <ul id="pentafilter-box">
            <li>Válassz kategóriát!</li>
            <li class="pentafilter" termName="tanf">Összes</li>
			 
				<?php
                    $categories = get_categories(array(
                        'orderby' => 'name',
                        'order' => 'ASC'
                    ));

                    foreach ($categories as $category) { if($category->slug != "egyeb"):?>
					<li class="pentafilter" termName="<?php echo $category->slug; ?>"><?php echo $category->name; ?></li>
					<?php endif; } ?>
           
        </ul>

    </div>