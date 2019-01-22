<?
class Acs_Office
{
	private static $_url = 'https://webservices.acscourier.net/AcsInfo/api/ACS_Stations/EN';
	private static $_user = '';
	private static $_pass = '';
	
	public static function getList()
	{
		$process = curl_init(self::$_url);
		curl_setopt($process, CURLOPT_USERPWD, self::$_user . ":" . self::$_pass);
		curl_setopt($process, CURLOPT_TIMEOUT, 30);
		curl_setopt($process, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($process, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($process, CURLOPT_RETURNTRANSFER, TRUE);
		$return = curl_exec($process);
		curl_close($process);
		return json_decode($return, 1);
	}
}