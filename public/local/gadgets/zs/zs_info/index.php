<?php

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
	die();
}

$domain = $_SERVER['HTTP_HOST'];
$test = dns_get_record($domain, DNS_ALL);
?>

<div class="bx-gadgets-content-padding-rl">
	<h2>для домена <?= $domain ?></h2>
	<table style="margin-bottom: 20px;">
		<?php
		foreach ($test as $tes) {
			if ($tes['type'] == 'SOA') {
				continue;
			}
			if ($tes['type'] == 'TXT') {
				$val = $tes['txt'];
			} elseif ($tes['type'] == 'A') {
				$val = $tes['ip'];
			} else {
				$val = $tes['target'];
			}

			if (strpos($val, '_globalsign-domain-verification') !== false) {
				continue;
			}
			?>
			<tr>
				<td><b><?= $tes['type'] ?>: </b></td>
				<td><?= $val ?></td>
			</tr>
			<?php
		}
		?>
	</table>
</div>

