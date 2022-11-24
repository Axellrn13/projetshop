<?php 
$this->_t='Accueil';
foreach($articles as $article): ?>
<body>
<h2><?= $article->name(); ?></h2>
</body>
<?php endforeach; ?>