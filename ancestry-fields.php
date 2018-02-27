<?php

function gcofa_add_custom_metabox() {

	add_meta_box(
		'gcofa_meta',
		__( 'Ancestry Profile' ),
		'gcofa_meta_callback',
		'ancestry',
		'normal',
		'high'
	);

}

add_action( 'add_meta_boxes', 'gcofa_add_custom_metabox' );

function gcofa_meta_callback( $post ) {
	wp_nonce_field( basename( __FILE__ ), 'gcofa_ancestry_nonce' );
	$gcofa_stored_meta = get_post_meta( $post->ID ); ?>

	<div>

		<div class="meta-row">
			<div class="meta-th">
				<label for="date-born" class="gcofa-row-title"><?php _e( 'Date Born:', 'ancestry-profile' ); ?></label>
			</div>
			<div class="meta-td">
				<input type="text" size=20 class="gcofa-row-content" name="date_born" id="date-born" value="<?php if ( ! empty ( $gcofa_stored_meta['date_born'] ) ) echo esc_attr( $gcofa_stored_meta['date_born'][0] ); ?>"/>
			</div>
		</div>
		<div class="meta-row">
			<div class="meta-th">
				<label for="date_died" class="gcofa-row-title"><?php _e( 'Date Died:', 'ancestry-profile' ) ?></label>
			</div>
			<div class="meta-td">
				<input type="text" size=20 class="gcofa-row-content" name="date_died" id="date-died" value="<?php if ( ! empty ( $gcofa_stored_meta['date_died'] ) ) echo esc_attr( $gcofa_stored_meta['date_died'][0] ); ?>"/>
			</div>
		</div>
		<div class="meta-row">
	        <div class="meta-th">
	          <label for="life-facts" class="gcofa-row-title"><?php _e( 'Life Facts', 'ancestry-profile' ) ?></label>
	        </div>
	        <div class="meta-td">
	          <textarea name="life_facts" class="gcofa-textarea" id="life-facts"><?php
	          if ( ! empty ( $gcofa_stored_meta['life_facts'] ) ) {
		          echo esc_attr( $gcofa_stored_meta['life_facts'][0] );
	          }
	          ?>
	          </textarea>
	        </div>
	    </div>
		<div class="meta-row">
	        <div class="meta-th">
	          <label for="family-group" class="gcofa-row-title"><?php _e( 'Family Group', 'ancestry-profile' ) ?></label>
	        </div>
	        <div class="meta-td">
	          <textarea name="family_group" class="gcofa-textarea" id="family-group"><?php
	          if ( ! empty ( $gcofa_stored_meta['family_group'] ) ) {
		          echo esc_attr( $gcofa_stored_meta['family_group'][0] );
	          }
	          ?>
	          </textarea>
	        </div>
	    </div>
	    <div class="meta-row">
        	<div class="meta-th">
	          <label for="family-tree" class="gcofa-row-title"><?php _e( 'Family Tree Pedigree', 'ancestry-profile' ) ?></label>
	        </div>
	        <div class="meta-td">
	          <textarea name="family_tree" class="gcofa-textarea" id="family-tree"><?php
			          if ( ! empty ( $gcofa_stored_meta['family_tree'] ) ) {
			            echo esc_attr( $gcofa_stored_meta['family_tree'][0] );
			          }
		          ?>
	          </textarea>
	        </div>
	    </div>
	    <div class="meta-row">
        	<div class="meta-th">
	          <label for="gcofa-sources" class="gcofa-row-title"><?php _e( 'Sources', 'ancestry-profile' ) ?></label>
	        </div>
	        <div class="meta-td">
	          <textarea name="gcofa_sources" class="gcofa-textarea" id="gcofa-sources"><?php
			          if ( ! empty ( $gcofa_stored_meta['gcofa_sources'] ) ) {
			            echo esc_attr( $gcofa_stored_meta['gcofa_sources'][0] );
			          }
		          ?>
	          </textarea>
	        </div>
	    </div>
	</div>

	<?php
}

function gcofa_meta_save( $post_id ) {
	// Checks save status
    $is_autosave = wp_is_post_autosave( $post_id );
    $is_revision = wp_is_post_revision( $post_id );
    $is_valid_nonce = ( isset( $_POST[ 'gcofa_ancestry_nonce' ] ) && wp_verify_nonce( $_POST[ 'gcofa_ancestry_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';

    // Exits script depending on save status
    if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
        return;
    }

    if ( isset( $_POST[ 'date_born' ] ) ) {
    	update_post_meta( $post_id, 'date_born', sanitize_text_field( $_POST[ 'date_born' ] ) );
    }
    if ( isset( $_POST[ 'date_died' ] ) ) {
    	update_post_meta( $post_id, 'date_died', sanitize_text_field( $_POST[ 'date_died' ] ) );
    }
    if ( isset( $_POST[ 'life_facts' ] ) ) {
    	update_post_meta( $post_id, 'life_facts', wp_kses_post( $_POST[ 'life_facts' ] ) );
    }
	if ( isset( $_POST[ 'family_group' ] ) ) {
		update_post_meta( $post_id, 'family_group', wp_kses_post( $_POST[ 'family_group' ] ) );
	}
	if ( isset( $_POST[ 'family_tree' ] ) ) {
		update_post_meta( $post_id, 'family_tree', wp_kses_post( $_POST[ 'family_tree' ] ) );
	}
	if ( isset( $_POST[ 'gcofa_sources' ] ) ) {
		update_post_meta( $post_id, 'gcofa_sources', wp_kses_post( $_POST[ 'gcofa_sources' ] ) );
	}
}
add_action( 'save_post', 'gcofa_meta_save' );







