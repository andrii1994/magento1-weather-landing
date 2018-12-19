<?php

$cmsPages = array(
    array(
        'title'         => 'Landing CMS Page 1',
        'root_template' => 'empty',
        'meta_keywords' => 'Page keywords',
        'meta_description' => 'Page description',
        'identifier'    => 'landing-cms-page-1',
        'content'       => "
<div class=\"jumbotron\">
      <div class=\"container\">
        <h1>Hello, world!</h1>
        <p>This is a template for a simple marketing or informational website. It includes a large callout called a jumbotron and three supporting pieces of content. Use it as a starting point to create something more unique.</p>
        <p><a class=\"btn btn-primary btn-lg\" href=\"#\" role=\"button\">Learn more »</a></p>
      </div>
    </div>
    <div class=\"row\">
        <div class=\"col-md-4\">
          <h2>Heading</h2>
          <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
          <p><a class=\"btn btn-default\" href=\"#\" role=\"button\">View details »</a></p>
        </div>
        <div class=\"col-md-4\">
          <h2>Heading</h2>
          <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
          <p><a class=\"btn btn-default\" href=\"#\" role=\"button\">View details »</a></p>
       </div>
        <div class=\"col-md-4\">
          <h2>Heading</h2>
          <p>Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>
          <p><a class=\"btn btn-default\" href=\"#\" role=\"button\">View details »</a></p>
        </div>
      </div>
",
        'is_active'     => 1,
        'stores'        => array(0),
        'sort_order'    => 0
    ),
    array(
        'title'         => 'Landing CMS Page 2',
        'root_template' => 'empty',
        'meta_keywords' => 'Page keywords',
        'meta_description' => 'Page description',
        'identifier'    => 'landing-cms-page-2',
        'content'       => "
<div class=\"jumbotron\">
        <h1>Marketing stuff!</h1>
        <p class=\"lead\">Cras justo odio, dapibus ac facilisis in, egestas eget quam. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet.</p>
        <p><a class=\"btn btn-lg btn-success\" href=\"#\" role=\"button\">Get started today</a></p>
      </div>
      <div class=\"row\">
        <div class=\"col-lg-4\">
          <h2>Safari bug warning!</h2>
          <p class=\"text-danger\">As of v9.1.2, Safari exhibits a bug in which resizing your browser horizontally causes rendering errors in the justified nav that are cleared upon refreshing.</p>
          <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
          <p><a class=\"btn btn-primary\" href=\"#\" role=\"button\">View details »</a></p>
        </div>
        <div class=\"col-lg-4\">
          <h2>Heading</h2>
          <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
          <p><a class=\"btn btn-primary\" href=\"#\" role=\"button\">View details »</a></p>
       </div>
        <div class=\"col-lg-4\">
          <h2>Heading</h2>
          <p>Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa.</p>
          <p><a class=\"btn btn-primary\" href=\"#\" role=\"button\">View details »</a></p>
        </div>
      </div>
",
        'is_active'     => 1,
        'stores'        => array(0),
        'sort_order'    => 0
    ),
);

/**
 * Insert default landing pages
 */
foreach ($cmsPages as $data) {
    Mage::getModel('cms/page')->setData($data)->save();
}
