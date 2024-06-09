<?php
$current_path = $_SERVER['PATH_INFO'];
?>
<div class="main-sidebar sidebar-style-2">
	<aside id="sidebar-wrapper">
		<div class="sidebar-brand">
			<a href="/stone-store/admin/dashboard">
				<?php if((boolean)$this->Setting_model->getAllSettings()[0]->is_show_logo): ?>
					<img class="w-10" src="<?= base_url('assets/img/systems/' .  $this->Setting_model->getAllSettings()[0]->logo_filename) ?>" alt="">
				<?php endif; ?>
			 <?= !empty($this->Setting_model->getAllSettings()[0]->company_name) ? $this->Setting_model->getAllSettings()[0]->company_name : ''?></a>
		</div>
		<div class="sidebar-brand sidebar-brand-sm">
			<a href="/stone-store/admin/dashboard">
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
			<li class="dropdown <?= $current_path === '/admin/dashboard' ? 'active' : '' ?>">
				<a href="/stone-store/admin/dashboard" class="nav-link"><i class="fas fa-solid fa-house"></i><span>Dashboard</span></a>
			</li>
			<li class="dropdown <?= $current_path === '/admin/products' ? 'active' : '' ?>">
				<a href="/stone-store/admin/products" class="nav-link"><i class="fas fa-gem"></i><span>Products</span></a>
			</li>
			<li class="dropdown <?= $current_path === '/admin/categories' ? 'active' : '' ?>">
				<a href="/stone-store/admin/categories" class="nav-link"><i class="fas fa-solid fa-list"></i><span>Categories</span></a>
			</li>
			<!-- <li class="dropdown <?= $current_path === '/admin/applications' ? 'active' : '' ?>">
				<a href="/stone-store/admin/applications" class="nav-link"><i class="fas fa-brands fa-app-store-ios"></i><span>Applications</span></a>
			</li> -->
			<li class="dropdown <?= $current_path === '/admin/settings' || $current_path === '/admin/settings/profile' || $current_path === '/admin/settings/password' || $current_path === '/admin/settings/social-media' ? 'active' : '' ?>">
				<a href="/stone-store/admin/settings" class="nav-link"><i class="fas fa-solid fa-sliders"></i><span>Settings</span></a>
			</li>
		</ul>
	</aside>
</div>
