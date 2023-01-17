<?php
namespace productSlider;

if(!class_exists('OptionsPage')){
    class RBOptionsPage {

        public function __construct(){
            add_action( 'admin_menu', array( $this, 'add_settings_page' ) );
            add_action( 'admin_init', array( $this, 'register_settings' ) );
        }

        //Añade la pagina de opciones en el menú settigns de Wordpress
        public function add_settings_page() {
            add_options_page(
                'Product Slider Settings',
                'Product Slider Settings',
                'manage_options',
                'product-slider-settings',
                array( $this, 'render_settings_page' )
            );
        }

        //Añade formulario en la pagina de opciones
        public function render_settings_page() {
            ?>
              <h2><?php _e('Product Slider Settings'); ?></h2>
              <form action="options.php" method="post">
                <?php 
                settings_fields( 'product_slider_settings' );
                do_settings_sections( 'product_slider' );
                ?>
                <input type="submit" name="submit" class="button button-primary" value="<?php esc_attr_e( 'Save' ); ?>"/>
              </form>
            <?php
        }

        //Registra las opciones
        public function register_settings() {
            register_setting(
              'product_slider_settings',
              'product_slider_settings',
              array( $this, 'validate_settings')
            );
            add_settings_section(
              'ps_custom_colors',
              'Custom colors',
              array( $this, 'section_custom_colors' ),
              'product_slider'
            );
            add_settings_field(
              'background_card_field',
              'Card background color',
              array( $this, 'render_background_card_field' ),
              'product_slider',
              'ps_custom_colors'
            );
            add_settings_field(
              'background_btn_field',
              'Button background color',
              array( $this, 'render_background_btn_field'),
              'product_slider',
              'ps_custom_colors'
            );
        }

        //valida los datos antes de guardar en DB
        public function validate_settings( $input ) {
            $output['background_card_field'] = sanitize_hex_color( $input['background_card_field'] );
            $output['background_btn_field'] = sanitize_hex_color( $input['background_btn_field'] );
            return $output;
        }

        //añade texto descriptivo en la pagina de opciones
        public function section_custom_colors() {
            _e( '<p>Change the background colors of the card and the button.</p>' );
        }

        //Pinta los inputs en la pagina de opciones
        public function render_background_card_field() {
            $options = get_option( 'product_slider_settings' );
            $backgroundCard = $options['background_card_field'] ? $options['background_card_field'] : '#ffffff';
            printf(
              '<input type="color" name="%s" value="%s" />',
              esc_attr( 'product_slider_settings[background_card_field]' ),
              esc_attr( $backgroundCard )
            );
        }

        public function render_background_btn_field() {
            $options = get_option( 'product_slider_settings' );
            $backgroundBtn = $options['background_btn_field'] ? $options['background_btn_field'] : '#0A69C2';
            printf(
              '<input type="color" name="%s" value="%s" />',
              esc_attr( 'product_slider_settings[background_btn_field]' ),
              esc_attr( $backgroundBtn )
            );
        }
    }
}