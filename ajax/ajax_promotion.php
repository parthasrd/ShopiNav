<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/includes/autoload.php');
//$session = new session();
$mgmtObj= new mgmt();
$response  = array(
    'success' => false,
    'message' => ''
);

if( !empty( $_POST ) ) {
    switch( $_POST['method'] ) {
        case 'create_new_topbar':
            parse_str( $_POST['data'], $data );

            $meta_data['fnt_styl'] = $fnt_styl = $data['fnt_styl'];
            $meta_data['banner_text'] = $banner_text = trim($data['banner_text']);
            $meta_data['text_color'] = $text_color = trim($data['text_color']);
            $meta_data['bg_color'] = $bg_color = trim($data['bg_color']);

            $meta_data['is_button'] = $is_button = isset($data['is_button']) ? 1 : 0;
            $meta_data['bttn_text'] = $bttn_text = trim($data['bttn_text']);
            $meta_data['bttn_link'] = $bttn_link = trim($data['bttn_link']);
            $meta_data['bttn_cust_css'] = $bttn_cust_css = trim($data['bttn_cust_css']);

            $meta_data['is_another_tab'] = $is_another_tab = isset($data['is_another_tab']) ? 1 : 0;
            $meta_data['status'] = $status = $data['status'];

            $postbar = $mgmtObj->postbar($meta_data);
            $response['success'] = $postbar;
            break;
        case 'del_promotion':
            parse_str( $_POST['data'], $data );
            $meta_data['promo_id'] = $promo_id = $data['promo_id'];
            $postbar = $mgmtObj->delbar($promo_id);
            break;
        case 'publish_promotion':
            parse_str( $_POST['data'], $data );
            $meta_data['promo_id'] = $promo_id = $data['promo_id'];
            $postbar = $mgmtObj->pubbar($promo_id);
            break;
        case 'deactivate_promotion':
            parse_str( $_POST['data'], $data );
            $meta_data['promo_id'] = $promo_id = $data['promo_id'];
            $postbar = $mgmtObj->deac_bar($promo_id);
            break;
        case 'edit_topbar':
            parse_str( $_POST['data'], $data );

            $meta_data['fnt_styl'] = $fnt_styl = $data['fnt_styl'];
            $meta_data['banner_text'] = $banner_text = trim($data['banner_text']);
            $meta_data['text_color'] = $text_color = trim($data['text_color']);
            $meta_data['bg_color'] = $bg_color = trim($data['bg_color']);

            $meta_data['is_button'] = $is_button = isset($data['is_button']) ? 1 : 0;
            $meta_data['bttn_text'] = $bttn_text = trim($data['bttn_text']);
            $meta_data['bttn_link'] = $bttn_link = trim($data['bttn_link']);
            $meta_data['bttn_cust_css'] = $bttn_cust_css = trim($data['bttn_cust_css']);

            $meta_data['is_another_tab'] = $is_another_tab = isset($data['is_another_tab']) ? 1 : 0;
            $meta_data['bars_id'] = $status = $data['bars_id'];

//          $meta_data['status'] = $status = $data['status'];
            $editbar = $mgmtObj->editbar($meta_data);

            $response['success'] = $editbar;
            break;



    }
}
echo json_encode( $response ); die(0);
?>
