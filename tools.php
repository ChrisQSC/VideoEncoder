<?php
	const FFMPEG_DIR = 'E:\Program Files (x86)\ffmpeg\bin';
	const IMG_TOKEN = 'H^Qi2P11CW';
	const THUMBNAIL_PATH = '".\thumbnail\\';

	function get_video_duration($file_name)
	{
		$cmd = '"'.FFMPEG_DIR.'\ffmpeg" -i "'.$file_name.'" 2>&1';
		$pattern = '/Duration: ([\s\S]*?),/';
		exec($cmd,$out1,$out2);
		$out = json_encode($out1);
		preg_match($pattern, $out,$duration);
		$times = explode(':',$duration[1]);
		return $times;
		//echo json_encode($out1)."<br>".json_encode($out2);
	}

	function cut_video($file_name)
	{
		$cut_time = get_cut_time($file_name);
		$jpg_name = generate_img_name($file_name);
		while(file_exists(THUMBNAIL_PATH.$jpg_name))
		{
			$jpg_name = generate_img_name($file_name);
		}
		$cmd = '"'.FFMPEG_DIR.'\ffmpeg"'.' -ss '.$cut_time.' -i "'.$file_name.'" -f image2 -y '.THUMBNAIL_PATH.$jpg_name.'"';
		echo $cmd;
		exec($cmd,$out1);
		exec('exit');
		echo json_encode($out1);
		echo generate_img_name($file_name);

	}

	function get_cut_time($file_name)
	{
		$times = get_video_duration($file_name);
		return intval($times[0]*0.618).':'.intval($times[1]*0.618).':'.$times[2]*0.618;
	}

	function generate_img_name($file_name)
	{
		return substr(md5($file_name.IMG_TOKEN.time()), 6).'.jpg';
	}

	cut_video('C:\Users\Chris\Videos\1.mp4',"123123");

?>

  