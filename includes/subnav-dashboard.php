<?php $page_courante = basename($_SERVER['PHP_SELF']); ?>
<nav class="subnav">
    <a href="dashboard.php" class="subnav-tab <?= $page_courante === 'dashboard.php' ? 'active' : '' ?>">Articles</a>
    <a href="albums-dashboard.php" class="subnav-tab <?= $page_courante === 'albums.php' ? 'active' : '' ?>">Albums <span class="badge">bientôt</span></a>
</nav>