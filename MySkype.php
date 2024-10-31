<?php
/*
Plugin Name: My Skype
Plugin URI: http://weengle.com/my-skype.html
Description: Display Skype Widget In Your Sidebar.
Author: Debasis Pradhan
Version: 1.2
Author URI: http://debasispradhan.com/
*/

/* My Skype Plugin Release Date 10/04/2014 */

function myskype_stylesheet($hook) {
    if( 'widgets.php' != $hook )
        return;
    wp_enqueue_style( 'myskype-admin-stylesheet', plugin_dir_url( __FILE__ ) . 'style.css' );
}
add_action( 'admin_enqueue_scripts', 'myskype_stylesheet' );


function widget_myskype_init() {


	if ( !function_exists('register_sidebar_widget') )
		return;

	
	function widget_myskype($args) {
		global $post;
		extract($args);
		$options = get_option('widget_myskype');
		$title = $options['title'];		
		$user = $options['user'];
		$call = $options['call'];
		$add = $options['add'];
		$chat = $options['chat'];
		$info = $options['info'];
		$voicemail = $options['voicemail'];
		$sendfile = $options['sendfile'];
		$colors = $options['colors'];
		    
    
    echo $before_widget.$before_title;  
    echo '<img src="http://mystatus.skype.com/smallicon/'.$user.'" align="absmiddle" alt="Online Status" title="Online Status">'.$title.$after_title;
    if ($call)
    {
        echo '<a href="skype:'.$user.'?call"><img src="http://download.skype.com/share/skypebuttons/buttons/call_'.$colors.'_white_153x63.png" style="border: none;" width="153" height="63" alt="Call Me" title="Call Me" /></a><br/>';
    }
    if ($add)
    {
        echo '<a href="skype:'.$user.'?add"><img src="http://download.skype.com/share/skypebuttons/buttons/add_'.$colors.'_white_195x63.png" style="border: none;" width="195" height="63" alt="Add Me to Skype" title="Add Me to Skype" /></a><br/>';
    }
    if ($chat)
    {
      echo '<a href="skype:'.$user.'?chat"><img src="http://download.skype.com/share/skypebuttons/buttons/chat_'.$colors.'_white_164x52.png" style="border: none;" width="164" height="52" alt="Chat With Me" title="Chat With Me" /></a><br/>';
    }
    if ($info)
    {
      echo '<a href="skype:'.$user.'?userinfo"><img src="http://download.skype.com/share/skypebuttons/buttons/userinfo_'.$colors.'_white_180x52.png" style="border: none;" width="180" height="52" alt="View My Profile" title="View My Profile" /></a><br/>';
    }
    if ($voicemail)
    {
      echo '<a href="skype:'.$user.'?voicemail"><img src="http://download.skype.com/share/skypebuttons/buttons/voicemail_'.$colors.'_white_213x52.png" style="border: none;" width="213" height="52" alt="Leave Me a Voicemail" title="Leave Me a Voicemail" /></a><br/>';
    }
    if ($sendfile)
    {
      echo '<a href="skype:'.$user.'?sendfile"><img src="http://download.skype.com/share/skypebuttons/buttons/sendfile_'.$colors.'_white_164x52.png" style="border: none;" width="164" height="52" alt="Send Me a File" title="Send Me a File" /></a><br/>';
    }
    echo $after_widget;      

	}

	function widget_myskype_control() {

		$options = get_option('widget_myskype');
		if ( !is_array($options) )
			$options = array('title'=>'', 'user'=>'', 'call'=>0, 'add'=>0, 'chat'=>0, 'info'=>0, 'voicemail'=>0, 'sendfile'=>0, 'colors'=>'green');
		if ( $_POST['myskype-submit'] ) {

		$options['title'] = strip_tags(stripslashes($_POST['myskype-title']));			
		$options['user'] = strip_tags(stripslashes($_POST['myskype-user']));
		$options['colors'] = strip_tags(stripslashes($_POST['myskype-colors']));
		$options['call'] = isset($_POST['myskype-call']);
		$options['add'] = isset($_POST['myskype-add']);
		$options['chat'] = isset($_POST['myskype-chat']);
		$options['info'] = isset($_POST['myskype-info']);
		$options['voicemail'] = isset($_POST['myskype-voicemail']);
		$options['sendfile'] = isset($_POST['myskype-sendfile']);
			
			update_option('widget_myskype', $options);
		}

		$title = htmlspecialchars($options['title'], ENT_QUOTES);		
		$user = htmlspecialchars($options['user'], ENT_QUOTES);
		$call = $options['call'] ? 'checked="checked"' : '';
		$add   = $options['add'] ? 'checked="checked"' : '';
		$chat   = $options['chat'] ? 'checked="checked"' : '';
		$info   = $options['info'] ? 'checked="checked"' : '';
		$voicemail   = $options['voicemail'] ? 'checked="checked"' : '';
		$sendfile   = $options['sendfile'] ? 'checked="checked"' : '';
		$colors = $options['colors'];
		$green = $colors == 'green' ? 'checked="checked"' : '';
		$blue = $colors == 'blue' ? 'checked="checked"' : '';
		
		echo '<p style="text-align:left;"><label for="myskype-title">' . __('Title:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;') . ' <input style="width: 200px;" id="myskype-title" name="myskype-title" type="text" value="'.$title.'" /></label></p>';		
		echo '<p style="text-align:left;"><label for="myskype-user">' . __('User ID:') . ' <input style="width: 200px;" id="myskype-user" name="myskype-user" type="text" value="'.$user.'" /></label></p>';
		echo '<p style="text-align:left;margin-right:40px;"><label for="myskype-call" style="text-align:left;">'.__('Display Call:&nbsp;').'<input class="checkbox" type="checkbox"'.$call.'id="myskype-call" name="myskype-call" /></label></p>';
		echo '<p style="text-align:left;margin-right:40px;"><label for="myskype-add" style="text-align:left;">'.__('Display Add: &nbsp;').'<input class="checkbox" type="checkbox"'.$add.'id="myskype-add" name="myskype-add" /></label></p>';
		echo '<p style="text-align:left;margin-right:40px;"><label for="myskype-chat" style="text-align:left;">'.__('Display Chat Option:&nbsp;').'<input class="checkbox" type="checkbox"'.$chat.'id="myskype-chat" name="myskype-chat" /></label></p>';
		echo '<p style="text-align:left;margin-right:40px;"><label for="myskype-info" style="text-align:left;">'.__('Display User Info:&nbsp;').'<input class="checkbox" type="checkbox"'.$info.'id="myskype-info" name="myskype-info" /></label></p>';
		echo '<p style="text-align:left;margin-right:40px;"><label for="myskype-voicemail" style="text-align:left;">'.__('Display Voicemail:&nbsp;').'<input class="checkbox" type="checkbox"'.$voicemail.'id="myskype-voicemail" name="myskype-voicemail" /></label></p>';
		echo '<p style="text-align:left;margin-right:40px;"><label for="myskype-sendfile" style="text-align:left;">'.__('Display Sendfile:&nbsp;').'<input class="checkbox" type="checkbox"'.$sendfile.'id="myskype-sendfile" name="myskype-sendfile" /></label></p>';
		echo '<p style="text-align:left;margin-right:40px;"><label for="myskype-colors" style="text-align:left;">'.__('Color:&nbsp;').'<input type="radio" name="myskype-colors" id="myskype-colors-green" value="green"'.$green.'><spn
		 style="color:#279E00;">Green</span>&nbsp;&nbsp;<input type="radio" name="myskype-colors" id="myskype-colors-blue" value="blue"'.$blue.'><spn
		 style="color:#06B6EE;">Blue</span></label></p>';
		echo '<input type="hidden" id="myskype-colors2" name="myskype-colors2" value="green" />';
		echo '<input type="hidden" id="myskype-submit" name="myskype-submit" value="1" />';
		echo '<p><a href="http://weengle.com/" target="_blank"><img src="http://weengle.com/wp-content/uploads/2013/01/logo-300x94.png" alt="Weengle Technologies" title="Weengle Technologies Pvt. Ltd."></a></p>';
	}
	
	register_sidebar_widget(array('My Skype Widget', 'widgets'), 'widget_myskype');
	register_widget_control(array('My Skype Widget', 'widgets'), 'widget_myskype_control', 300, 315);
}
add_action('widgets_init', 'widget_myskype_init');

?>
