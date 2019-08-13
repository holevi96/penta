<?php while (have_posts()) : the_post(); ?>
    <article <?php post_class(); ?>>
        <div class="container">
            <table id="jelentkezesek_table">
                <thead>
                <tr>
                    <th>Tanfolyam neve</th>
                    <th>Access kód</th>
                    <th>Időpont</th>
                    <th>Kapcsolattartó neve</th>
                    <th>Ir.szám</th>
                    <th>Város</th>
                    <th>Cím</th>
                    <th>Jelentkező telefonja</th>
                    <th>Jelentkező emailja</th>
                    <th>Egyéb</th>
                    <th>Jelentkezés időpontja</th>
                </tr>
                <?php
                $form_id = '1';
                $entry = GFAPI::get_entries( $form_id );
                //var_dump($entry);
                foreach ($entry as $item) {
                    if($item['is_read'] == 0):
                    ?>
                    <tr>
                        <td><?php echo $item[1]; ?></td>
                        <td><?php echo get_field('access_kod',get_post($item[51])->ID); ?></td>
                        <td><?php echo $item[32]; ?></td>
                        <td><?php echo $item['6.6']; ?></td>
                        <td><?php echo $item[17]; ?></td>
                        <td><?php echo $item[18]; ?></td>
                        <td><?php echo $item[45] . ' ' .   $item[47]?></td>
                        <td><?php echo $item[7]; ?></td>
                        <td><?php echo $item[5]; ?></td>
                        <td><?php echo $item[39]; ?></td>
                        <td><?php echo $item['date_created']; ?></td>

                    </tr>
                <?php endif; }
                ?>
                </thead>
            </table>
            <a id="export_to_csv" href="#"><button>Export to CSV</button></a>
        </div>

        <?php

        ?>
    </article>
<?php endwhile; ?>