<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Show  sliders of blog post in your site with a widget.
 *
 * Intended for use on cms pages. Usage :
 * on a CMS page add:
 *
 *     {widget_area('name_of_area')}
 *
 * 'name_of_area' is the name of the widget area you created in the  admin
 * control panel
 *
 * @author  Kamaro Lambert
 * @author  Huguka Team
 * @package PyroCMS\Core\Modules\Blog\Widgets or PyroCMS\addons\default\Widgets
 */
class Widget_category_slideshow extends Widgets
{

	public $author = 'Kamaro Lambert';

	public $website = 'http://www.huguka.com';

	public $version = '1.0.0';

	public $title = array(
		'en' => 'Slideshow  posts',
		'fr' => 'Slides  articles',
	
	);

	public $description = array(
		'en' => 'Display slideshow of the latest blog posts with a widget from selected category',
		'fr' => 'Permet d\'afficher la liste des derniers posts du blog dans un Widget provenant du categor selectionne',
		
	);

	// build form fields for the backend
	// MUST match the field name declared in the form.php file
	public $fields = array(
		array(
			'field' => 'limit',
			'label' => 'Number of posts',
		),
		array(
					'field' => 'category_id',
					'label' => 'Category Name',
			)
	);
	
	public function __construct()
	{
		// blog_categories models
		class_exists('blog_categories_m') OR $this->load->model('blog/blog_categories_m');
		// load the blog module's model
		class_exists('Blog_m') OR $this->load->model('blog/blog_m');
		//loading blog module language
		$this->lang->load(array('blog/blog', 'blog/categories'));
		
	}
	
  /**
   * @name Form is used to prepare /pass data to the wiget admin form
   * @param unknown_type $options
   * @return multitype:Ambigous <number, unknown> 
   * @method Data returned from this method will be available to view/form.php
   */
	public function form($options)
	{
		/* - load the blog and blog_categories models.*/
		
		if ($categories = $this->blog_categories_m->order_by('title')->get_all())
		{
			foreach ($categories as $category)
			{
				$_categories[$category->id] = $category->title;
			}
		}
		// Get category data
		$options['categories'] =$_categories;
		//Assign the default limit of the posts
		$options['limit'] = ( ! empty($options['limit'])) ? $options['limit'] : 5;

		
		return array(
			'options' => $options
		);
	}

	public function run($options)
	{
		

		// sets default number of posts to be shown
		$options['limit'] = ( ! empty($options['limit'])) ? $options['limit'] : 5;

		// retrieve the records using the blog module's model
		$blog_widget = $this->blog_m
			->limit($options['limit'])
			->where(array('category_id'=>$options['category_id']))
			->get_many_by(array('status' => 'live'));

		//retrieving 4 latest blog post in the datatabase
		//getting the blog items
		$blog_widget = $this->blog_m
		->limit(4)
		->order_by('created_on')
		->get_many_by(array('status' => 'live'));
		$latest_blogs=$this->db->get('blog');
		
		// returns the variables to be used within the widget's view
		return array('blog_widget' => $blog_widget,
				     'latest_blogs'=>$latest_blogs);
	}

}
