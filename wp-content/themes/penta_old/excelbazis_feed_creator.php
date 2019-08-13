<!--Excel bazis widget box START-->
<?php $content = '';
$content .= '<div style="margin-top: 20px" class="box_side excelbazis_box">
            <h2>Excel-bázis</h2>
            <div class="box_body" style="padding: 5px 10px">';





            $feed = file_get_contents("http://www.excel-bazis.hu/tutorial/feed");
            $xml = simplexml_load_string($feed);
            $items = $xml->channel->item;
            $itemarray = array();
            foreach ($items as $item) {
                $add_array = array('title' => (string)$item->title, 'link' => (string)$item->link);
                $itemarray[] = $add_array;
            }






        foreach ($itemarray as $item) :
            $link = $item['link'];
            $title = $item['title'];
            $encode =  mb_detect_encoding($title);
            $title = mb_convert_encoding($title,'ISO-8859-2',$encode);
            $if_tutorial = strpos($link,'tutorial');
            if($if_tutorial != false){

              $content .=  '<a href="' . $link .'" target="_blank">' .  $title . '</a>';

             }

         endforeach;


    $content .= '</div>

</div>';
//EXcelbazis widget box V?GE

file_put_contents('excelbazis_feed_html.txt',$content,0);
echo $content;