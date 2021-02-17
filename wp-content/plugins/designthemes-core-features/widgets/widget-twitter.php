<?php
class TrendyTravel_Twitter extends WP_Widget {
	#1.constructor
	function __construct() {
		$widget_options = array("classname"=>'widget_tweetbox', 'description'=>esc_html__('To show latest twitter tweets', 'designthemes-core'));
		parent::__construct(false,TRENDYTRAVEL_THEME_NAME.esc_html__(' Twitter Widget','designthemes-core'),$widget_options);
	}

	#2.widget input form in back-end
	function form($instance) {
		$instance = wp_parse_args( (array) $instance,array( 'title' => esc_html__('Latest Tweets','designthemes-core'), 'count' => '3', 'username' => '',
						'exclude_replies'=>'1' , 'time'=>'1', 'display_avatar'=>'0', 'consumer_key'=>'','consumer_secret'=>'','access_token'=>'','access_token_secret'=>'') );

		$title = 					empty($instance['title']) ?	'' : strip_tags($instance['title']);
		$consumer_key = 			empty($instance['consumer_key']) ?	'' : strip_tags($instance['consumer_key']);
		$consumer_secret = 			empty($instance['consumer_secret']) ?	'' : strip_tags($instance['consumer_secret']);
		$access_token = 			empty($instance['access_token']) ?	'' : strip_tags($instance['access_token']);
		$access_token_secret = 		empty($instance['access_token_secret']) ?	'' : strip_tags($instance['access_token_secret']);
		$count = 					empty($instance['count']) ? '' : strip_tags($instance['count']);
		$username = 				empty($instance['username']) ? '' : strip_tags($instance['username']);
		$exclude_replies = 			empty($instance['exclude_replies']) ? 0 : 1;
		$time = 					empty($instance['time']) ? 0 : 1;
		$display_avatar = 			empty($instance['display_avatar']) ? 0 : 1;?>
        
        <p><label for="<?php echo ($this->get_field_id('title')); ?>"><?php esc_html_e('Title:','designthemes-core');?> 
		   <input class="widefat" id="<?php echo ($this->get_field_id('title')); ?>" name="<?php echo ($this->get_field_name('title')); ?>" 
            type="text" value="<?php echo esc_attr($title); ?>" /></label></p>

        <p><label for="<?php echo ($this->get_field_id('consumer_key')); ?>"><?php esc_html_e('Consumer Key:','designthemes-core');?> 
		   <input class="widefat" id="<?php echo ($this->get_field_id('consumer_key')); ?>" name="<?php echo ($this->get_field_name('consumer_key')); ?>" 
            type="text" value="<?php echo esc_attr($consumer_key); ?>" /></label></p>
            
        <p><label for="<?php echo ($this->get_field_id('consumer_secret')); ?>"><?php esc_html_e('Consumer Secret:','designthemes-core');?> 
		   <input class="widefat" id="<?php echo ($this->get_field_id('consumer_secret')); ?>" name="<?php echo ($this->get_field_name('consumer_secret')); ?>" 
            type="text" value="<?php echo esc_attr($consumer_secret); ?>" /></label></p>

        <p><label for="<?php echo ($this->get_field_id('access_token')); ?>"><?php esc_html_e('Access Token:','designthemes-core');?> 
		   <input class="widefat" id="<?php echo ($this->get_field_id('access_token')); ?>" name="<?php echo ($this->get_field_name('access_token')); ?>" 
            type="text" value="<?php echo esc_attr($access_token); ?>" /></label></p>
            
        <p><label for="<?php echo ($this->get_field_id('access_token_secret')); ?>"><?php esc_html_e('Access Token Secret:','designthemes-core');?> 
		   <input class="widefat" id="<?php echo ($this->get_field_id('access_token_secret')); ?>" name="<?php echo ($this->get_field_name('access_token_secret')); ?>" 
            type="text" value="<?php echo esc_attr($access_token_secret); ?>" /></label></p>

        <p><label for="<?php echo ($this->get_field_id('username')); ?>"><?php esc_html_e('Enter your twitter username:','designthemes-core');?>
           <input class="widefat" id="<?php echo ($this->get_field_id('username')); ?>" name="<?php echo ($this->get_field_name('username')); ?>"
            type="text" value="<?php echo esc_attr($username); ?>" /></label></p>
            
        <p><label for="<?php echo ($this->get_field_id('count')); ?>"><?php esc_html_e('How many entries do you want to show:','designthemes-core');?>
        	<select class="widefat" id="<?php echo ($this->get_field_id('count')); ?>" name="<?php echo ($this->get_field_name('count')); ?>">
            <?php for($i = 1; $i <= 20; $i++):	
					$selected = ($count == $i ) ? "selected='selected'" : "";?>
	              <option <?php echo esc_attr($selected);?> value="<?php echo esc_attr($i);?>"><?php echo esc_attr($i);?></option>
            <?php endfor;?>
            </select></label></p>
            
        <p><input type="checkbox"  id="<?php echo ($this->get_field_id('exclude_replies'));?>" name="<?php echo ($this->get_field_name('exclude_replies'));?>" 
			<?php checked($exclude_replies); ?> /> <label for="<?php echo ($this->get_field_id('exclude_replies')); ?>"><?php esc_html_e('Exclude @replies','designthemes-core');?></label></p>
            
        <p><input type="checkbox"  id="<?php echo ($this->get_field_id('time'));?>" name="<?php echo ($this->get_field_name('time'));?>" 
			<?php checked($time); ?> /> <label for="<?php echo ($this->get_field_id('time')); ?>"><?php esc_html_e('Show time of tweet','designthemes-core');?></label></p>
            
        <p><input type="checkbox"  id="<?php echo ($this->get_field_id('display_avatar'));?>" name="<?php echo ($this->get_field_name('display_avatar'));?>" 
				<?php checked($display_avatar); ?> /> <label for="<?php echo ($this->get_field_id('display_avatar')); ?>"><?php esc_html_e('Show user avatar','designthemes-core');?></label></p>		
<?php
	}

