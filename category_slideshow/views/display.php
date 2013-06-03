<style>
.carousel-inner > .item img
{
min-width:100%;
max-height:300px;
min-height:300px;
}

</style>

<div class="span7">

			<div id="myCarousel" class="carousel slide">
            <div class="carousel-inner">
     <?php
	require_once 'simple_html_dom.php';
	
     	foreach($blog_widget as $post_widget):
	           $html = new simple_html_dom();
	
	        // Load HTML from a string
        	$html->load('<html><body>'.$post_widget->body.'</body></html>');
		
         	// Find all images
	         foreach($html->find('img') as $element):
                    ?>
              <div class="item">
                <img src="<?php echo $element->src;?>" />
                <div class="carousel-caption">
                  <h4><?php echo $post_widget->title;?></h4>
                  <p><?php echo substr(strip_tags($post_widget->body),0,50) ;?></p>
                </div>
              </div>
            <?php  break;?>
            <?php endforeach;?>
            <?php endforeach;?>
            </div>

            <a class="left carousel-control" href="#myCarousel" data-slide="prev"></a>
            <a class="right carousel-control" href="#myCarousel" data-slide="next"></a>
          </div>
          </div>



