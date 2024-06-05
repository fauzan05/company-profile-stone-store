<?php
$current_path = $_SERVER['PATH_INFO'];
?>
<div class="main-sidebar sidebar-style-2">
	<aside id="sidebar-wrapper">
		<div class="sidebar-brand">
			<a href="index.html"><img class="w-10" src="<?= base_url('assets/img/gemstone-logo.svg') ?>" alt=""> Stone Store</a>
		</div>
		<div class="sidebar-brand sidebar-brand-sm">
			<a href="index.html"><img class="w-75" src="<?= base_url('assets/img/gemstone-logo.svg') ?>" alt=""></a>
		</div>
		<ul class="sidebar-menu mt-3">
			<li class="menu-header">Dashboard</li>
			<li class="dropdown <?= $current_path === '/dashboard' ? 'active' : '' ?>">
				<a href="/stone-store/dashboard" class="nav-link"><i class="fas fa-solid fa-house"></i><span>Dashboard</span></a>
			</li>
			<li class="dropdown <?= $current_path === '/products' ? 'active' : '' ?>">
				<a href="/stone-store/products" class="nav-link"><i class="fas fa-gem"></i><span>Products</span></a>
			</li>
			<li class="dropdown <?= $current_path === '/categories' ? 'active' : '' ?>">
				<a href="/stone-store/categories" class="nav-link"><i class="fas fa-solid fa-list"></i><span>Categories</span></a>
			</li>
			<li class="dropdown <?= $current_path === '/applications' ? 'active' : '' ?>">
				<a href="/stone-store/applications" class="nav-link"><i class="fas fa-brands fa-app-store-ios"></i><span>Applications</span></a>
			</li>
			<li class="dropdown <?= $current_path === '/settings' ? 'active' : '' ?>">
				<a href="/stone-store/settings" class="nav-link"><i class="fas fa-solid fa-sliders"></i><span>Settings</span></a>
			</li>
		</ul>
	</aside>
</div>
