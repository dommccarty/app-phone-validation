<?
	
if (!function_exists("os_and_version")) {
	
	function os_and_version($user_agent) {
		
		$user_agent = strtolower($user_agent);
		
		$os = null;
		$os_version = null;
		$is_mobile = false;
		
		if (($spot = strpos($user_agent, "iphone os")) !== false) {
	
			$os = "ios";
	
			$len = strlen("iphone os ");
			$spot += $len;
	
			$next = strpos($user_agent, " ", $spot);
	
			$os_chunk = substr($user_agent, $spot, $next - $spot);
	
			$os_version = str_replace("_", ".", $os_chunk);	
	
			$is_mobile = true;
		}

		elseif (($spot = strpos($user_agent, "android")) !== false) {
	
			$os = "android";
	
			$len = strlen("android ");
			$spot += $len;
	
			$next = strpos($user_agent, ";", $spot);
	
			$os_version = substr($user_agent, $spot, $next - $spot);
	
			$is_mobile = true;
		}
		
		return ["is_mobile" => $is_mobile, "os" => $os, "os_version" => $os_version];
	}
}
	
?>