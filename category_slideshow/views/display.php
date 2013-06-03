<style>
.carousel-inner > .item img
{
width:100%;
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
	               //check if the image is found
	               if( $element->src!=' ' or  $element->src!=NULL):
                    ?>
              <div class="item">
               <a href="<?php echo 'blog/'.date('Y/m', $post_widget->created_on) .'/'.$post_widget->slug;?>">
                <img src="<?php echo $element->src;?>" />
               </a>
                <div class="carousel-caption">
                  <h4><a href="<?php echo 'blog/'.date('Y/m', $post_widget->created_on) .'/'.$post_widget->slug;?>">
                  <?php echo $post_widget->title;?>
                  </a></h4>
                  <p><?php echo substr(strip_tags($post_widget->body),0,50) ;?>
                  <a href="<?php echo 'blog/'.date('Y/m', $post_widget->created_on) .'/'.$post_widget->slug;?>">...
                  </a>
                  </p>
                </div>
              </div>
             <?php endif;?>
            <?php  break;?>
            <?php endforeach;?>
            <?php endforeach;?>
            </div>

            <a class="left carousel-control" href="#myCarousel" data-slide="prev">&lsaquo;</a>
            <a class="right carousel-control" href="#myCarousel" data-slide="next">&rsaquo;</a>
          </div>
          </div>



