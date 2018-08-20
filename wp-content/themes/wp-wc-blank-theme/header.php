<!DOCTYPE HTML>
<html lang="en-US">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="John Ericta">
    <title><?php echo esc_html( get_bloginfo( 'name' ) ); ?> <?php echo " | "; the_title() ; ?></title>
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <?php wp_head(); ?>
  </head>
  <body <?php body_class();?>>
    <div id="wrapper">