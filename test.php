<?php
/*
Template Name: Formulaire invitation
*/
?>

<?php get_header(); ?>

<main id="inner-content" role="main">
	<div id="content" class="formulaire_invitation">
		<div class="intro">
			<div class="row">
				<img src="<?php echo get_template_directory_uri(); ?>/assets/images/questionnaires/questionnaire_1/logo.svg" width="139" height="50" alt="hush" class="logo_quest">
				<h1><?php the_field( 'titre_bloc_1' ); ?></h1>
			</div>
		</div>
		<div class="bloc">


			<?php
	// CREATION DE LA TABLE
			global $wpdb;
			$table_name = $wpdb->prefix. 'form_invitation';
			$charset_collate = $wpdb->get_charset_collate();
			$max_index_length = 191;

			$sql = "CREATE TABLE IF NOT EXISTS $table_name (
				id_formulaire INT(20) NOT NULL AUTO_INCREMENT PRIMARY KEY,
				email VARCHAR(100) UNIQUE
			)$charset_collate;";

			require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
			dbDelta($sql);


	// VERIFICATION DE LA PRESENCE DE LA VARIABLE EMAIL DANS L'URL
	// PUIS DANS LA TABLE

			$user_email = $_GET["email"];

			if(isset($user_email)) {
				echo $user_email;

			 	$nb = $wpdb->get_results( "SELECT COUNT(*) FROM $table_name WHERE email = $user_email ");
				$nb = count($nb);
				echo "le $nb";
				if($nb == 1){
					?>
						<p>Vous avez déjà envoyé une invitation</p>
					<?php
				}else{
					// MONTRER LE FORMULAIRE ET AU SUBMIT
					// AJOUTTER L'ENREGISTREMENT DE LA VARIABLE EMAIL DANS LA TABLE
					?>
					<!-- Change or deletion of the name attributes in the input tag will lead to empty values on record submission-->
					<form action='https://forms.zohopublic.eu/virtualoffice82/form/Invitation/formperma/63307j3F56f0CjCmh033e_hEm/htmlRecords/submit' name='form' method='POST' accept-charset='UTF-8' enctype='multipart/form-data'><input type="hidden" name="zf_referrer_name" value=""><!-- To Track referrals , place the referrer name within the " " in the above hidden input field -->
						<p><span>Bonjour <?php echo $_GET["prenom"] ?>,</span> vous l'avez compris Hush souhaite développer son cercle d'utilisateurs dans la confiance. Aussi, nous vous permettrons régulièrement d'inviter des ami(e)s.</p>
						<input type="hidden" name="zf_redirect_url" value=""><!-- To redirect to a specific page after record submission , place the respective url within the " " in the above hidden input field -->
						<p></p>
						<!--Single Line-->
						<label>Son prénom
							<em>*</em>
						</label>
						<input type="text" name="SingleLine" value="" maxlength="255"/>
						<!--Single Line-->
						<label>Son nom
							<em>*</em>
						</label>
						<input type="text" name="SingleLine1" value="" maxlength="255"/>
						<!--Email-->
						<label>Son email
							<em>*</em>
						</label>
						<input type="text" maxlength="255" name="Email" value=""/>
					<button type="submit"><em>Submit</em></button></form>
					<?php
				};
			}else{ ?>
				<p>Vous devez cliquer sur le lien de l'invitation pour accéder au formulaire</p>
				<?php
			};	?>
		</div>
	</div> <!-- end #content -->
</main> <!-- end #main -->

<?php get_footer(); ?>
