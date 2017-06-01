<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

//$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
//$cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version())
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <title>Khám phá website</title>
    <meta charset="utf-8" />
    <meta name="keywords" content="It, it solution,solution, website,link" />
    <link href="https://plus.google.com/114644939574462223089" rel="author">
    <meta content="IE=edge" http-equiv="X-UA-Compatible"></meta>
    <meta content="width=device-width, initial-scale=1" name="viewport" id="viewport"></meta>
    <meta content="Lấy tất cả website đã tồn tại" name="description">
    <meta content="IE=edge" http-equiv="X-UA-Compatible"></meta>
    <link rel="icon" href="img/fav.png">
    <meta content="width=device-width, initial-scale=1" name="viewport" id="viewport"></meta>
    <meta content="index, follow" name="ROBOTS">

    <link href="https://fonts.googleapis.com/css?family=Roboto:300,500,400,600,700&amp;subset=vietnamese" rel="stylesheet">
<!--    <link rel="stylesheet" type="text/css" href="khamphaweb/vendor/css/font-awesome.min.css">-->
<!--    <link rel="stylesheet" type="text/css" href="khamphaweb/vendor/css/bootstrap.min.css">-->
<!--    <link rel="stylesheet" type="text/css" href="khamphaweb/vendor/css/slick.css">-->
<!--    <link rel="stylesheet" type="text/css" href="khamphaweb/vendor/css/ap8.css">-->
<!--    <link rel="stylesheet" type="text/css" href="khamphaweb/vendor/css/animate.css">-->
<!--    <link rel="stylesheet" type="text/css" href="khamphaweb/css/style.css">-->
    <link rel="stylesheet" type="text/css" href="<?= $this->webroot . 'vendor/css/font-awesome.min.css' ?>">
	<?php
//		echo $this->Html->meta('icon');
//
        echo $this->Html->css('/vendor/css/bootstrap.min');
        echo $this->Html->css('/vendor/css/slick');
        echo $this->Html->css('/vendor/css/slick');
        echo $this->Html->css('/vendor/css/ap8');
        echo $this->Html->css('/vendor/css/animate');
        echo $this->Html->css('style');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
    <script type="text/javascript" src="vendor/js/jquery.2.1.1.min.js"></script>
    <script type="text/javascript" src="vendor/js/bootstrap.min.js"></script>
    <script src="js/custom.js"></script>
    <script src="js/particles.js"></script>
    <script src="js/app.js"></script>

    <script type="text/javascript">
        function load() {
            setTimeout("window.open(self.location, '_self');", 60000);
        }
    </script>

</head>
<body onload="load()">
	<div id="container">
		<div id="content">

			<?php echo $this->Flash->render(); ?>

			<?php echo $this->fetch('content'); ?>
		</div>

	</div>
</body>
</html>
