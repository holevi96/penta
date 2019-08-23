	<?php if(get_field('neked_ajanljuk')): ?>
    <section id="neked-ajanljuk">
        <ul class="pnt-container">
            <li class="selected">Neked ajánljuk</li>
            <li>Nem neked ajánljuk</li>
        </ul>
        <div class="pnt-container">
            <div class="pro-contra-wrapper">
                <ul class="pro-contra pro">
                    <?php $pro = get_field('neked_ajanljuk');
                    foreach($pro as $p): ?>
                        <li>
                            <i class="material-icons">done</i>
                            <span><?php echo $p['szoveg']; ?></span>
                        </li>
                    <?php endforeach; ?>
        <?php if(get_field("quiz_gravtiy_form_id")):
            $ID = get_field("quiz_gravtiy_form_id");
            ?>
            <li><a href="/quiz?quiz_id=<?php echo $ID; ?>" class="p-button medium orange">Teszteld a tudásod!</a></li>
        <?php endif; ?>

                </ul>
                <ul class="pro-contra contra">
                    <?php $pro = get_field('nem_neked_ajanljuk');
                    foreach($pro as $p): ?>
                        <li>
                            <i class="material-icons">close</i>
                            <span><?php echo $p['szoveg']; ?></span>
                        </li>
                    <?php endforeach; ?>

                </ul>
            </div>




        </div>

    </section>
<?php endif; ?>