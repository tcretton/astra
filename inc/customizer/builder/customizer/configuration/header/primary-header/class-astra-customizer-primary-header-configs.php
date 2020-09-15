<?php
/**
 * Astra Theme Customizer Configuration Builder.
 *
 * @package     astra-builder
 * @author      Astra
 * @copyright   Copyright (c) 2020, Astra
 * @link        https://wpastra.com/
 * @since       x.x.x
 */

// No direct access, please.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( class_exists( 'Astra_Customizer_Config_Base' ) ) {

	/**
	 * Register Builder Customizer Configurations.
	 *
	 * @since x.x.x
	 */
	class Astra_Customizer_Primary_Header_Configs extends Astra_Customizer_Config_Base {

		/**
		 * Register Builder Customizer Configurations.
		 *
		 * @param Array                $configurations Astra Customizer Configurations.
		 * @param WP_Customize_Manager $wp_customize instance of WP_Customize_Manager.
		 * @since x.x.x
		 * @return Array Astra Customizer Configurations with updated configurations.
		 */
		public function register_configuration( $configurations, $wp_customize ) {

			$_section = 'section-primary-header-builder';

			$_configs = array(

				/*
				 * Panel - New Header
				 *
				 * @since x.x.x
				 */
				array(
					'name'            => 'panel-header-builder-group',
					'type'            => 'panel',
					'priority'        => 20,
					'title'           => __( 'Header Builder', 'astra-builder', 'astra' ),
					'active_callback' => 'Astra_Builder_Helper::is_migrated',
				),

				// Section: Primary Header.
				array(
					'name'     => $_section,
					'type'     => 'section',
					'title'    => __( 'Primary Header', 'astra-builder', 'astra' ),
					'panel'    => 'panel-header-builder-group',
					'priority' => 20,
				),

				/**
				 * Option: Header Builder Tabs
				 */
				array(
					'name'        => ASTRA_THEME_SETTINGS . '[builder-header-primary-tabs]',
					'section'     => $_section,
					'type'        => 'control',
					'control'     => 'ast-builder-header-control',
					'priority'    => 0,
					'description' => '',
				),

				// Section: Primary Header Height.
				array(
					'name'        => ASTRA_THEME_SETTINGS . '[hb-header-height]',
					'section'     => $_section,
					'transport'   => 'postMessage',
					'default'     => astra_get_option( 'hb-header-height' ),
					'priority'    => 3,
					'title'       => __( 'Height', 'astra-builder', 'astra' ),
					'type'        => 'control',
					'control'     => 'ast-slider',
					'suffix'      => '',
					'input_attrs' => array(
						'min'  => 30,
						'step' => 1,
						'max'  => 600,
					),
					'context'     => array(
						array(
							'setting' => 'ast_selected_tab',
							'value'   => 'general',
						),
					),
				),

				// Option: Header Separator.
				array(
					'name'        => ASTRA_THEME_SETTINGS . '[hb-header-main-sep]',
					'transport'   => 'postMessage',
					'default'     => astra_get_option( 'hb-header-main-sep' ),
					'type'        => 'control',
					'control'     => 'ast-slider',
					'section'     => $_section,
					'priority'    => 4,
					'title'       => __( 'Bottom Border', 'astra-builder', 'astra' ),
					'input_attrs' => array(
						'min'  => 0,
						'step' => 1,
						'max'  => 10,
					),
					'context'     => array(
						array(
							'setting' => 'ast_selected_tab',
							'value'   => 'design',
						),
					),
				),

				// Option: Header Bottom Boder Color.
				array(
					'name'      => ASTRA_THEME_SETTINGS . '[hb-header-main-sep-color]',
					'transport' => 'postMessage',
					'default'   => astra_get_option( 'hb-header-main-sep-color' ),
					'type'      => 'control',
					'required'  => array( ASTRA_THEME_SETTINGS . '[hb-header-main-sep]', '>=', 1 ),
					'control'   => 'ast-color',
					'section'   => $_section,
					'priority'  => 5,
					'title'     => __( 'Bottom Border Color', 'astra-builder', 'astra' ),
					'context'   => array(
						array(
							'setting' => 'ast_selected_tab',
							'value'   => 'design',
						),
					),
				),

				// Option: Primary Header color and background divider.
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[hb-header-colors-and-background-divider]',
					'type'     => 'control',
					'control'  => 'ast-heading',
					'section'  => $_section,
					'title'    => __( 'Background Color & Image', 'astra-builder', 'astra' ),
					'priority' => 6,
					'settings' => array(),
					'context'  => array(
						array(
							'setting' => 'ast_selected_tab',
							'value'   => 'design',
						),
					),
				),

				// Group Option: Header Background.
				array(
					'name'      => ASTRA_THEME_SETTINGS . '[hb-header-background-group]',
					'default'   => astra_get_option( 'hb-header-background-group' ),
					'type'      => 'control',
					'control'   => 'ast-settings-group',
					'title'     => __( 'Background', 'astra-builder', 'astra' ),
					'section'   => $_section,
					'transport' => 'postMessage',
					'priority'  => 7,
					'context'   => array(
						array(
							'setting' => 'ast_selected_tab',
							'value'   => 'design',
						),
					),
				),

				// Sub Option: Header Background.
				array(
					'name'       => 'hb-header-bg-obj-responsive',
					'parent'     => ASTRA_THEME_SETTINGS . '[hb-header-background-group]',
					'section'    => $_section,
					'type'       => 'sub-control',
					'control'    => 'ast-responsive-background',
					'transport'  => 'postMessage',
					'data_attrs' => array(
						'name' => 'hb-header-bg-obj-responsive',
					),
					'default'    => astra_get_option( 'hb-header-bg-obj-responsive' ),
					'label'      => __( 'Background', 'astra-builder', 'astra' ),
				),
			);

			$_configs = array_merge( $_configs, Astra_Builder_Base_Configuration::prepare_advanced_tab( $_section ) );

			return array_merge( $configurations, $_configs );
		}
	}

	/**
	 * Kicking this off by creating object of this class.
	 */
	new Astra_Customizer_Primary_Header_Configs();
}