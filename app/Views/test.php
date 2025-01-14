<!-- Icon Login -->
<img src="<?= base_url('img/' . esc($setting['iconlogin']) . '?' . time()) ?>" alt="Website Icon" class="website-icon">

<!-- Nama Website -->
<h1 class="app-title"><?= esc($setting['namawebsite']) ?></h1>

<!-- Background Menu -->
<div class="split left"
    style="background: url('<?= base_url('img/' . esc($setting['iconmenu']) . '?' . time()) ?>') no-repeat center center/cover;">
</div>