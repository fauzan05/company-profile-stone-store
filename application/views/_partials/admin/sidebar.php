<?php
$current_path = $_SERVER['PATH_INFO'];
?>
<div class="main-sidebar sidebar-style-2">
	<aside id="sidebar-wrapper">
		<div class="sidebar-brand">
			<a href="/stone-store/dashboard">
				<?php if((boolean)$this->Setting_model->getAllSettings()[0]->is_show_logo): ?>
					<img class="w-10" src="<?= base_url('assets/img/systems/' .  $this->Setting_model->getAllSettings()[0]->logo_filename) ?>" alt="">
				<?php endif; ?>
			 <?= !empty($this->Setting_model->getAllSettings()[0]->company_name) ? $this->Setting_model->getAllSettings()[0]->company_name : ''?></a>
		</div>
		<div class="sidebar-brand sidebar-brand-sm">
			<a href="/stone-store/dashboard">
			<?php if((boolean)$this->Setting_model->getAllSettings()[0]->is_show_logo): ?>
					<img class="w-75" src="<?= base_url('assets/img/systems/' .  $this->Setting_model->getAllSettings()[0]->logo_filename) ?>" alt="">
			<?php else:
				$company_name = $this->Setting_model->getAllSettings()[0]->company_name ? $this->Setting_model->getAllSettings()[0]->company_name : 'Untitled';
				$explode = explode(' ', $company_name);
				$first_two_words = array_slice($explode, 0, 2);
				$initials = '';
				foreach($first_two_words as $word){
					$initials .= strtoupper($word[0]);
				}
				echo $initials;
			endif;
			?>
			</a>
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