	#3.processes & saves the twitter widget option
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['consumer_key'] = strip_tags($new_instance['consumer_key']);
		$instance['consumer_secret'] = strip_tags($new_instance['consumer_secret']);
		$instance['access_token'] = strip_tags($new_instance['access_token']);
		$instance['access_token_secret'] = strip_tags($new_instance['access_token_secret']);
		$instance['count'] = strip_tags($new_instance['count']);
		$instance['username'] = strip_tags($new_instance['username']);
		$instance['exclude_replies'] = empty($new_instance['exclude_replies']) ? 0 : 1;
		$instance['time'] = empty($new_instance['time']) ? 0 : 1;
		$instance['display_avatar'] = empty($new_instance['display_avatar']) ? 0 : 1;
		return $instance;
	}

	#4.output in front-end
	function widget($args, $instance) {
		extract($args);
			$title = 			empty($instance['title']) ?	'' : strip_tags($instance['title']);
			$consumer_key = 			empty($instance['consumer_key']) ?	'' : strip_tags($instance['consumer_key']);
			$consumer_secret = 			empty($instance['consumer_secret']) ?	'' : strip_tags($instance['consumer_secret']);
			$access_token = 			empty($instance['access_token']) ?	'' : strip_tags($instance['access_token']);
			$access_token_secret = 			empty($instance['access_token_secret']) ?	'' : strip_tags($instance['access_token_secret']);
			$count = 			empty($instance['count']) ? '' : strip_tags($instance['count']);
			$username = 		empty($instance['username']) ? '' : strip_tags($instance['username']);
			$exclude_replies = 	empty($instance['exclude_replies']) ? false : true;
			$time = 			empty($instance['time']) ? false : true;
			$display_avatar = 	empty($instance['display_avatar']) ? false : true ;

		echo ($before_widget);

			if ( !empty( $title ) ) { echo ($before_title . $title . $after_title); };

			if($username && $consumer_key && $consumer_secret && $access_token && $access_token_secret && $count) { 

					$transName = 'list_tweets';
					$cacheTime = 10;

					require_once(TRENDYTRAVEL_CORE_PLUGIN."/apis/twitteroauth/twitteroauth.php");
						$twitterConnection = new TwitterOAuth($consumer_key, $consumer_secret, $access_token, $access_token_secret );
						$twitterData = $twitterConnection->get('statuses/user_timeline',array('screen_name' => $username, 'count' => $count,'exclude_replies' => $exclude_replies));
			
						 if($twitterConnection->http_code != 200) {
							 $twitterData = get_transient($transName);
						 }

					set_transient($transName, $twitterData, 60 * 10);
					$twitter = get_transient($transName);

				echo "<ul class='tweet_list'>";
				if($twitter && is_array($twitter)) {
					foreach( $twitter as $tweet ):

						$latestTweet = $tweet->text;
						$reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";
						if(preg_match($reg_exUrl, $latestTweet, $url)) {
							$latestTweet = preg_replace($reg_exUrl, '<a href="'.$url[0].'" rel="nofollow">'.$url[0].'</a>', $latestTweet);
						}
						$twitterTime = strtotime($tweet->created_at);
						$twitterTime = !empty($tweet->utc_offset) ? $twitterTime+($tweet->utc_offset ) : $twitterTime;
						$timeAgo = date_i18n(  get_option('date_format'), $twitterTime );

						echo '<li>';
								if( $display_avatar )
									echo '<span class="tweet-thumb"><a href="http://twitter.com/'.$username.'" title=""><img src="'.$tweet->user->profile_image_url.'" alt="" /></a></span>';

								echo '<span class="tweet-text">'.$latestTweet.'</span>';

								if( $time )
									echo "<span class='tweet-time'>{$timeAgo}</span>";
						echo '</li>';

					endforeach;
				} else {
					echo '<li>'.esc_html__('No public Tweets found','designthemes-core').'</li>';
				}
				echo "</ul>";
			}
		echo ($after_widget);
	}
}?>