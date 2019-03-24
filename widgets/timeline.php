<?php
namespace MicElementorCollection\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Repeater;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Image_Size;
// use Elementor\Frontend;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Elementor tabs widget.
 *
 * Elementor widget that displays vertical or horizontal tabs with different
 * pieces of content.
 *
 * @since 1.0.0
 */
class Widget_Timeline extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve tabs widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'timeline';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve tabs widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Timeline', 'mic-elementor-collection' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve tabs widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-posts-ticker';
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the google maps widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * @since 2.0.0
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'basic' ];
	}

	/**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the widget belongs to.
	 *
	 * @since 2.1.0
	 * @access public
	 *
	 * @return array Widget keywords.
	 */
	public function get_keywords() {
		return [ 'timeline', 'bio', 'biography' ];
	}

	/**
	 * Register tabs widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _register_controls() {
		$this->start_controls_section(
			'section_tabs',
			[
				'label' => __( 'Timeline', 'mic-elementor-collection' ),
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'tab_title',
			[
				'label' => __( 'Title & Content', 'mic-elementor-collection' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Timeline Title', 'mic-elementor-collection' ),
				'placeholder' => __( 'Timeline Title', 'mic-elementor-collection' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'tab_image',
			[
				'label' => __( 'Choose Image', 'mic-elementor-collection' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'dynamic' => [
					'active' => true,
				]
			]
		);

		$repeater->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'thumbnail', // // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
				'exclude' => [ 'custom' ],
				'include' => [],
				'default' => 'thumbnail',
			]
		);

		$repeater->add_control(
			'tab_content',
			[
				'label' => __( 'Content', 'mic-elementor-collection' ),
				'default' => __( 'Timeline Content', 'mic-elementor-collection' ),
				'placeholder' => __( 'Timeline Content', 'mic-elementor-collection' ),
				'type' => Controls_Manager::WYSIWYG,
				'show_label' => false,
			]
		);

		$this->add_control(
			'tabs',
			[
				'label' => __( 'Tabs Items', 'mic-elementor-collection' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'tab_title' => __( 'Timeline #1', 'mic-elementor-collection' ),
						'tab_content' => __( 'I am timeline content. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'mic-elementor-collection' ),
					],
					[
						'tab_title' => __( 'Timeline #2', 'mic-elementor-collection' ),
						'tab_content' => __( 'I am timeline content. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'mic-elementor-collection' ),
					],
				],
				'title_field' => '{{{ tab_title }}}',
			]
		);

		$this->add_control(
			'view',
			[
				'label' => __( 'View', 'mic-elementor-collection' ),
				'type' => Controls_Manager::HIDDEN,
				'default' => 'traditional',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_tabs_style',
			[
				'label' => __( 'Tabs', 'mic-elementor-collection' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'heading_title',
			[
				'label' => __( 'Title', 'mic-elementor-collection' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'tab_color',
			[
				'label' => __( 'Color', 'mic-elementor-collection' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .biography-table__key' => 'color: {{VALUE}};',
				],
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_2,
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'tab_typography',
				'selector' => '{{WRAPPER}} .biography-table__key',
				'scheme' => Scheme_Typography::TYPOGRAPHY_2,
			]
		);

		$this->add_control(
			'heading_content',
			[
				'label' => __( 'Content', 'mic-elementor-collection' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'content_color',
			[
				'label' => __( 'Color', 'mic-elementor-collection' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .biography-table__info' => 'color: {{VALUE}};',
				],
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_2,
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'content_typography',
				'selector' => '{{WRAPPER}} .biography-table__info',
				'scheme' => Scheme_Typography::TYPOGRAPHY_3,
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Render tabs widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		$tabs = $this->get_settings_for_display( 'tabs' ); ?>
		
		<div class="biography__container" role="tablist">
			<table class="biography-table">
				<tbody>
						<?php foreach ( $tabs as $index => $item ) : 
							$repeater_setting_key = $this->get_repeater_setting_key( 'text', 'tabs', $index );
							$this->add_render_attribute( $repeater_setting_key, 'class', 'biography-table__row' );
							$this->add_inline_editing_attributes( $repeater_setting_key );

							$first_class = '';
							$image_class = '';
							$image_i = '';
							// print_r($item['tab_image']);
							if ($index == 0) {
								$this->add_render_attribute( $repeater_setting_key, 'class', 'biography-table__row--top-circle' );
								$first_class = 'biography-table__row--top-circle';
							}
							if ($item['tab_image']['url']) {
								$this->add_render_attribute( $repeater_setting_key, 'class', 'biography-table__row--image' );
								$image_class = 'biography-table__row--image';
								$image_i = Group_Control_Image_Size::get_attachment_image_html($item, 'thumbnail', 'tab_image');	
							}
						?>
							<tr <?php echo $this->get_render_attribute_string( $repeater_setting_key ); ?> 
							 >
							 <td class="biography-table__key"><?php echo $item['tab_title'].' '.$image_i; ?></td>
							 <td class="biography-table__info"><?php echo $item['tab_content']; ?></td>
							</tr>
						<?php endforeach; ?>
				</tbody>
			</table>
		</div>
		<?php
	}

	/**
	 * Render tabs widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _content_template() {
		?>
		<div class="biography__container" role="tablist">
			<#
			if ( settings.tabs ) { #>
				<table class="biography-table">
					<tbody>
					<#
					_.each( settings.tabs, function( item, index ) {
						var first_class = '';
						var image_class = '';
						var image_i = '';
						if(index == 0) {
							first_class = 'biography-table__row--top-circle';
						}
						if(item.tab_image.url) {
							image_class = 'biography-table__row--image';
							image_i = '<img src="' + item.tab_image.url + '" alt="thumbnail">';
						}
						#>
						<tr class="biography-table__row {{{ first_class }}} {{{ image_class }}}">
							<td class="biography-table__key">{{{ item.tab_title }}} {{{ image_i }}}</td>
							<td class="biography-table__info">{{{ item.tab_content }}}</td>
						</tr>
					<# } ); #>
					</tbody>
				</table>
			<# } #>
		</div>
		<?php
	}
}
