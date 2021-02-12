<html>
<head>
	<meta charset="utf-8" />
	<link rel="stylesheet" href="App/Views/public/css/all.css" type="text/css" />
</head>
<body>
<div class="listing">
	<h1>Movie Listing</h1>
	<div class="listing--paging">
		<!-- Pagination - Next page -->
        <?php if ($args['page'] < $args['pagesNumber']) { ?>
			<a href="<?php echo '//' . $_SERVER['SERVER_NAME'] . '/movie-example/?p=' . ($args['page'] + 1) ?>"
			   class="next" title="next">
				Next
			</a>
        <?php } ?>

		<!-- Pagination - Previous page -->
        <?php if ($args['page'] > 1) { ?>
			<a href="<?php echo '//' . $_SERVER['SERVER_NAME'] . '/movie-example/?p=' . ($args['page'] - 1) ?>"
			   class="prev" title="prev">
				Prev
			</a>
        <?php } ?>

		<!-- Pagination - current page -->
        <?php if ($args['pagesNumber'] > 1) { ?>
			<ul>
                <?php for ($i = 1; $i <= $args['pagesNumber']; ++$i) { ?>
					<li>
						<a href="<?php echo '//' . $_SERVER['SERVER_NAME'] . '/movie-example/?p=' . $i ?>"
                            <?php if ($i == $args['page']) { ?> class="active" <?php } ?>>
                            <?php echo $i ?>
						</a>
					</li>
                <?php } ?>
			</ul>
        <?php } ?>
	</div>

	<!-- Listing Movie Elements -->
	<div class="listing--elements">
        <?php foreach ($args['data'] as $element) { ?>
			<div class="element--box">
				<!--  Image -->
				<span class="image--element">
                      <img src="<?php echo $element['Images']['Cover']; ?>"
						   alt="<?php echo $element['Titles']['Stream']; ?>" />
				 </span>
				<!--  Trailer -->
				<div class="trailer--element">
                    <?php if (isset($element['Trailer']['YouTube'])) { ?>
						<a href="<?php echo 'https://www.youtube.com/watch?v=' . $element['Trailer']['YouTube']; ?>"
						   target="_blank">
                            <?php echo 'Trailer' ?>
						</a>
                    <?php } ?>
				</div>
				<!--  Title -->
				<div class="title--element">
					<a href="<?php echo $element['Link']; ?>"
					   target="_blank">
                        <?php echo $element['Titles']['Stream']; ?>
					</a>
				</div>
				<!--  Description -->
				<div class="description--element">
					<p>
                        <?php echo substr($element['Description'], 0, 70) . '...'; ?>
					</p>
				</div>

			</div>
        <?php } ?>
	</div>
	<div class="listing--paging">
		<!-- Pagination - Next page -->
        <?php if ($args['page'] < $args['pagesNumber']) { ?>
			<a href="<?php echo '//' . $_SERVER['SERVER_NAME'] . '/movie-example/?p=' . ($args['page'] + 1) ?>"
			   class="next" title="next">
				Next
			</a>
        <?php } ?>

		<!-- Pagination - Previous page -->
        <?php if ($args['page'] > 1) { ?>
			<a href="<?php echo '//' . $_SERVER['SERVER_NAME'] . '/movie-example/?p=' . ($args['page'] - 1) ?>"
			   class="prev" title="prev">
				Prev
			</a>
        <?php } ?>

		<!-- Pagination - current page -->
        <?php if ($args['pagesNumber'] > 1) { ?>
			<ul>
                <?php for ($i = 1; $i <= $args['pagesNumber']; ++$i) { ?>
					<li>
						<a href="<?php echo '//' . $_SERVER['SERVER_NAME'] . '/movie-example/?p=' . $i ?>"
                            <?php if ($i == $args['page']) { ?> class="active" <?php } ?>>
                            <?php echo $i ?>
						</a>
					</li>
                <?php } ?>
			</ul>
        <?php } ?>
	</div>
</div>
</body>
</html>
