<!DOCTYPE html>
<html lang="ru">
<?= $header ?>
<!--[if lte IE 9]><style>#wrapper{display:none;}</style><p class="text-center text-danger h1">Вы используете <strong>устаревшую</strong> версию браузера. Пожалуйста <a href="http://browsehappy.com/">обновите свой браузер</a>.</p><![endif]-->

<body>
	<div id="wrapper">
		<div id="content">
			<header id="header">
				<div class="container">
					<nav class="navbar">
						<ul class="navbar__top-menu is-active">
							<?php foreach ($menu as $item) : ?>
								<li class="navbar__item">
									<a class="navbar__link <?php if ($item['active']) : ?>navbar__active<?php endif; ?>" href="<?= $item['URL'] ?>">
										<?= $item['name'] ?>
									</a>
								</li>
							<? endforeach; ?>
						</ul>
					</nav>
				</div>
			</header>
			<div class="container">
				<?= $content ?>
			</div>
		</div>
		<footer id="footer" class="footer">

		</footer>
	</div>
</body>

</html>